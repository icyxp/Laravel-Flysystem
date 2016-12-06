<?php

/*
 * This file is part of Laravel Flysystem.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icyboy\Tests\Flysystem\Facades;

use Icyboy\Flysystem\Facades\Flysystem;
use Icyboy\Flysystem\FlysystemManager;
use Icyboy\TestBenchCore\FacadeTrait;
use Icyboy\Tests\Flysystem\AbstractTestCase;

/**
 * This is the flysystem facade test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class FlysystemTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'flysystem';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Flysystem::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return FlysystemManager::class;
    }
}
