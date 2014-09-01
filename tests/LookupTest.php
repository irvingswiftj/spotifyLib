<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 22/03/2014
 * Time: 10:18
 */

namespace Swifty\Spotify;

class LookupTest extends \PHPUnit_Framework_TestCase {

    /**
     * test our setters and getters
     */
    public function testSettersAndGetters() {

        $classToMock            = '\Swifty\Spotify\API';
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

        $sl = new Lookup($mock);

        $this->assertInstanceOf('Swifty\Spotify\Lookup', $sl->setUri('123453'));
        $this->assertInstanceOf('Swifty\Spotify\Lookup', $sl->setAPI($mock));
        $this->assertInstanceOf('Swifty\Spotify\Lookup', $sl->setResult(array()));
        $this->assertInstanceOf('Swifty\Spotify\Lookup', $sl->setResultInfo(array()));
        $this->assertInstanceOf('Swifty\Spotify\Lookup', $sl->setResultType('type'));

        $this->assertEquals('123453', $sl->getUri());
        $this->assertEquals($mock, $sl->getAPI());
        $this->assertEquals(array(), $sl->getResult());
        $this->assertEquals(array(), $sl->getResultInfo());
        $this->assertEquals('type', $sl->getResultType());
    }

    /**
     * test the search method
     */
    public function testSearch()
    {
        $classToMock            = '\Swifty\Spotify\API';
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

        $sl = new Lookup($mock);
        $result = $sl->search('abc:qwe:123');

        $this->assertTrue(is_array($result));
        $this->assertEquals('spotify:artist:4pejUc4iciQfgdX6OKulQn', $result['href']);
        $this->assertEquals('Queens Of The Stone Age', $result['name']);

        $this->assertEquals($sl->getResultInfo(), array('type'=> 'artist'));
        $this->assertEquals($sl->getResultType(), 'artist');
    }
}
