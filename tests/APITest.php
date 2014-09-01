<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 20/03/2014
 * Time: 23:29
 */

namespace Swifty\Spotify;

class APITest extends \PHPUnit_Framework_TestCase {

    /**
     * test the basic setters and getters
     */
    public function testSettersAndGetters()
    {
        $lib = new API('lookup',1);

        $version    = 1;
        $service    = 'lookup';
        $url        = 'http://example.com';
        $endpoint   = 'test';

        $this->assertInstanceOf('Swifty\Spotify\API', $lib->setApiVersion($version));
        $this->assertInstanceOf('Swifty\Spotify\API', $lib->setService($service));
        $this->assertInstanceOf('Swifty\Spotify\API', $lib->setUrl($url));
        $this->assertInstanceOf('Swifty\Spotify\API', $lib->setEndpoint($endpoint));

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
        $lib = new API('lookup',1);

        $this->assertInstanceOf('Swifty\Spotify\API', $lib->addParam('uri','test'));
        $this->assertInstanceOf('Swifty\Spotify\API', $lib->addParam('user','fred'));

        //check getParams is an array with both the params we added
        $this->assertEquals(array('uri'=>'test','user'=>'fred'), $lib->getParams());

        //test removing a param
        $this->assertInstanceOf('Swifty\Spotify\API', $lib->removeParam('uri'));

        //test element is missing from array after removeParam
        $this->assertEquals(array('user'=>'fred'), $lib->getParams());
    }

}
 
