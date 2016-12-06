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

use Icyboy\Flysystem\Adapters\AzureConnector;
use Icyboy\TestBench\AbstractTestCase;
use League\Flysystem\Azure\AzureAdapter;

/**
 * This is the adapter connector test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class AzureConnectorTest extends AbstractTestCase
{
    public function testConnectStandard()
    {
        $connector = $this->getAzureConnector();

        $return = $connector->connect([
            'account-name' => 'your-account-name',
            'api-key'      => 'eW91ci1hcGkta2V5',
            'container'    => 'your-container',
        ]);

        $this->assertInstanceOf(AzureAdapter::class, $return);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The azure connector requires authentication.
     */
    public function testConnectWithoutAccountName()
    {
        $connector = $this->getAzureConnector();

        $connector->connect([
            'api-key'   => 'eW91ci1hcGkta2V5',
            'container' => 'your-container',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The azure connector requires authentication.
     */
    public function testConnectWithoutApiKey()
    {
        $connector = $this->getAzureConnector();

        $connector->connect([
            'account-name' => 'your-account-name',
            'container'    => 'your-container',
        ]);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage The azure connector requires container configuration.
     */
    public function testConnectWithoutContainer()
    {
        $connector = $this->getAzureConnector();

        $connector->connect([
            'account-name' => 'your-account-name',
            'api-key'      => 'eW91ci1hcGkta2V5',
        ]);
    }

    protected function getAzureConnector()
    {
        if (!class_exists(AzureAdapter::class)) {
            $this->markTestSkipped('The AzureAdapter class does not exist');
        }

        return new AzureConnector();
    }
}
