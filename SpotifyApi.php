<?php

namespace SpotifyLib;

/**
 * @class SpotifyApi
 */
class SpotifyApi
{

    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var String
     */
    private $apiVersion;

    /**
     * @var String
     */
    private $service;

    public function __construct(Curl $curlClass, $service, $version){
        $this->setCurl($curlClass);

        $this->setService($service);
        $this->setApiVersion($version);
        $this->getCurl()->setBaseUrl('http://ws.spotify.com/');
        $this->getCurl()->setMethod('GET');
        $this->getCurl()->setPrefix( $this->getService()  . '/' . $this->getApiVersion() );
    }

    /**
     * Setter for private var curl
     *
     * @param $curl mixed
     * @return SpotifyApi
     */
    public function setCurl(Curl $curl)
    {
        $this->curl = $curl;

        return $this;
    }


    /**
     * Getter for private var curl
     *
     * @return Curl
     */
    public function getCurl()
    {
        return $this->curl;
    }


    /**
     * Setter for private var apiVersion
     *
     * @param   $apiVersion String          version of the api (allowing string in case 1.1 comes out)
     * @return  \SpotifyLib\SpotifyApi      this instance of this class
     */
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;

        return $this;
    }


    /**
     * Getter for private var apiVersion
     *
     * @return String
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * Setter for the spotify service you want to use
     *
     * @param $service String   the service
     * @return SpotifyApi       this instance of this class
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Getter the spotify service you want to use
     *
     * @return String
     */
    public function getService()
    {
        return $this->service;
    }



}
