<?php

namespace Base\CacheBuster;

class TimestampVersionIdentifier implements VersionIdentifierInterface {

    /**
     * @return string
     */
    public function getVersion()
    {
       return time();
    }

    /**
     * @return string
     */
    public function getStrategyDescription()
    {
        return 'Version from timestamp';
    }
}
