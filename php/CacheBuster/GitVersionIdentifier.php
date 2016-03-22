<?php

namespace Base\CacheBuster;

class GitVersionIdentifier implements VersionIdentifierInterface {

    /**
     * @return string
     * @throws VersionUnidentifiableException
     */
    public function getVersion()
    {
        // read the git ref directly (faster)
        $ref = ABSPATH . '.git/' . trim(substr(@file_get_contents(ABSPATH . '.git/HEAD'), 5));

        if (is_readable($ref)) {
            return 'bcb' .substr(@file_get_contents($ref), 0, 7);
        }

        // execute git commands to get the sha (slower)
        $sha1 = exec("git rev-parse --verify --short HEAD", $output, $returnVar);

        if ($returnVar === 0 && !empty($output[0])) {
            return 'bcb' . $sha1;
        }

        throw new VersionUnidentifiableException();
    }

    /**
     * @return string
     */
    public function getStrategyDescription()
    {
        return 'Version from reading the HEAD of the .git repo';
    }
}
