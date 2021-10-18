<?php

namespace app\components;

class CatOrDog
{
    private $cat = false;

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCatOrDog($command)
    {
        if (strcasecmp(mb_strtolower($command), "кот") == 0) {
            $url = 'https://api.thecatapi.com/v1/images/search';
            $this->cat = true;
        } elseif (strcasecmp(mb_strtolower($command), "пес") == 0) {
            $url = 'https://dog.ceo/api/breeds/image/random';
            $this->cat = false;
        } else {
            $url = null;
        }

        if ($url != null) {
            $client = new \GuzzleHttp\Client([
                'base_uri' => $url,
            ]);
            $result = $client->request('GET');
            $url = $this->cat ? json_decode($result->getBody())[0]->url : json_decode($result->getBody())->message;
        }
        return $url;
    }
}