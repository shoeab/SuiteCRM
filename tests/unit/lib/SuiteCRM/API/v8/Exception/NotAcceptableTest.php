<?php

namespace SuiteCRM\Exception;

use Psr\Log\LogLevel;
use SuiteCRM\API\v8\Exception\ApiException;
use SuiteCRM\API\v8\Exception\NotAcceptable;

class NotAcceptableTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**#
     * @var ApiException $exception
     */
    private static $exception;

    protected function _before()
    {
        if(self::$exception === null) {
            self::$exception = new NotAcceptable();
        }
    }

    protected function _after()
    {
    }

    public function testGetMessage()
    {
        $this->assertEquals('[SuiteCRM] [API] [Not Acceptable] ', self::$exception->getMessage());
    }

    public function testGetSetDetail()
    {
        $this->assertEquals('Json API expects the "Accept" header to be application/vnd.api+json', self::$exception->getDetail());
    }

    public function testGetSetSource()
    {
        self::$exception->setSource('/data');
        $this->assertSame(array('pointer' => '/data'), self::$exception->getSource());
    }

    public function testGetHttpStatus()
    {
        $this->assertEquals(406, self::$exception->getHttpStatus());
    }
}