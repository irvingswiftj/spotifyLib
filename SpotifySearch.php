<?php
/**
 * @file SpotifySearch.php
 * User: James Irving-Swift
 * On behalf of: Holiday Lettings Ltd
 * Date: 24/02/2014
 * Time: 14:13
 */

namespace SpotifyLib;

require "SpotifyMethod.php";

/**
 * @class SpotifySearch
 */
class SpotifySearch implements SpotifyMethod {

    /**
     * @var $api    /SpotifyLib/SpotifyApi  api Class to use
     *
     */
    private $api;

    /**
     * @var $artist  String                     string of artist to search for
     */
    private $artist;

    /**
     * @var $artistSearchResult Array           the array of results from searching for an artist
     */
    private $artistSearchResult;

    /**
     * @var $artistSearchResultInfo /StdClass   the Info section of the artist search result
     */
    private $artistSearchResultInfo;

    /**
     * @var $album String                       string of artist to search for
     */
    private $album;

    /**
     * @var $albumSearchResult Array            the array of results from searching for an album
     */
    private $albumSearchResult;

    /**
     * @var $albumSearchResultInfo /StdClass    the Info section of the album search result
     */
    private $albumSearchResultInfo;

    /**
     * @var $track String                       string of track to search for
     */
    private $track;

    /**
     * @var $trackSearchResult Array            the array of results from searching for a track
     */
    private $trackSearchResult;

    /**
     * @var $trackSearchResultInfo /StdClass    the Info section of the track search result
     */
    private $trackSearchResultInfo;

    /**
     * @var $queryString String                 will be set for the string to query
     */
    private $queryString;

    /**
     * @var $pageNumber Integer                 the page number of results you want
     */
    private $pageNumber;

    /**
     * @param SpotifyApi $api       Injection of SpotifyApi
     * @param string $apiVersion    version number of the api you want to use
     */
    public function __construct(SpotifyApi $api, $apiVersion = "1"){
        $this->setApi($api);
        $this->getApi()->setApiVersion($apiVersion);

    }

    /**
     * Setter for private var api
     *
     * @param SpotifyApi $api    instance of the spotify api class
     * @return SpotifySearch    this instance of this class
     */
    public function setApi(SpotifyApi $api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Getter for private var api
     *
     * @return SpotifyApi
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Setter for private var artist
     *
     * @param $artist string     artist to search for
     * @return SpotifySearch     this instance of this class
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * Getter for private var artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Setter for private var artistSearchResult
     *
     * @param $artistSearchResult Array     search results from the artist search
     * @return SpotifySearch                this instance of this class
     */
    public function setArtistSearchResult(Array $artistSearchResult)
    {
        $this->artistSearchResult = $artistSearchResult;

        return $this;
    }

    /**
     * Getter for private var artistSearchResult
     *
     * @return Array
     */
    public function getArtistSearchResult()
    {
        return $this->artistSearchResult;
    }

    /**
     * Setter for private var artistSearchResultInfo
     *
     * @param $artistSearchResultInfo \stdClass  the decoded info section of the artist search
     * @return SpotifySearch this instance of this class
     */
    public function setArtistSearchResultInfo(\stdClass $artistSearchResultInfo)
    {
        $this->artistSearchResultInfo = $artistSearchResultInfo;

        return $this;
    }

    /**
     * Getter for private var artistSearchResultInfo
     *
     * @return \stdClass
     */
    public function getArtistSearchResultInfo()
    {
        return $this->artistSearchResultInfo;
    }

    /**
     * Setter for private var album
     *
     * @param ablum String
     * @return SpotifySearch this instance of this class
     */
    public function setAlbum($album)
    {
        $this->album = $album;

        return $this;
    }

    /**
     * Getter for private var album
     *
     * @return String
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Setter for private var albumSearchResult
     *
     * @param $albumSearchResult Array
     * @return SpotifySearch this instance of this class
     */
    public function setAlbumSearchResult(array $albumSearchResult)
    {
        $this->albumSearchResult = $albumSearchResult;

        return $this;
    }

    /**
     * Getter for private var albumSearchResult
     *
     * @return Array
     */
    public function getAlbumSearchResult()
    {
        return $this->albumSearchResult;
    }

    /**
     * Setter for private var albumSearchResultInfo
     *
     * @param $albumSearchResultInfo \stdClass  the info section of the response
     * @return SpotifySearch                    this instance of this class
     */
    public function setAlbumSearchResultInfo(\stdClass $albumSearchResultInfo)
    {
        $this->albumSearchResultInfo = $albumSearchResultInfo;

        return $this;
    }

    /**
     * Getter for private var albumSearchResultInfo
     *
     * @return \stdClass
     */
    public function getAlbumSearchResultInfo()
    {
        return $this->albumSearchResultInfo;
    }

    /**
     * Setter for private var track
     *
     * @param $track String
     * @return SpotifySearch this instance of this class
     */
    public function setTrack($track)
    {
        $this->track = $track;

        return $this;
    }

    /**
     * Getter for private var track
     *
     * @return String
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * Setter for private var trackSearchResult
     *
     * @param $trackSearchResult Array
     * @return SpotifySearch this instance of this class
     */
    public function setTrackSearchResult(array $trackSearchResult)
    {
        $this->trackSearchResult = $trackSearchResult;

        return $this;
    }

    /**
     * Getter for private var trackSearchResult
     *
     * @return Array
     */
    public function getTrackSearchResult()
    {
        return $this->trackSearchResult;
    }

    /**
     * Setter for private var trackSearchResultInfo
     *
     * @param $trackSearchResultInfo \stdClass
     * @return SpotifySearch this instance of this class
     */
    public function setTrackSearchResultInfo(\stdClass $trackSearchResultInfo)
    {
        $this->trackSearchResultInfo = $trackSearchResultInfo;

        return $this;
    }

    /**
     * Getter for private var trackSearchResultInfo
     *
     * @return \stdClass
     */
    public function getTrackSearchResultInfo()
    {
        return $this->trackSearchResultInfo;
    }

    /**
     * Setter for private var pageNumber
     *
     * @param $pageNumber int
     * @throws \Exception       if page number is not numeric
     * @return SpotifySearch    this instance of this class
     */
    public function setPageNumber($pageNumber)
    {
        if ( !is_numeric($pageNumber)) {
            throw new \Exception('page number must be numeric');
        }

        $this->pageNumber = $pageNumber;

        $this->getApi()->getCurl()->addParam('page',$this->getPageNumber());

        return $this;
    }

    /**
     * Getter for private var pageNumber
     *
     * @return Int
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * Setter for private var queryString
     *
     * @param $queryString String
     * @return SpotifySearch        this instance of this class
     */
    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;

        $this->getApi()->getCurl()->addParam('q',$this->getQueryString());

        return $this;
    }

