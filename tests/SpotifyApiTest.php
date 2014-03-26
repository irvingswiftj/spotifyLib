<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 20/03/2014
 * Time: 23:29
 */

namespace SpotifyLib;

require_once 'SpotifyApi.php';

class SpotifyApiTest extends \PHPUnit_Framework_TestCase {

    /**
     * test the basic setters and getters
     */
    public function testSettersAndGetters()
    {
        $lib = new SpotifyApi('lookup',1);

        $version    = 1;
        $service    = 'lookup';
        $url        = 'http://example.com';
        $endpoint   = 'test';

        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->setApiVersion($version));
        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->setService($service));
        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->setUrl($url));
        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->setEndpoint($endpoint));

        $this->assertEquals($service, $lib->getService());
        $this->assertEquals($version, $lib->getApiVersion());
        $this->assertEquals($url, $lib->getUrl());
        $this->assertEquals($endpoint, $lib->getEndpoint());

    }

    /**
     * test to add, remove and get parameter methods
     */
    public function testParams()
    {
        $lib = new SpotifyApi('lookup',1);

        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->addParam('uri','test'));
        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->addParam('user','fred'));

        //check getParams is an array with both the params we added
        $this->assertEquals(array('uri'=>'test','user'=>'fred'), $lib->getParams());

        //test removing a param
        $this->assertInstanceOf('SpotifyLib\SpotifyApi', $lib->removeParam('uri'));

        //test element is missing from array after removeParam
        $this->assertEquals(array('user'=>'fred'), $lib->getParams());
    }

}
 