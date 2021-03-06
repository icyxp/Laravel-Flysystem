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

use Icyboy\Flysystem\Adapters\WebDavConnector;
use Icyboy\TestBench\AbstractTestCase;
use League\Flysystem\WebDAV\WebDAVAdapter;

/**
 * This is the webdav connector test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class WebDavConnectorTest extends AbstractTestCase
{
    public function testConnect()
    {
        $connector = $this->getWebDavConnector();

        $return = $connector->connect([
            'baseUri'  => 'http://example.org/dav/',
            'userName' => 'your-username',
            'password' => 'your-password',
        ]);

        $this->assertInstanceOf(WebDAVAdapter::class, $return);
    }

    public function testConnectWithPrefix()
    {
        $connector = $this->getWebDavConnector();

        $return = $connector->connect([
            'baseUri'  => 'http://example.org/dav/',
            'userName' => 'your-username',
            'password' => 'your-password',
            'prefix'   => 'your-prefix',
        ]);

        $this->assertInstanceOf(WebDAVAdapter::class, $return);
    }

    protected function getWebDavConnector()
    {
        return new WebDavConnector();
    }
}
