<?php

namespace Slavamuravey\LeaderBoardBundle\Service;

interface FormatDataLoaderInterface
{
    /**
     * @param string $url
     * @return array
     */
    public function load($url);
}