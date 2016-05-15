<?php
namespace AppBundle\Service;

use Ideato\FlickrApi\Wrapper\FlickrApi;

/**
 * Created by PhpStorm.
 * User: hoyakku
 * Date: 15/05/2016
 * Time: 3:41 PM
 */
class CustomFlickrApi extends FlickrApi
{
    //flickr.tags.getClusterPhotos
    public function getTagsClusterPhotos($tags) {
        $url = $this->buildBaseUrl('flickr.tags.getClusterPhotos', '&tag=' . $tags);
        $results = $this->curl->get($url);
        $xml = \simplexml_load_string($results);

        if (!$xml || count($xml->photos->photo) <= 0)
        {
            return null;
        }

        return $xml->photos;
    }

    public function buildFlickPhotoUrl($singlePhoto){
        $farm = $singlePhoto->attributes()->farm;
        $serverId = $singlePhoto->attributes()->server;
        $photoId = $singlePhoto->attributes()->id;
        $secretKey = $singlePhoto->attributes()->secret;

        return 'https://farm' . $farm . '.staticflickr.com/' . $serverId . '/' . $photoId . '_' . $secretKey . '.jpg';
    }
}