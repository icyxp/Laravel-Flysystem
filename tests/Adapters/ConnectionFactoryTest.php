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

use Icyboy\Flysystem\Adapters\AwsS3Connector;
use Icyboy\Flysystem\Adapters\AzureConnector;
use Icyboy\Flysystem\Adapters\ConnectionFactory;
use Icyboy\Flysystem\Adapters\CopyConnector;
use Icyboy\Flysystem\Adapters\DropboxConnector;
use Icyboy\Flysystem\Adapters\FtpConnector;
use Icyboy\Flysystem\Adapters\GridFSConnector;
use Icyboy\Flysystem\Adapters\LocalConnector;
use Icyboy\Flysystem\Adapters\NullConnector;
use Icyboy\Flysystem\Adapters\RackspaceConnector;
use Icyboy\Flysystem\Adapters\SftpConnector;
use Icyboy\Flysystem\Adapters\WebDavConnector;
use Icyboy\Flysystem\Adapters\ZipConnector;
use Icyboy\TestBench\AbstractTestCase;
use League\Flysystem\Adapter\Local;
use League\Flysystem\AdapterInterface;
use Mockery;

/**
 * This is the adapter connection factory test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ConnectionFactoryTest extends AbstractTestCase
{
    public function testMake()
    {
        $factory = $this->getMockedFactory();

        $return = $factory->make(['driver' => 'local', 'path' => __DIR__, 'name' => 'local']);

        $this->assertInstanceOf(AdapterInterface::class, $return);
    }

    public function createDataProvider()
    {
        return [
            ['awss3', AwsS3Connector::class],
            ['azure', AzureConnector::class],
            ['copy', CopyConnector::class],
            ['dropbox', DropboxConnector::class],
            ['ftp', FtpConnector::class],
            ['gridfs', GridFSConnector::class],
            ['local', LocalConnector::class],
            ['null', NullConnector::class],
            ['rackspace', RackspaceConnector::class],
            ['sftp', SftpConnector::class],
            ['webdav', WebDavConnector::class],
            ['zip', ZipConnector::class],
        ];
    }

    /**
     * @dataProvider createDataProvider
     */
    public function testCreateWorkingDriver($driver, $class)
    {
        $factory = $this->getConnectionFactory();

        $return = $factory->createConnector(['driver' => $driver]);

        $this->assertInstanceOf($class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage A driver must be specified.
     */
    public function testCreateEmptyDriverConnector()
    {
        $factory = $this->getConnectionFactory();

        $factory->createConnector([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Unsupported driver [unsupported].
     */
    public function testCreateUnsupportedDriverConnector()
    {
        $factory = $this->getConnectionFactory();

        $factory->createConnector(['driver' => 'unsupported']);
    }

    protected function getConnectionFactory()
    {
        return new ConnectionFactory();
    }

    protected function getMockedFactory()
    {
        $mock = Mockery::mock(ConnectionFactory::class.'[createConnector]');

        $connector = Mockery::mock(LocalConnector::class);

        $connector->shouldReceive('connect')->once()
            ->with(['name' => 'local', 'driver' => 'local', 'path' => __DIR__])
            ->andReturn(Mockery::mock(Local::class));

        $mock->shouldReceive('createConnector')->once()
            ->with(['name' => 'local', 'driver' => 'local', 'path' => __DIR__])
            ->andReturn($connector);

        return $mock;
    }
}
