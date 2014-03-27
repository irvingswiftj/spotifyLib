<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 22/03/2014
 * Time: 10:18
 */

namespace SpotifyLib;

require_once 'SpotifyLookup.php';

class SpotifyLookupTest extends \PHPUnit_Framework_TestCase {

    /**
     * test our setters and getters
     */
    public function testSettersAndGetters() {

        $classToMock            = '\SpotifyLib\SpotifyApi';
        $methodsToMock          = array();
        $mockConstructorParams  = array('lookup', 1);
        $mockClassName          = 'Foo';
        $callMockConstructor    = true;

        // Create a mock for the Observer class,
        // only mock the update() method.
        $mock = $this->getMock(
            $classToMock,
            $methodsToMock,
            $mockConstructorParams,
            $mockClassName,
            $callMockConstructor
        );

        $sl = new SpotifyLookup($mock);

        $this->assertInstanceOf('SpotifyLib\SpotifyLookup', $sl->setUri('123453'));
        $this->assertInstanceOf('SpotifyLib\SpotifyLookup', $sl->setApi($mock));
        $this->assertInstanceOf('SpotifyLib\SpotifyLookup', $sl->setResult(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifyLookup', $sl->setResultInfo(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifyLookup', $sl->setResultType('type'));

        $this->assertEquals('123453', $sl->getUri());
        $this->assertEquals($mock, $sl->getApi());
        $this->assertEquals(array(), $sl->getResult());
        $this->assertEquals(array(), $sl->getResultInfo());
        $this->assertEquals('type', $sl->getResultType());
    }

    /**
     * test the search method
     */
    public function testSearch()
    {
        $classToMock            = '\SpotifyLib\SpotifyApi';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('lookup', 1);
        $mockClassName          = 'Foo';
        $callMockConstructor    = true;
        $mockResponse           = array(
            'info' => array(
                'type' => 'artist'
            ),
            'artist' => array(
                'href' => 'spotify:artist:4pejUc4iciQfgdX6OKulQn',
                'name' => 'Queens Of The Stone Age'
            )
        );

        $mock = $this->getMock(
            $classToMock,
            $methodsToMock,
            $mockConstructorParams,
            $mockClassName,
            $callMockConstructor
        );

        $mock->expects($this->any())
            ->method('call')
            ->will($this->returnValue($mockResponse));

        $sl = new SpotifyLookup($mock);
        $result = $sl->search('abc:qwe:123');

        $this->assertTrue(is_array($result));
        $this->assertEquals('spotify:artist:4pejUc4iciQfgdX6OKulQn', $result['href']);
        $this->assertEquals('Queens Of The Stone Age', $result['name']);

        $this->assertEquals($sl->getResultInfo(), array('type'=> 'artist'));
        $this->assertEquals($sl->getResultType(), 'artist');
    }
}