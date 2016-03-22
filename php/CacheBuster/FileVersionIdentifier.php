<?php

namespace Base\CacheBuster;

class FileVersionIdentifier implements VersionIdentifierInterface {

    /**
     * @var string
     * path to version file
     */
    private $versionFile;

    function __construct($versionFile)
    {
        $this->versionFile = $versionFile;
    }

    /**
     * @return string
     * @throws VersionUnidentifiableException
     */
    public function getVersion()
    {
        if (!is_readable($this->versionFile)) {
            throw new VersionUnidentifiableException();
        }

        $version = trim(file_get_contents($this->versionFile));
        if (!$version || !ctype_alnum($version)) {
            throw new VersionUnidentifiableException();
        }

        return $version;
    }

    /**
     * @return string
     */
    public function getStrategyDescription()
    {
        return 'Version from a file in the project';
    }
}
