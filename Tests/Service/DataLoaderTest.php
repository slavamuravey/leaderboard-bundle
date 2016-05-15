<?php

namespace Slavamuravey\LeaderBoardBundle\Tests\Service;

use Slavamuravey\LeaderBoardBundle\Service\DataLoader;
use Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface;
use Doctrine\Common\Cache\CacheProvider;

class DataLoaderTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadSourceDataNoCache()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $url = 'http://example.com/leaderboard';

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(['some array']);

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $data = $dataLoader->loadSourceData();

        $this->assertEquals(['some array'], $data);
    }

    public function testLoadSourceDataCacheNotFound()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $url = 'http://example.com/leaderboard';

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(['some array']);

        /** @var \PHPUnit_Framework_MockObject_MockObject|CacheProvider $cache */
        $cache = $this
            ->getMockBuilder('Doctrine\Common\Cache\CacheProvider')
            ->setMethods(['contains', 'save', 'fetch'])
            ->getMockForAbstractClass();

        $cache
            ->expects($this->once())
            ->method('contains')
            ->withAnyParameters()
            ->willReturn(false);

        $cache
            ->expects($this->once())
            ->method('save');

        $cache
            ->expects($this->once())
            ->method('fetch')
            ->willReturn(['some array']);

        $dataLoader = new DataLoader($formatDataLoader, $cache);
        $dataLoader->setUrl($url);

        $data = $dataLoader->loadSourceData();

        $this->assertEquals(['some array'], $data);
    }

    public function testLoadSourceDataCacheFound()
    {
        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $url = 'http://example.com/leaderboard';

        $formatDataLoader
            ->expects($this->never())
            ->method('load')
            ->with($url)
            ->willReturn(['some array']);

        /** @var \PHPUnit_Framework_MockObject_MockObject|CacheProvider $cache */
        $cache = $this
            ->getMockBuilder('Doctrine\Common\Cache\CacheProvider')
            ->setMethods(['contains', 'save', 'fetch'])
            ->getMockForAbstractClass();

        $cache
            ->expects($this->once())
            ->method('contains')
            ->withAnyParameters()
            ->willReturn(true);

        $cache
            ->expects($this->never())
            ->method('save');

        $cache
            ->expects($this->once())
            ->method('fetch')
            ->willReturn(['some array']);

        $dataLoader = new DataLoader($formatDataLoader, $cache);
        $dataLoader->setUrl($url);

        $data = $dataLoader->loadSourceData();

        $this->assertEquals(['some array'], $data);
    }
}
