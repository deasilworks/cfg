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

use Pimple\Container;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;

/**
 * Class CEFServiceProvider.
 *
 * Responsible for providing config population
 */
abstract class ServiceProvider
{
    /**
     * @var string
     */
    protected $namespace;

    /**
     * CEFServiceProvider constructor.
     *
     * @param string $namespace
     */
    public function __construct($namespace = 'deasilworks')
    {
        $this->namespace = $namespace;
    }

    /**
     * @param array $configStore
     * @param object $serviceConfig
     */
    protected function populateConfig($serviceConfig, $serviceKey, $configStore)
    {
        $configMethods = get_class_methods($serviceConfig);
        $converter = new CamelCaseToSnakeCaseNameConverter();

        // Check container keys matching config setters.
        //
        foreach ($configMethods as $method) {
            $matches = [];
            preg_match('/^set_(.+)/', $converter->normalize($method), $matches);

            if (count($matches) < 1) {
                continue;
            }

            $configKey = $this->namespace.'.'.$serviceKey.'.'.$matches[1];

            if (isset($configStore[$configKey])) {
                $serviceConfig->$method($configStore[$configKey]);
            }
        }
    }
}
