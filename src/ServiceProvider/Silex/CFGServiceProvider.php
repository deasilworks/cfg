<?php

/*
 * MIT License
 *
 * Copyright (c) 2017 Deasil Works, Inc
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace deasilworks\CFG\ServiceProvider\Silex;

use deasilworks\CFG\Config;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Api\BootableProviderInterface;
use Silex\Application;

/**
 * Class APIServiceProvider.
 *
 * Responsible for providing API as a service to
 * the applications built on the Silex framework.
 */
class CFGServiceProvider extends ServiceProvider implements ServiceProviderInterface, BootableProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        // the config
        $container[$this->namespace.'.cfg'] = function ($container) {

            $config = new Config();

            $files = $container[$this->namespace.'.cfg.load_files'];

            foreach ($files as $file) {
                $config->loadYamlFile($file);
            }

            $appRoot = $container[$this->namespace.'.cfg.app_root'];
            if ($appRoot) {
                $config->set('app_root', $appRoot);
            }

            return $config;
        };
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app)
    {
        // populate app container if the configuration has an app key
        $config = $app[$this->namespace.'.cfg'];
        $appConfig = $config->get('app');
        if (is_array($appConfig)) {
            foreach ($appConfig as $item => $value) {
                $app[$item] = $value;
            }
        }

    }

}
