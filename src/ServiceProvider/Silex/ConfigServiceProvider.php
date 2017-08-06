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

namespace deasilworks\API\ServiceProvider\Silex;

use deasilworks\API\API;
use deasilworks\API\APIConfig;
use deasilworks\API\Model\ApiResultModel;
use deasilworks\API\Model\RestRequestModel;
use deasilworks\CFG\Config;
use deasilworks\CFG\ServiceProvider\Silex\ServiceProvider;
use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class APIServiceProvider.
 *
 * Responsible for providing API as a service to
 * the applications built on the Silex framework.
 */
class ConfigServiceProvider extends ServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        // the config
        $container[$this->namespace.'.config'] = function ($container) {
            $configFilesKey = $this->namespace.'.config.files';

            $config = new Config();

            if (!isset($container[$configFilesKey])) {
                $configFiles = $container[$configFilesKey];

                if (!is_array($configFiles)) {
                    throw new \Exception($configFilesKey . ' must be an array of file paths.');
                }

                foreach ($configFiles as $configFile) {
                    $config->loadYamlFile($configFile);
                }

                // TODO: load config into container
            }

            return $config;
        };

    }
}
