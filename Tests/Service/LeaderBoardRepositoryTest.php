<?php

namespace Slavamuravey\LeaderBoardBundle\Tests\Service;

use Slavamuravey\LeaderBoardBundle\Service\DataLoader;
use Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface;
use Slavamuravey\LeaderBoardBundle\Service\LeaderBoardRepository;

class LeaderBoardRepositoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFindAll()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"OK","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findAll();

        $expected = [
            0 =>
                [
                    'place' => 1,
                    'score' => 1000000,
                    'id' => 123456,
                    'name' => 'Vasya Pupkin0',
                    'avatar' => 'http://.../avatar0.jpg',
                ],
            1 =>
                [
                    'place' => 2,
                    'score' => 1000000,
                    'id' => 123457,
                    'name' => 'Vasya Pupkin0',
                    'avatar' => 'http://.../avatar1.jpg',
                ],
            2 =>
                [
                    'place' => 3,
                    'score' => 1000000,
                    'id' => 123458,
                    'name' => 'Vasya Pupkin1',
                    'avatar' => 'http://.../avatar2.jpg',
                ],
            3 =>
                [
                    'place' => 4,
                    'score' => 1000000,
                    'id' => 123459,
                    'name' => 'Vasya Pupkin1',
                    'avatar' => 'http://.../avatar3.jpg',
                ],
            4 =>
                [
                    'place' => 5,
                    'score' => 1000000,
                    'id' => 123460,
                    'name' => 'Vasya Pupkin2',
                    'avatar' => 'http://.../avatar4.jpg',
                ],
            5 =>
                [
                    'place' => 6,
                    'score' => 1000000,
                    'id' => 123461,
                    'name' => 'Vasya Pupkin2',
                    'avatar' => 'http://.../avatar5.jpg',
                ],
            6 =>
                [
                    'place' => 7,
                    'score' => 1000000,
                    'id' => 123462,
                    'name' => 'Vasya Pupkin3',
                    'avatar' => 'http://.../avatar6.jpg',
                ],
            7 =>
                [
                    'place' => 8,
                    'score' => 1000000,
                    'id' => 123463,
                    'name' => 'Vasya Pupkin3',
                    'avatar' => 'http://.../avatar7.jpg',
                ],
            8 =>
                [
                    'place' => 9,
                    'score' => 1000000,
                    'id' => 123464,
                    'name' => 'Vasya Pupkin4',
                    'avatar' => 'http://.../avatar8.jpg',
                ],
            9 =>
                [
                    'place' => 10,
                    'score' => 1000000,
                    'id' => 123465,
                    'name' => 'Vasya Pupkin4',
                    'avatar' => 'http://.../avatar9.jpg',
                ],
            10 =>
                [
                    'place' => 11,
                    'score' => 1000000,
                    'id' => 123466,
                    'name' => 'Vasya Pupkin5',
                    'avatar' => 'http://.../avatar10.jpg',
                ],
            11 =>
                [
                    'place' => 12,
                    'score' => 1000000,
                    'id' => 123467,
                    'name' => 'Vasya Pupkin5',
                    'avatar' => 'http://.../avatar11.jpg',
                ],
            12 =>
                [
                    'place' => 13,
                    'score' => 1000000,
                    'id' => 123468,
                    'name' => 'Vasya Pupkin6',
                    'avatar' => 'http://.../avatar12.jpg',
                ],
            13 =>
                [
                    'place' => 14,
                    'score' => 1000000,
                    'id' => 123469,
                    'name' => 'Vasya Pupkin6',
                    'avatar' => 'http://.../avatar13.jpg',
                ],
            14 =>
                [
                    'place' => 15,
                    'score' => 1000000,
                    'id' => 123470,
                    'name' => 'Vasya Pupkin7',
                    'avatar' => 'http://.../avatar14.jpg',
                ],
            15 =>
                [
                    'place' => 16,
                    'score' => 1000000,
                    'id' => 123471,
                    'name' => 'Vasya Pupkin7',
                    'avatar' => 'http://.../avatar15.jpg',
                ],
            16 =>
                [
                    'place' => 17,
                    'score' => 1000000,
                    'id' => 123472,
                    'name' => 'Vasya Pupkin8',
                    'avatar' => 'http://.../avatar16.jpg',
                ],
            17 =>
                [
                    'place' => 18,
                    'score' => 1000000,
                    'id' => 123473,
                    'name' => 'Vasya Pupkin8',
                    'avatar' => 'http://.../avatar17.jpg',
                ],
            18 =>
                [
                    'place' => 19,
                    'score' => 1000000,
                    'id' => 123474,
                    'name' => 'Vasya Pupkin9',
                    'avatar' => 'http://.../avatar18.jpg',
                ],
            19 =>
                [
                    'place' => 20,
                    'score' => 1000000,
                    'id' => 123475,
                    'name' => 'Vasya Pupkin9',
                    'avatar' => 'http://.../avatar19.jpg',
                ],
            20 =>
                [
                    'place' => 21,
                    'score' => 1000000,
                    'id' => 123476,
                    'name' => 'Vasya Pupkin10',
                    'avatar' => 'http://.../avatar20.jpg',
                ],
            21 =>
                [
                    'place' => 22,
                    'score' => 1000000,
                    'id' => 123477,
                    'name' => 'Vasya Pupkin10',
                    'avatar' => 'http://.../avatar21.jpg',
                ],
            22 =>
                [
                    'place' => 23,
                    'score' => 1000000,
                    'id' => 123478,
                    'name' => 'Vasya Pupkin11',
                    'avatar' => 'http://.../avatar22.jpg',
                ],
            23 =>
                [
                    'place' => 24,
                    'score' => 1000000,
                    'id' => 123479,
                    'name' => 'Vasya Pupkin11',
                    'avatar' => 'http://.../avatar23.jpg',
                ],
            24 =>
                [
                    'place' => 25,
                    'score' => 1000000,
                    'id' => 123480,
                    'name' => 'Vasya Pupkin12',
                    'avatar' => 'http://.../avatar24.jpg',
                ],
            25 =>
                [
                    'place' => 26,
                    'score' => 1000000,
                    'id' => 123481,
                    'name' => 'Vasya Pupkin12',
                    'avatar' => 'http://.../avatar25.jpg',
                ],
            26 =>
                [
                    'place' => 27,
                    'score' => 1000000,
                    'id' => 123482,
                    'name' => 'Vasya Pupkin13',
                    'avatar' => 'http://.../avatar26.jpg',
                ],
            27 =>
                [
                    'place' => 28,
                    'score' => 1000000,
                    'id' => 123483,
                    'name' => 'Vasya Pupkin13',
                    'avatar' => 'http://.../avatar27.jpg',
                ],
            28 =>
                [
                    'place' => 29,
                    'score' => 1000000,
                    'id' => 123484,
                    'name' => 'Vasya Pupkin14',
                    'avatar' => 'http://.../avatar28.jpg',
                ],
            29 =>
                [
                    'place' => 30,
                    'score' => 1000000,
                    'id' => 123485,
                    'name' => 'Vasya Pupkin14',
                    'avatar' => 'http://.../avatar29.jpg',
                ],
            30 =>
                [
                    'place' => 31,
                    'score' => 1000000,
                    'id' => 123486,
                    'name' => 'Vasya Pupkin15',
                    'avatar' => 'http://.../avatar30.jpg',
                ],
            31 =>
                [
                    'place' => 32,
                    'score' => 1000000,
                    'id' => 123487,
                    'name' => 'Vasya Pupkin15',
                    'avatar' => 'http://.../avatar31.jpg',
                ],
            32 =>
                [
                    'place' => 33,
                    'score' => 1000000,
                    'id' => 123488,
                    'name' => 'Vasya Pupkin16',
                    'avatar' => 'http://.../avatar32.jpg',
                ],
            33 =>
                [
                    'place' => 34,
                    'score' => 1000000,
                    'id' => 123489,
                    'name' => 'Vasya Pupkin16',
                    'avatar' => 'http://.../avatar33.jpg',
                ],
            34 =>
                [
                    'place' => 35,
                    'score' => 1000000,
                    'id' => 123490,
                    'name' => 'Vasya Pupkin17',
                    'avatar' => 'http://.../avatar34.jpg',
                ],
            35 =>
                [
                    'place' => 36,
                    'score' => 1000000,
                    'id' => 123491,
                    'name' => 'Vasya Pupkin17',
                    'avatar' => 'http://.../avatar35.jpg',
                ],
            36 =>
                [
                    'place' => 37,
                    'score' => 1000000,
                    'id' => 123492,
                    'name' => 'Vasya Pupkin18',
                    'avatar' => 'http://.../avatar36.jpg',
                ],
            37 =>
                [
                    'place' => 38,
                    'score' => 1000000,
                    'id' => 123493,
                    'name' => 'Vasya Pupkin18',
                    'avatar' => 'http://.../avatar37.jpg',
                ],
            38 =>
                [
                    'place' => 39,
                    'score' => 1000000,
                    'id' => 123494,
                    'name' => 'Vasya Pupkin19',
                    'avatar' => 'http://.../avatar38.jpg',
                ],
            39 =>
                [
                    'place' => 40,
                    'score' => 1000000,
                    'id' => 123495,
                    'name' => 'Vasya Pupkin19',
                    'avatar' => 'http://.../avatar39.jpg',
                ],
            40 =>
                [
                    'place' => 41,
                    'score' => 1000000,
                    'id' => 123496,
                    'name' => 'Vasya Pupkin20',
                    'avatar' => 'http://.../avatar40.jpg',
                ],
            41 =>
                [
                    'place' => 42,
                    'score' => 1000000,
                    'id' => 123497,
                    'name' => 'Vasya Pupkin20',
                    'avatar' => 'http://.../avatar41.jpg',
                ],
            42 =>
                [
                    'place' => 43,
                    'score' => 1000000,
                    'id' => 123498,
                    'name' => 'Vasya Pupkin21',
                    'avatar' => 'http://.../avatar42.jpg',
                ],
            43 =>
                [
                    'place' => 44,
                    'score' => 1000000,
                    'id' => 123499,
                    'name' => 'Vasya Pupkin21',
                    'avatar' => 'http://.../avatar43.jpg',
                ],
            44 =>
                [
                    'place' => 45,
                    'score' => 1000000,
                    'id' => 123500,
                    'name' => 'Vasya Pupkin22',
                    'avatar' => 'http://.../avatar44.jpg',
                ],
            45 =>
                [
                    'place' => 46,
                    'score' => 1000000,
                    'id' => 123501,
                    'name' => 'Vasya Pupkin22',
                    'avatar' => 'http://.../avatar45.jpg',
                ],
            46 =>
                [
                    'place' => 47,
                    'score' => 1000000,
                    'id' => 123502,
                    'name' => 'Vasya Pupkin23',
                    'avatar' => 'http://.../avatar46.jpg',
                ],
            47 =>
                [
                    'place' => 48,
                    'score' => 1000000,
                    'id' => 123503,
                    'name' => 'Vasya Pupkin23',
                    'avatar' => 'http://.../avatar47.jpg',
                ],
            48 =>
                [
                    'place' => 49,
                    'score' => 1000000,
                    'id' => 123504,
                    'name' => 'Vasya Pupkin24',
                    'avatar' => 'http://.../avatar48.jpg',
                ],
            49 =>
                [
                    'place' => 50,
                    'score' => 1000000,
                    'id' => 123505,
                    'name' => 'Vasya Pupkin24',
                    'avatar' => 'http://.../avatar49.jpg',
                ],
        ];

        $this->assertEquals($expected, $data);
    }

    /**
     * @expectedException \Slavamuravey\LeaderBoardBundle\Service\Exception\LeaderBoardStatusErrorException
     */
    public function testFindAllStatusError()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"DB_ERROR","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findAll();
    }

    public function testFindBy1()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"OK","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findBy(['name' => 'Vasya Pupkin3']);

        $expected = [
            [
                'place' => 7,
                'score' => 1000000,
                'id' => 123462,
                'name' => 'Vasya Pupkin3',
                'avatar' => 'http://.../avatar6.jpg',
            ],
            [
                'place' => 8,
                'score' => 1000000,
                'id' => 123463,
                'name' => 'Vasya Pupkin3',
                'avatar' => 'http://.../avatar7.jpg',
            ],
        ];

        $this->assertEquals($expected, $data);
    }

    public function testFindBy2()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"OK","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findBy(['name' => 'Vasya Pupkin3', 'place' => 8]);

        $expected = [
            [
                'place' => 8,
                'score' => 1000000,
                'id' => 123463,
                'name' => 'Vasya Pupkin3',
                'avatar' => 'http://.../avatar7.jpg',
            ],
        ];

        $this->assertEquals($expected, $data);
    }

    public function testFindMinBy()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"OK","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findMinBy('id');

        $expected = [
            [
                'place' => 1,
                'score' => 1000000,
                'id' => 123456,
                'name' => 'Vasya Pupkin0',
                'avatar' => 'http://.../avatar0.jpg',
            ],
        ];

        $this->assertEquals($expected, $data);
    }

    public function testFindMaxBy()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"OK","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findMaxBy('id');

        $expected = [
            [
                'place' => 50,
                'score' => 1000000,
                'id' => 123505,
                'name' => 'Vasya Pupkin24',
                'avatar' => 'http://.../avatar49.jpg',
            ],
        ];

        $this->assertEquals($expected, $data);
    }

    public function testFindByLimitOffset()
    {
        $url = 'http://example.com/leaderboard';

        /** @var \PHPUnit_Framework_MockObject_MockObject|FormatDataLoaderInterface $formatDataLoader */
        $formatDataLoader = $this
            ->getMockBuilder('Slavamuravey\LeaderBoardBundle\Service\FormatDataLoaderInterface')
            ->setMethods(['load'])
            ->getMock();

        $json = <<<JSON
{"status":"OK","leaderboard":[{"place":1,"score":1000000,"id":123456,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar0.jpg"},{"place":2,"score":1000000,"id":123457,"name":"Vasya Pupkin0","avatar":"http:\/\/...\/avatar1.jpg"},{"place":3,"score":1000000,"id":123458,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar2.jpg"},{"place":4,"score":1000000,"id":123459,"name":"Vasya Pupkin1","avatar":"http:\/\/...\/avatar3.jpg"},{"place":5,"score":1000000,"id":123460,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar4.jpg"},{"place":6,"score":1000000,"id":123461,"name":"Vasya Pupkin2","avatar":"http:\/\/...\/avatar5.jpg"},{"place":7,"score":1000000,"id":123462,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar6.jpg"},{"place":8,"score":1000000,"id":123463,"name":"Vasya Pupkin3","avatar":"http:\/\/...\/avatar7.jpg"},{"place":9,"score":1000000,"id":123464,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar8.jpg"},{"place":10,"score":1000000,"id":123465,"name":"Vasya Pupkin4","avatar":"http:\/\/...\/avatar9.jpg"},{"place":11,"score":1000000,"id":123466,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar10.jpg"},{"place":12,"score":1000000,"id":123467,"name":"Vasya Pupkin5","avatar":"http:\/\/...\/avatar11.jpg"},{"place":13,"score":1000000,"id":123468,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar12.jpg"},{"place":14,"score":1000000,"id":123469,"name":"Vasya Pupkin6","avatar":"http:\/\/...\/avatar13.jpg"},{"place":15,"score":1000000,"id":123470,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar14.jpg"},{"place":16,"score":1000000,"id":123471,"name":"Vasya Pupkin7","avatar":"http:\/\/...\/avatar15.jpg"},{"place":17,"score":1000000,"id":123472,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar16.jpg"},{"place":18,"score":1000000,"id":123473,"name":"Vasya Pupkin8","avatar":"http:\/\/...\/avatar17.jpg"},{"place":19,"score":1000000,"id":123474,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar18.jpg"},{"place":20,"score":1000000,"id":123475,"name":"Vasya Pupkin9","avatar":"http:\/\/...\/avatar19.jpg"},{"place":21,"score":1000000,"id":123476,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar20.jpg"},{"place":22,"score":1000000,"id":123477,"name":"Vasya Pupkin10","avatar":"http:\/\/...\/avatar21.jpg"},{"place":23,"score":1000000,"id":123478,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar22.jpg"},{"place":24,"score":1000000,"id":123479,"name":"Vasya Pupkin11","avatar":"http:\/\/...\/avatar23.jpg"},{"place":25,"score":1000000,"id":123480,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar24.jpg"},{"place":26,"score":1000000,"id":123481,"name":"Vasya Pupkin12","avatar":"http:\/\/...\/avatar25.jpg"},{"place":27,"score":1000000,"id":123482,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar26.jpg"},{"place":28,"score":1000000,"id":123483,"name":"Vasya Pupkin13","avatar":"http:\/\/...\/avatar27.jpg"},{"place":29,"score":1000000,"id":123484,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar28.jpg"},{"place":30,"score":1000000,"id":123485,"name":"Vasya Pupkin14","avatar":"http:\/\/...\/avatar29.jpg"},{"place":31,"score":1000000,"id":123486,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar30.jpg"},{"place":32,"score":1000000,"id":123487,"name":"Vasya Pupkin15","avatar":"http:\/\/...\/avatar31.jpg"},{"place":33,"score":1000000,"id":123488,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar32.jpg"},{"place":34,"score":1000000,"id":123489,"name":"Vasya Pupkin16","avatar":"http:\/\/...\/avatar33.jpg"},{"place":35,"score":1000000,"id":123490,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar34.jpg"},{"place":36,"score":1000000,"id":123491,"name":"Vasya Pupkin17","avatar":"http:\/\/...\/avatar35.jpg"},{"place":37,"score":1000000,"id":123492,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar36.jpg"},{"place":38,"score":1000000,"id":123493,"name":"Vasya Pupkin18","avatar":"http:\/\/...\/avatar37.jpg"},{"place":39,"score":1000000,"id":123494,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar38.jpg"},{"place":40,"score":1000000,"id":123495,"name":"Vasya Pupkin19","avatar":"http:\/\/...\/avatar39.jpg"},{"place":41,"score":1000000,"id":123496,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar40.jpg"},{"place":42,"score":1000000,"id":123497,"name":"Vasya Pupkin20","avatar":"http:\/\/...\/avatar41.jpg"},{"place":43,"score":1000000,"id":123498,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar42.jpg"},{"place":44,"score":1000000,"id":123499,"name":"Vasya Pupkin21","avatar":"http:\/\/...\/avatar43.jpg"},{"place":45,"score":1000000,"id":123500,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar44.jpg"},{"place":46,"score":1000000,"id":123501,"name":"Vasya Pupkin22","avatar":"http:\/\/...\/avatar45.jpg"},{"place":47,"score":1000000,"id":123502,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar46.jpg"},{"place":48,"score":1000000,"id":123503,"name":"Vasya Pupkin23","avatar":"http:\/\/...\/avatar47.jpg"},{"place":49,"score":1000000,"id":123504,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar48.jpg"},{"place":50,"score":1000000,"id":123505,"name":"Vasya Pupkin24","avatar":"http:\/\/...\/avatar49.jpg"}]}
JSON;

        $formatDataLoader
            ->expects($this->once())
            ->method('load')
            ->with($url)
            ->willReturn(json_decode($json, true));

        $dataLoader = new DataLoader($formatDataLoader);
        $dataLoader->setUrl($url);

        $leaderBoardRepository = new LeaderBoardRepository($dataLoader);

        $data = $leaderBoardRepository->findBy([], null, null, 5, 2);

        $expected = [
            [
                'place' => 3,
                'score' => 1000000,
                'id' => 123458,
                'name' => 'Vasya Pupkin1',
                'avatar' => 'http://.../avatar2.jpg',
            ],
            [
                'place' => 4,
                'score' => 1000000,
                'id' => 123459,
                'name' => 'Vasya Pupkin1',
                'avatar' => 'http://.../avatar3.jpg',
            ],
            [
                'place' => 5,
                'score' => 1000000,
                'id' => 123460,
                'name' => 'Vasya Pupkin2',
                'avatar' => 'http://.../avatar4.jpg',
            ],
            [
                'place' => 6,
                'score' => 1000000,
                'id' => 123461,
                'name' => 'Vasya Pupkin2',
                'avatar' => 'http://.../avatar5.jpg',
            ],
            [
                'place' => 7,
                'score' => 1000000,
                'id' => 123462,
                'name' => 'Vasya Pupkin3',
                'avatar' => 'http://.../avatar6.jpg',
            ],
        ];

        $this->assertEquals($expected, $data);
    }
}
