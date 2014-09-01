<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 26/03/2014
 * Time: 23:05
 */

namespace Swifty\Spotify;

class SearchTest extends \PHPUnit_Framework_TestCase {

    public function testSettersAndGetters()
    {
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

        $search = new Search($mock);

        $artist     = '65daysofstatic';
        $album      = 'We were exploding away';
        $track      = 'Tiger Girl';
        $pageNumber = 12;

        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setAPI($mock));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setAlbum($album));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setAlbumSearchResult(array()));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setAlbumSearchResultInfo(array()));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setArtist($artist));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setArtistSearchResult(array()));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setArtistSearchResultInfo(array()));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setTrack($track));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setTrackSearchResult(array()));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setTrackSearchResultInfo(array()));
        $this->assertInstanceOf('Swifty\Spotify\Search', $search->setPageNumber($pageNumber));

        $this->assertEquals($mock, $search->getAPI());
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
        $classToMock            = '\Swifty\Spotify\API';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('search', 1);
        $mockClassName          = 'SearchArtistAPI';
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

        $search = new Search($mock);

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
        $classToMock            = '\Swifty\Spotify\API';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('search', 1);
        $mockClassName          = 'SearchAlbumAPI';
        $callMockConstructor    = true;
        $mockResponse           = array(
            'info' => array(
                "num_results" => 34,
                "limit" => 100,
                "offset" => 0,
                "query" => "foo",
                "type" => "albums",
                "page" => 1
            ),
            'albums' => array(
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

        $search = new Search($mock);

        $result = $search->searchAlbum('test');

        $this->assertTrue(is_array($result));
        $this->assertEquals($mockResponse['info'], $search->getAlbumSearchResultInfo());
        $this->assertTrue(is_array($result[0]));
        $this->assertTrue(array_key_exists('href', $result[0]));
        $this->assertTrue(array_key_exists('name', $result[0]));
    }

    /**
     * test searching for a track
     */
    public function testSearchTrack()
    {
        $classToMock            = '\Swifty\Spotify\API';
        $methodsToMock          = array('call');
        $mockConstructorParams  = array('search', 1);
        $mockClassName          = 'SearchTrackAPI';
        $callMockConstructor    = true;
        $mockResponse           = array(
            'info' => array(
                "num_results" => 34,
                "limit" => 100,
                "offset" => 0,
                "query" => "foo",
                "type" => "tracks",
                "page" => 1
            ),
            'tracks' => array(
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

        $search = new Search($mock);

        $result = $search->searchTrack('test');

        $this->assertTrue(is_array($result));
        $this->assertEquals($mockResponse['info'], $search->getTrackSearchResultInfo());
        $this->assertTrue(is_array($result[0]));
        $this->assertTrue(array_key_exists('href', $result[0]));
        $this->assertTrue(array_key_exists('name', $result[0]));
    }
}
