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

use deasilworks\CFG\Config;

/**
 * Class ConfigTest.
 *
 * @SuppressWarnings(PHPMD)
 * We do bad things here and we like it.
 */
class ConfigTest extends \PHPUnit_Framework_TestCase
{
    public function testYaml()
    {
        $yaml1 = __DIR__.'/resources/test_config_1.yaml';
        $yaml1b = __DIR__.'/resources/test_config_1b.yaml';
        $yaml2 = __DIR__.'/resources/test_config_2.yaml';
        $yaml3 = __DIR__.'/resources/test_config_3.yaml';

        $config = new Config();
        $config
            ->loadYamlFile($yaml1)
            ->loadYamlFile($yaml1b)
            ->loadYamlFile($yaml2);

        $configStore = $config->getAll();

        $this->assertEquals(
            'http://github.com/deasilworks/cef',
            $configStore['test']['test_array_of_hashes'][1]['location']
        );

        $this->assertTrue(isset($configStore['test']['test_array_of_hashes'][2]));

        $this->assertEquals(
            'This is an overridden test message.',
            $configStore['test']['messages']['a_message']
        );

        $this->assertEquals(
            $configStore['test']['messages']['a_message'],
            $config->get('test.messages.a_message')
        );

        $config->loadYamlFile($yaml3);
        $configStore = $config->getAll();

        $this->assertTrue(isset($configStore['test']['test_array_of_hashes'][1]));
        $this->assertTrue(isset($configStore['test.test_array_of_hashes.1.name']));

        $this->assertEquals(
            $configStore['test']['test_array_of_hashes'][1]['name'],
            $config->get('test.test_array_of_hashes.1.name')
        );

        $this->assertEquals(
            $config->get('test')['test_array_of_hashes'][1]['name'],
            $config->get('test.test_array_of_hashes.1.name')
        );

        $this->assertTrue(isset($configStore['test']['test_array_of_hashes'][2]));
    }

    public function testConfigKeyStore()
    {
        $config = new Config();
        $config->set('agency.location.city.los_angeles', true);
        $config->set('agency.location.city.london', false);

        $this->assertTrue($config->get('agency.location.city.los_angeles'));
        $this->assertTrue($config->get('agency.location.city')['los_angeles']);
        $this->assertTrue($config->get('agency.location')['city']['los_angeles']);
        $this->assertTrue($config->get('agency')['location']['city']['los_angeles']);

        $this->assertFalse($config->get('agency')['location']['city']['london']);

        $this->assertTrue($config->has('agency.location.city.los_angeles'));
    }
}
