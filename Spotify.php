<?php
/**
 * SpotifyLib
 * @author James Irving-Swift 'swifty'
 */
require 'Curl.php';
require 'SpotifyApi.php';
require "SpotifySearch.php";
require "SpotifyLookup.php";
require "SpotifyHelper.php";


/**
 * EXAMPLES
 */

/**
 *  HOW TO USE THE SEARCH API
 */

//create a new instance of the spotify api with the service set to 'search'
$searchApi = new \SpotifyLib\SpotifyApi(new \SpotifyLib\Curl(),'search',1);

//create a new search class and inject our spotify api instance
$search = new \SpotifyLib\SpotifySearch($searchApi);

//Searching for Artist, album and Tracks are all done in the same manner
//  here is an example of each:

echo "searching artist:";

$search->searchArtist('queens of the stone age');
print_r($search->getArtistSearchResultInfo());
print_r($search->getArtistSearchResult());
echo "searching album:";

$search->searchAlbum('L.A. Woman');
print_r($search->getAlbumSearchResultInfo());
print_r($search->getAlbumSearchResult());

echo "searching track:";

$search->searchTrack('Walking in Memphis');
print_r($search->getTrackSearchResultInfo());
print_r($search->getTrackSearchResult());
//this library supports spotify's pagination and can be used by using the SpotifySearch::setPageNumber() method

$search->setPageNumber(4);
$search->searchTrack(); // if parameter in a search method is blank it will re-search for what last last search unless you use SpoifySearch::set{searchType}() is used first
print_r($search->getTrackSearchResultInfo());

//other ways to use this class:

$result = $search->setArtist('Oasis')
                 ->setPageNumber(1)
                 ->searchArtist();
print_r($result);

/**
 * HOW TO USE THE LOOKUP API
 */

//create a new instance of the spotify api with the service set to 'lookup'
$lookupApi = new \SpotifyLib\SpotifyApi(new \SpotifyLib\Curl(),'lookup',1);

//create a new SpotifyLookup class instance and inject our spotify api instance
$lookup = new \SpotifyLib\SpotifyLookup($lookupApi);

//search using the uri have you have
$uri = 'spotify:artist:4pejUc4iciQfgdX6OKulQn';
$lookup->search($uri);

echo "search results for $uri:";
print_r($lookup->getResult());


/**
 * HOW TO USE THE HELPER
 */
$url = \SpotifyLib\SpotifyHelper::uriTowWebPlayerUrl('spotify:artist:4pejUc4iciQfgdX6OKulQn');
print_r($url);