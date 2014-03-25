<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 19/03/2014
 * Time: 07:09
 */

namespace SpotifyLib;

/**
 * @class SpotifyApi
 */
class SpotifyApi
{
    /**
     * @var array
     */
    private $params = array();

    /**
     * @var string
     */
    private $format = '.json';

    /**
     * @var string
     */
    private $url = null;

    /**
     * @var string
     */
    private $apiVersion;

    /**
     * @var string
     */
    private $service;

    /**
     * @param $service
     * @param $version
     */
    public function __construct($service, $version){

        $this->setService($service);
        $this->setApiVersion($version);
        $this->setUrl('http://ws.spotify.com/{service}/{version}/');

    }

    /**
     * Getter for the array of parameters
     *
     * @return Array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param String $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return String
     */
    public function getUrl()
    {
        return $this->url;
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

    /**
     * method to add a parameter that will be used as a GET or POST param
     *
     * @param $key String       the key for the parameter (i.e. 'owner_id')
     * @param $val String       the value of the parameters
     * @return SpotifyLib/SpotifyApi
     */
    public function addParam($key, $val)
    {
        $this->params[$key] = $val;

        return $this;
    }

    /**
     * method to remove a parameter in our array of params
     *
     * @param $key String the key of the parameter that you want to remove
     * @return SpotifyLib/SpotifyApi
     */
    public function removeParam($key)
    {
        //check that the param is set before removing it!
        if ( array_key_exists($key, $this->getParams()) ) {
            unset($this->params[$key]);
        }

        return $this;
    }

    /**
     * method to call spotify's api using guzzle
     *
     * @return array|boolean    array if has a understandable response else false
     */
    public function call()
    {

        $client = new \GuzzleHttp\Client();
        $url    = 'http://ws.spotify.com/'. $this->getService() .'/' . $this->getApiVersion() . '/' . $this->format;

        $res = $client->get($url,[
            'query' => $this->params
        ]);

        //check if successful
        if ($res->getStatusCode() == 200) {

            if ($this->format === '.json') {
                $returnVal = $res->json();
            } else {
                $returnVal = (array) $res->xml();
            }

        } else {
            $returnVal = false;
        }

        return $returnVal;
    }


}