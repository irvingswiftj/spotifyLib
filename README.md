spotifyLib
==========

PHP Library for using Spotify's API

##Usage

Here are some examples:

###Dependancies

Please run composer.json to install required dependencies


This need to be in the top of your file
```
require 'vendor/autoload.php';
require "SpotifyApi.php";
```


###Using the search api

```
require "SpotifySearch.php";

//create a new instance of the spotify api with the service set to 'lookup'
$searchApi = new \SpotifyLib\SpotifyApi('search',1);

//create a new SpotifyLookup class instance and inject our spotify api instance
$search = new \SpotifyLib\SpotifySearch($searchApi);

//Search for an artist
$artist = 'Foo Fighters';

echo "search results for $artist:";

$result = $search->searchArtist($artist);

var_dump($result);


//Search for an album
$album = 'Take this to the skies';

echo "search results for $album:";

$result = $search->searchAlbum($album);

var_dump($result);


//Search for a track
$track = 'New Pin';

echo "search results for $track:";

$result = $search->searchTrack($track);

var_dump($result);
```

###Using the lookup api
```
require "SpotifyLookup.php";

//create a new instance of the spotify api with the service set to 'lookup'
$Api = new \SpotifyLib\SpotifyApi('lookup',1);

//create a new SpotifyLookup class instance and inject our spotify api instance
$lookup = new \SpotifyLib\SpotifyLookup($Api);

$uri = "spotify:artist:7jy3rLJdDQY21OgRLCZ9sD";

echo "lookup result for $uri:";

$result = $lookup->search($uri);

var_dump($result);
```



##Testing

Unit tests can be found in the test directory and PHPUnit can be run for the root directory

##Credits
- [irvingswiftj](https://github.com/:irvingswiftj)
- [All Contributors](https://github.com/irvingswiftj/spotifyLib/contributors)

##License
The BSD License. Please see [License File](https://github.com/irvingswiftj/spotifyLib/blob/master/LICENSE) for more information.