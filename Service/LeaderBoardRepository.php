<?php

namespace Slavamuravey\LeaderBoardBundle\Service;

use Doctrine\Common\Cache\CacheProvider;

class LeaderBoardRepository
{
    const ORDER_ASC = 'asc';
    const ORDER_DESC = 'desc';

    /**
     * @var DataLoader
     */
    private $dataLoader;

    /**
     * @var CacheProvider
     */
    private $cache;

    /**
     * @param DataLoader $dataLoader
     * @param CacheProvider $cache
     */
    public function __construct(DataLoader $dataLoader, CacheProvider $cache = null)
    {
        $this->dataLoader = $dataLoader;
        $this->cache = $cache;
    }

    /**
     * @param array $criteria
     * @param null|string $orderField
     * @param null|string $direction
     * @param null|string $limit
     * @param null|string $offset
     * @return array
     */
    public function findBy(
        array $criteria,
        $orderField = null,
        $direction = null,
        $limit = null,
        $offset = null
    )
    {
        $outputArray = $this->findByCriteria($criteria);

        if (null !== $orderField) {
            $outputArray = $this->sortData($outputArray, $orderField, $direction);
        }

        if (null !== $limit) {
            $limit = (int)$limit;
            $limit = $limit >= 0 ? $limit : 0;
        } else {
            return $outputArray;
        }

        $offset = (int)$offset;
        $offset = $offset >= 0 ? $offset : 0;

        return array_slice($outputArray, $offset, $limit);
    }

    /**
     * @param array $criteria
     * @return array
     */
    private function findByCriteria(array $criteria)
    {
        $data = $this->findAll();
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($data));
        $outputArray = [];

        foreach ($iterator as $sub) {
            /** @var array|\Traversable $subIterator */
            $subIterator = $iterator->getSubIterator();
            $matched = true;
            foreach ($criteria as $key => $value) {
                if (!array_key_exists($key, $subIterator) || $subIterator[$key] !== $value) {
                    $matched = false;
                }
            }
            if ($matched) {
                $outputArray[] = iterator_to_array($subIterator);
            }
        }

        return $outputArray;
    }

    /**
     * @param array $outputArray
     * @param string $orderField
     * @param string $direction
     * @return array
     */
    private function sortData(array $outputArray, $orderField, $direction)
    {
        $invert = strtolower($direction) == self::ORDER_DESC ? -1 : 1;
        usort($outputArray, function ($a, $b) use ($orderField, $invert) {
            if (!array_key_exists($orderField, $a) || !array_key_exists($orderField, $a)) {
                return 0;
            }
            $valA = $a[$orderField];
            $valB = $b[$orderField];
            if ($valA == $valB) {
                return 0;
            }

            return $invert * (($valA < $valB) ? -1 : 1);
        });

        return $outputArray;
    }

    /**
     * @param array $criteria
     * @return array
     */
    public function findOneBy(array $criteria)
    {
        return $this->findBy($criteria, null, null, 1);
    }

    /**
     * @param string $field
     * @return array
     */
    public function findMinBy($field)
    {
        return $this->findBy([], $field, null, 1);
    }

    /**
     * @param string $field
     * @return array
     */
    public function findMaxBy($field)
    {
        return $this->findBy([], $field, self::ORDER_DESC, 1);
    }

    /**
     * @return array
     */
    public function findAll()
    {
        return $this->getDataLoader()->handleLoadedData();
    }

    /**
     * @return DataLoader
     */
    public function getDataLoader()
    {
        return $this->dataLoader;
    }
}