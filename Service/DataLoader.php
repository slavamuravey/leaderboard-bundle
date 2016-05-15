<?php

namespace Slavamuravey\LeaderBoardBundle\Service;

use Slavamuravey\LeaderBoardBundle\Service\Exception\LeaderBoardRootNotFoundException;
use Slavamuravey\LeaderBoardBundle\Service\Exception\LeaderBoardStatusErrorException;
use Slavamuravey\LeaderBoardBundle\Service\Exception\LeaderBoardStatusNotFoundException;
use Doctrine\Common\Cache\CacheProvider;

class DataLoader
{
    /**
     * @var JsonDataLoader
     */
    private $formatDataLoader;

    /**
     * @var CacheProvider
     */
    private $cache;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $root = 'leaderboard';

    /**
     * @var string
     */
    private $statusKey = 'status';

    /**
     * @var string
     */
    private $messageKey = 'message';

    /**
     * @var string
     */
    private $statusOk = 'OK';

    /**
     * @var int
     */
    private $ttl = 60;

    /**
     * @param FormatDataLoaderInterface $formatDataLoader
     * @param CacheProvider $cache
     */
    public function __construct(FormatDataLoaderInterface $formatDataLoader, CacheProvider $cache = null)
    {
        $this->formatDataLoader = $formatDataLoader;
        $this->cache = $cache;
    }

    /**
     * @return array
     */
    public function loadSourceData()
    {
        if (null === $this->cache) {
            return $this->formatDataLoader->load($this->getUrl());
        }

        $key = $this->getObjectKey();

        if (!$this->cache->contains($key)) {
            $this->cache->save($key, $this->formatDataLoader->load($this->getUrl()), $this->getTtl());
        }

        return $this->cache->fetch($key);
    }

    /**
     * @throws LeaderBoardRootNotFoundException
     * @throws LeaderBoardStatusNotFoundException
     * @throws LeaderBoardStatusErrorException
     * @return array
     */
    public function handleLoadedData()
    {
        $sourceData = $this->loadSourceData();
        $root = $this->getRoot();
        $statusKey = $this->getStatusKey();
        $messageKey = $this->getMessageKey();
        $key = $this->getObjectKey();

        if (!array_key_exists($root, $sourceData)) {
            $this->clearCache($key);
            throw new LeaderBoardRootNotFoundException('Leaderboard root not found');
        }

        if (!array_key_exists($statusKey, $sourceData)) {
            $this->clearCache($key);
            throw new LeaderBoardStatusNotFoundException('Leaderboard status not found');
        }

        $status = $sourceData[$statusKey];

        if ($sourceData[$statusKey] !== $this->getStatusOk()) {
            $this->clearCache($key);
            $message = array_key_exists($messageKey, $sourceData) ? $sourceData[$messageKey] : '';
            throw new LeaderBoardStatusErrorException("Leaderboard status error, code: '$status', message: '$message'");
        }

        return $sourceData[$root];
    }

    /**
     * @param string $key
     * @return bool
     */
    private function clearCache($key)
    {
        if (null === $this->cache) {
            return true;
        }

        return $this->cache->delete($key);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param string $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return string
     */
    public function getStatusKey()
    {
        return $this->statusKey;
    }

    /**
     * @param string $statusKey
     */
    public function setStatusKey($statusKey)
    {
        $this->statusKey = $statusKey;
    }

    /**
     * @return string
     */
    public function getMessageKey()
    {
        return $this->messageKey;
    }

    /**
     * @param string $messageKey
     */
    public function setMessageKey($messageKey)
    {
        $this->messageKey = $messageKey;
    }

    /**
     * @return string
     */
    public function getStatusOk()
    {
        return $this->statusOk;
    }

    /**
     * @param string $statusOk
     */
    public function setStatusOk($statusOk)
    {
        $this->statusOk = $statusOk;
    }

    /**
     * @return int
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param int $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
    }

    /**
     * @return string
     */
    private function getObjectKey()
    {
        return md5(serialize($this));
    }
}
