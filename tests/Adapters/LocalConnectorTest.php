<?php

/*
 * This file is part of Laravel Flysystem.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icyboy\Tests\Flysystem\Adapters;

use Icyboy\Flysystem\Adapters\LocalConnector;
use Icyboy\TestBench\AbstractTestCase;
use League\Flysystem\Adapter\Local;

/**
 * This is the local connector test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class LocalConnectorTest extends AbstractTestCase
{
    public function testConnectStandard()
    {
        $connector = $this->getLocalConnector();

        $return = $connector->connect(['path' => __DIR__]);

        $this->assertInstanceOf(Local::class, $return);
    }

    public function testConnectWithPrefix()
    {
        $connector = $this->getLocalConnector();

        $return = $connector->connect(['path' => __DIR__, 'prefix' => 'your-prefix']);

        $this->assertInstanceOf(Local::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The local connector requires path configuration.
     */
    public function testConnectWithoutPath()
    {
        $connector = $this->getLocalConnector();

        $connector->connect([]);
    }

    protected function getLocalConnector()
    {
        return new LocalConnector();
    }
}
