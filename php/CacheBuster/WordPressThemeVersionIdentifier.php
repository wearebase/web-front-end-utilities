<?php

namespace Base\CacheBuster;

use WP_Theme;

class WordPressThemeVersionIdentifier implements VersionIdentifierInterface {

    /**
     * @return string
     * @throws VersionUnidentifiableException
     */
    public function getVersion()
    {
        $theme_data = wp_get_theme();

        if ($theme_data instanceof WP_Theme){
            $theme_version = $theme_data->Version;
            return preg_replace('/[^\d|[a-z]/', '', $theme_version);
        }

        throw new VersionUnidentifiableException();
    }

    /**
     * @return string
     */
    public function getStrategyDescription()
    {
        return 'Version the WordPress Theme as defined in the top of styles.css';
    }
}
