<?php

namespace Slavamuravey\LeaderBoardBundle\Service;

class JsonDataLoader implements FormatDataLoaderInterface
{
    /**
     * @param string $url
     * @return array
     */
    public function load($url)
    {
        $data = file_get_contents($url);

        return json_decode($data, true);
    }
}