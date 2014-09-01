<?php

namespace Swifty\Spotify;

class Helper {

    const DEFAULT_WEBP_PLAYER_URL = 'open.spotify.com';

    /**
     * uriTowWebPlayerUrl
     *
     * @param $uri
     * @return mixed
     * @author Swifty
     * @created ${DATE}
     */
    static public function uriTowWebPlayerUrl($uri)
    {
        //replace the spotify string with the url
        $url = preg_replace('/spotify/',self::DEFAULT_WEBP_PLAYER_URL,$uri);

        //replace : for /
        $url = "http://" . preg_replace('/:/',"/",$url);

        return $url;
    }


} 
