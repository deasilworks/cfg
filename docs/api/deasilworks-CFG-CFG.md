deasilworks\CFG\CFG
===============

Class CFG.

Responsible for providing configuration


* Class name: CFG
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

    \deasilworks\CFG\CFG deasilworks\CFG\CFG::loadYamlFile($filePath)

Load a YAML file.



* Visibility: **public**


#### Arguments
* $filePath **mixed**



### loadYaml

    \deasilworks\CFG\CFG deasilworks\CFG\CFG::loadYaml($yaml)

Load YAML.



* Visibility: **public**


#### Arguments
* $yaml **mixed**



### getAll

    array deasilworks\CFG\CFG::getAll()





* Visibility: **public**




### get

    mixed deasilworks\CFG\CFG::get(string $pathKey, mixed $default)





* Visibility: **public**


#### Arguments
* $pathKey **string**
* $default **mixed**



### set

    \deasilworks\CFG\CFG deasilworks\CFG\CFG::set($keyPath, $value)





* Visibility: **public**


#### Arguments
* $keyPath **mixed**
* $value **mixed**



### setPath

    mixed deasilworks\CFG\CFG::setPath($keyStoreLocation, $keyPathArray, $value)





* Visibility: **private**


#### Arguments
* $keyStoreLocation **mixed**
* $keyPathArray **mixed**
* $value **mixed**



### has

    boolean deasilworks\CFG\CFG::has($pathKey)





* Visibility: **public**


#### Arguments
* $pathKey **mixed**



### rebuildPathStore

    mixed deasilworks\CFG\CFG::rebuildPathStore()

Rebuild the path store.



* Visibility: **private**




### replaceTokens

    mixed deasilworks\CFG\CFG::replaceTokens($store)





* Visibility: **private**


#### Arguments
* $store **mixed**



### pathNodes

    array deasilworks\CFG\CFG::pathNodes($keyStore)





* Visibility: **private**


#### Arguments
* $keyStore **mixed**



### pathNestedNodes

    mixed deasilworks\CFG\CFG::pathNestedNodes($out, $key, $input)





* Visibility: **private**


#### Arguments
* $out **mixed**
* $key **mixed**
* $input **mixed**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.