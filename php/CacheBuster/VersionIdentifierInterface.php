<?php

namespace Base\CacheBuster;

interface VersionIdentifierInterface {

    /**
     * @return string
     * @throws VersionUnidentifiableException
     */
    public function getVersion();

    /**
     * @return string
     */
    public function getStrategyDescription();
}
