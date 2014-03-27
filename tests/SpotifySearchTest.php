<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 26/03/2014
 * Time: 23:05
 */

namespace SpotifyLib;

require_once 'SpotifySearch.php';

class SpotifySearchTest extends \PHPUnit_Framework_TestCase {

    public function testSettersAndGetters()
    {
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

        $search = new SpotifySearch($mock);

        $artist     = '65daysofstatic';
        $album      = 'We were exploding away';
        $track      = 'Tiger Girl';
        $pageNumber = 12;

        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setApi($mock));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setAlbum($album));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setAlbumSearchResult(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setAlbumSearchResultInfo(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setArtist($artist));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setArtistSearchResult(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setArtistSearchResultInfo(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setTrack($track));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setTrackSearchResult(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setTrackSearchResultInfo(array()));
        $this->assertInstanceOf('SpotifyLib\SpotifySearch', $search->setPageNumber($pageNumber));

        $this->assertEquals($mock, $search->getApi());
        $this->assertEquals($album, $search->getAlbum());
        $this->assertEquals(array(), $search->getAlbumSearchResult());
        $this->assertEquals(array(), $search->getAlbumSearchResultInfo());
        $this->assertEquals($artist, $search->getArtist());
        $this->assertEquals(array(), $search->getArtistSearchResult());
        $this->assertEquals(array(), $search->getArtistSearchResultInfo());
        $this->assertEquals($track, $search->getTrack());
        $this->assertEquals(array(), $search->getTrackSearchResult());
        $this->assertEquals(array(), $search->getTrackSearchResultInfo());

    }

    /**
     * test for searching for an artist
     */
    public function testSearchArtist()
    {
        $classToMock            = '\SpotifyLib\SpotifyApi';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('search', 1);
        $mockClassName          = 'SearchArtistApi';
        $callMockConstructor    = true;
        $mockResponse           = array(
            'info' => array(
                "num_results" => 34,
                "limit" => 100,
                "offset" => 0,
                "query" => "foo",
                "type" => "artist",
                "page" => 1
            ),
            'artists' => array(
                array(
                    'href' => 'spotify:artist:4pejUc4iciQfgdX6OKulQn',
                    'name' => 'Queens Of The Stone Age'
                ),
                array(
                    'href' => 'spotify:artist:testing',
                    'name' => 'froufrou'
                )
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

        $search = new SpotifySearch($mock);

        $result = $search->searchArtist('test');

        $this->assertTrue(is_array($result));
        $this->assertEquals($mockResponse['info'], $search->getArtistSearchResultInfo());
        $this->assertTrue(is_array($result[0]));
        $this->assertTrue(array_key_exists('href', $result[0]));
        $this->assertTrue(array_key_exists('name', $result[0]));
    }

    /**
     * test searching for an album
     */
    public function testSearchAlbum()
    {
        $classToMock            = '\SpotifyLib\SpotifyApi';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('search', 1);
        $mockClassName          = 'SearchAlbumApi';
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

        $search = new SpotifySearch($mock);

        $result = $search->searchAlbum('test');

        //TODO assert results
        //$this->assertTrue(is_array($result));
    }

    /**
     * test searching for a track
     */
    public function testSearchTrack()
    {
        $classToMock            = '\SpotifyLib\SpotifyApi';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('search', 1);
        $mockClassName          = 'SearchTrackApi';
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

        $search = new SpotifySearch($mock);

        $result = $search->searchTrack('test');

        //TODO assert results
        //$this->assertTrue(is_array($result));
    }
}
