<?php

function base_cache_buster_get_suffix()
{
    if (defined('ALWAYS_BUST_CACHE') && ALWAYS_BUST_CACHE) {
        // if in debug mode then make each request get the file from the server
        return 'bcb' . time();
    }

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

    return 'bcb' . time();
}

return base_cache_buster_get_suffix();