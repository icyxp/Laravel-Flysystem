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

use Icyboy\Flysystem\Adapters\ZipConnector;
use Icyboy\TestBench\AbstractTestCase;
use League\Flysystem\ZipArchive\ZipArchiveAdapter;

/**
 * This is the zip connector test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ZipConnectorTest extends AbstractTestCase
{
    public function testConnectStandard()
    {
        $connector = $this->getZipConnector();

        $return = $connector->connect(['path' => __DIR__.'\stubs\test.zip']);

        $this->assertInstanceOf(ZipArchiveAdapter::class, $return);
    }

    public function testConnectWithPrefix()
    {
        $connector = $this->getZipConnector();

        $return = $connector->connect(['path' => __DIR__.'\stubs\test.zip', 'prefix' => 'your-prefix']);

        $this->assertInstanceOf(ZipArchiveAdapter::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The zip connector requires path configuration.
     */
    public function testConnectWithoutPath()
    {
        $connector = $this->getZipConnector();

        $connector->connect([]);
    }

    protected function getZipConnector()
    {
        return new ZipConnector();
    }
}
