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

    public function testSettersAndGetters() {

        $classToMock            = '\SpotifyLib\SpotifyApi';
        $methodsToMock          = array('__getFunctions');
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

        $this->assertEquals('123453', $sl->getUri());
        $this->assertEquals($mock, $sl->getApi());
    }

}