    /**
     * Getter for private var queryString
     *
     * @return String
     */
    public function getQueryString()
    {
        return $this->queryString;
    }



    /**
     * searchArtist
     *
     * @param string $artist
     */
    public function searchArtist( $artist = '' ) {

        if ( $artist !== '') {
            $this->setArtist($artist);
        }

        $this->getApi()->getCurl()->setEndPoint('artist.json');
        $this->setQueryString($this->getArtist());
        $this->getApi()->getCurl()->call();

        $response = $this->getApi()->getCurl()->getResponse();

        if ( property_exists($response, 'info')) {
            $this->setArtistSearchResultInfo($response->info);
        }

        if ( property_exists($response, 'artists')) {
            $this->setArtistSearchResult($response->artists);
        }
    }


    /**
     * searchAlbum
     *
     * @param string $album     Album name to search
     */
    public function searchAlbum( $album = '' ) {

        if ( $album !== '') {
            $this->setAlbum($album);
        }

        $this->getApi()->getCurl()->setEndPoint('album.json');
        $this->setQueryString($this->getAlbum());
        $this->getApi()->getCurl()->call();

        $response = $this->getApi()->getCurl()->getResponse();

        if ( property_exists($response, 'info')) {
            $this->setAlbumSearchResultInfo($response->info);
        }

        if ( property_exists($response, 'albums')) {
            $this->setAlbumSearchResult($response->albums);
        }
    }


    /**
     * searchTrack
     *
     * @param string $track     Track name to search
     */
    public function searchTrack( $track = '' ) {

        if ( $track !== '') {
            $this->setTrack($track);
        }

        $this->getApi()->getCurl()->setEndPoint('track.json');
        $this->setQueryString($this->getTrack());
        $this->getApi()->getCurl()->call();

        $response = $this->getApi()->getCurl()->getResponse();

        if ( property_exists($response, 'info')) {
            $this->setTrackSearchResultInfo($response->info);
        }

        if ( property_exists($response, 'tracks')) {
            $this->setTrackSearchResult($response->tracks);
        }
    }
} 