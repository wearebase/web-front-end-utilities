<?php


namespace Base\CacheBuster;


class CacheBuster {

    /**
     * @var string
     */
    private $version = '';

    const ENVIRONMENT_VARIABLE_NAME = 'BASE_CACHE_VERSION';

    public function __construct() {

        $environmentVersion = getenv(self::ENVIRONMENT_VARIABLE_NAME);
        if($environmentVersion && $environmentVersion !== '') {
            $this->version = $environmentVersion;
            return;
        }

        if (defined('WP_ENV') && WP_ENV === 'development') {
            // if in development mode then make each request get the file from the server
            $this->version = (new TimestampVersionIdentifier())->getVersion();
            return;
        }
    }

    /**
     * @return string
     * @throws VersionUnidentifiableException
     */
    public function getVersion()
   {
       if($this->version === '') {
           throw new VersionUnidentifiableException('Version could not be found in the '.self::ENVIRONMENT_VARIABLE_NAME.' environment variable, try calling findVersion() to attempt alternate methods of identifying the version');
       }

       return $this->version;
   }

    /**
     * Use known strategies on how to locate a string which relates to this version of the code
     *
     * @param VersionIdentifierInterface[] $strategies
     * @return string
     * @throws VersionUnidentifiableException
     */
    public function getVersionFromFallbackStrategies(array $strategies = [])
    {
        if(empty($strategies)){
            $strategies = [
                new FileVersionIdentifier('version'),
                new GitVersionIdentifier(),
                new WordPressThemeVersionIdentifier(),
                new TimestampVersionIdentifier()
            ];
        }

        foreach($strategies as $strategy){
            try{
                $version = $strategy->getVersion();
                $_ENV[self::ENVIRONMENT_VARIABLE_NAME] = $version;
                return $version;
            } catch(VersionUnidentifiableException $e) {
                continue;
            }
        }
    }
}
