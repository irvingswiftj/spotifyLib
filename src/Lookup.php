<?php
/**
 * @file SpotifyLookup.php
 * User: James Irving-Swift
 * Date: 26/02/2014
 * Time: 07:23
 */

namespace Swifty\Spotify;

class Lookup {

    /**
     * @var API $api
     */
    private $api;

    /**
     * @var $uri  String            string of item you want to lookup
     */
    private $uri;

    /**
     * @var $result array           the result from the api
     */
    private $result;

    /**
     * @var $resultInfo array       the info part of the response
     */
    private $resultInfo;

    /**
     * @var $resultType String      the type of result we get back
     */
    private $resultType;

    /**
     * @param API $api       Injection of API
     * @param string $apiVersion    version number of the api you want to use
     */
    public function __construct(API $api, $apiVersion = "1")
    {
        $this->setApi($api);
        $this->getApi()->setApiVersion($apiVersion);

    }

    /**
     * Setter for private var api
     *
     * @param API $api    instance of the spotify api class
     * @return SpotifySearch    this instance of this class
     */
    public function setApi(API $api)
    {
        $this->api = $api;

        return $this;
    }

    /**
     * Getter for private var api
     *
     * @return API
     */
    public function getApi()
    {
        return $this->api;
    }

    /**
     * Setter for private var uri
     *
     * @param $uri string       artist to search for
     * @return SpotifySearch     this instance of this class
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Getter for private var uri
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Setter for private var result
     *
     * @param $result array
     * @return this
     */
    public function setResult(array $result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Getter for private var result
     *
     * @return \stdClass
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Setter for private var resultInfo
     *
     * @param $resultInfo array     info in the result
     * @return this
     */
    public function setResultInfo(array $resultInfo)
    {
        $this->resultInfo = $resultInfo;

        return $this;
    }

    /**
     * Getter for private var resultInfo
     *
     * @return array
     */
    public function getResultInfo()
    {
        return $this->resultInfo;
    }

    /**
     * Setter for private var resultType
     *
     * @param $resultType           String
     * @return this
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;

        return $this;
    }

    /**
     * Getter for private var resultType
     *
     * @return String
     */
    public function getResultType()
    {
        return $this->resultType;
    }


    /**
     * search
     *
     * @param string $uri (optional)
     * @return array
     */
    public function search( $uri = '' ) {

        if ( $uri !== '') {
            $this->setUri($uri);
        }

        $this->getApi()->addParam('uri',$this->getUri());

        $response = $this->getApi()->call();

        $this->setResultInfo($response['info']);
        $this->setResultType($response['info']['type']);
        $this->setResult( $response[$this->getResultType()] );

        return $this->getResult();


    }

} 
