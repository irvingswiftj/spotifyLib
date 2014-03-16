<?php
/**
 * @file SpotifyHelper.php
 * User: James Irving-Swift
 * On behalf of: Holiday Lettings Ltd
 * Date: 01/03/2014
 * Time: 09:34
 */

namespace SpotifyLib;

/**
 * @class SpotifyHelper
 * @package SpotifyLib
 */
class SpotifyHelper {

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