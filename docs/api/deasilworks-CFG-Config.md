deasilworks\CFG\Config
===============

Class CEFServiceProvider.

Responsible for providing config population


* Class name: Config
* Namespace: deasilworks\CFG





Properties
----------


### $keyStore

    private array $keyStore = array()





* Visibility: **private**


### $pathStore

    private array $pathStore = array()





* Visibility: **private**


Methods
-------


### loadYamlFile

    \deasilworks\CFG\Config deasilworks\CFG\Config::loadYamlFile($filePath)

Load a YAML file.



* Visibility: **public**


#### Arguments
* $filePath **mixed**



### loadYaml

    \deasilworks\CFG\Config deasilworks\CFG\Config::loadYaml($yaml)

Load YAML.



* Visibility: **public**


#### Arguments
* $yaml **mixed**



### getAll

    array deasilworks\CFG\Config::getAll()





* Visibility: **public**




### get

    mixed deasilworks\CFG\Config::get(string $pathKey, mixed $default)





* Visibility: **public**


#### Arguments
* $pathKey **string**
* $default **mixed**



### set

    \deasilworks\CFG\Config deasilworks\CFG\Config::set($keyPath, $value)





* Visibility: **public**


#### Arguments
* $keyPath **mixed**
* $value **mixed**



### setPath

    mixed deasilworks\CFG\Config::setPath($keyStoreLocation, $keyPathArray, $value)





* Visibility: **private**


#### Arguments
* $keyStoreLocation **mixed**
* $keyPathArray **mixed**
* $value **mixed**



### has

    boolean deasilworks\CFG\Config::has($pathKey)





* Visibility: **public**


#### Arguments
* $pathKey **mixed**



### rebuildPathStore

    mixed deasilworks\CFG\Config::rebuildPathStore()

Rebuild the path store.



* Visibility: **private**




### replaceTokens

    mixed deasilworks\CFG\Config::replaceTokens($store)





* Visibility: **private**


#### Arguments
* $store **mixed**



### pathNodes

    array deasilworks\CFG\Config::pathNodes($keyStore)





* Visibility: **private**


#### Arguments
* $keyStore **mixed**



### pathNestedNodes

    mixed deasilworks\CFG\Config::pathNestedNodes($out, $key, $input)





* Visibility: **private**


#### Arguments
* $out **mixed**
* $key **mixed**
* $input **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.