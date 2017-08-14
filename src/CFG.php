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

namespace deasilworks\CFG;

use Symfony\Component\Yaml\Yaml;

/**
 * Class CFG.
 *
 * Responsible for providing configuration
 */
class CFG
{
    /**
     * @var array
     */
    private $keyStore = [];

    /**
     * @var array
     */
    private $pathStore = [];

    /**
     * Load a YAML file.
     *
     * @param $filePath
     *
     * @return $this
     */
    public function loadYamlFile($filePath)
    {
        if (file_exists($filePath)) {
            $this->loadYaml(file_get_contents($filePath));
        }

        return $this;
    }

    /**
     * Load YAML.
     *
     * @SuppressWarnings(PHPMD)
     *
     * @param $yaml
     *
     * @return $this
     */
    public function loadYaml($yaml)
    {
        $data = Yaml::parse($yaml);

        $this->keyStore = array_replace_recursive($this->keyStore, $data);
        $this->rebuildPathStore();

        return $this;
    }

    /**
     * @return array
     */
    public function getAll()
    {
        return $this->pathStore;
    }

    /**
     * @param string $pathKey
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($pathKey, $default = null)
    {
        return isset($this->pathStore[$pathKey]) ? $this->pathStore[$pathKey] : $default;
    }

    /**
     * @param $keyPath
     * @param $value
     *
     * @return $this
     */
    public function set($keyPath, $value)
    {
        $keyPathArray = explode('.', $keyPath);

        $this->setPath($this->keyStore, $keyPathArray, $value);
        $this->rebuildPathStore();

        return $this;
    }

    private function setPath(&$keyStoreLocation, &$keyPathArray, $value)
    {
        $key = array_shift($keyPathArray);

        if (count($keyPathArray) > 0) {
            $this->setPath($keyStoreLocation[$key], $keyPathArray, $value);

            return;
        }

        $keyStoreLocation[$key] = $value;
    }

    /**
     * @param $pathKey
     *
     * @return bool
     */
    public function has($pathKey)
    {
        return isset($this->pathStore[$pathKey]);
    }

    /**
     * Rebuild the path store.
     */
    private function rebuildPathStore()
    {
        $this->pathStore = $this->pathNodes($this->keyStore);

        // TODO: replace tokens
        $this->replaceTokens($this->pathStore);
    }

    /**
     * @param $store
     */
    private function replaceTokens(&$store)
    {
        array_walk_recursive($store, function (&$value) use ($store) {
            if (is_string($value)) {
                $value = preg_replace_callback(
                    '/%(\w+)%/',
                    function ($matches) use ($store) {
                        if ($matches[1] && isset($store[$matches[1]])) {
                            return $store[$matches[1]];
                        }

                        return $matches[0];
                    },
                    $value
                );
            }
        });
    }

    /**
     * @param $keyStore
     *
     * @return array
     */
    private function pathNodes($keyStore)
    {
        $out = [];
        $this->pathNestedNodes($out, '', $keyStore);

        return $out;
    }

    /**
     * @param $out
     * @param $key
     * @param $input
     */
    private function pathNestedNodes(&$out, $key, $input)
    {
        foreach ($input as $myKey => $value) {
            if (is_array($value)) {
                $this->pathNestedNodes($out, $key.$myKey.'.', $value);
            }

            if (!is_numeric($myKey)) {
                $out[$key.$myKey] = $value;
            }
        }
    }
}
