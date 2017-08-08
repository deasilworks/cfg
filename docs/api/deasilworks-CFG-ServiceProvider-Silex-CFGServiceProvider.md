deasilworks\CFG\ServiceProvider\Silex\CFGServiceProvider
===============

Class APIServiceProvider.

Responsible for providing API as a service to
the applications built on the Silex framework.


* Class name: CFGServiceProvider
* Namespace: deasilworks\CFG\ServiceProvider\Silex
* Parent class: [deasilworks\CFG\ServiceProvider\Silex\ServiceProvider](deasilworks-CFG-ServiceProvider-Silex-ServiceProvider.md)
* This class implements: Pimple\ServiceProviderInterface, Silex\Api\BootableProviderInterface




Properties
----------


### $namespace

    protected string $namespace





* Visibility: **protected**


Methods
-------


### register

    mixed deasilworks\CFG\ServiceProvider\Silex\CFGServiceProvider::register(\Pimple\Container $container)





* Visibility: **public**


#### Arguments
* $container **Pimple\Container**



### boot

    mixed deasilworks\CFG\ServiceProvider\Silex\CFGServiceProvider::boot(\Silex\Application $app)





* Visibility: **public**


#### Arguments
* $app **Silex\Application**



### __construct

    mixed deasilworks\CFG\ServiceProvider\Silex\ServiceProvider::__construct(string $namespace)

CEFServiceProvider constructor.



* Visibility: **public**
* This method is defined by [deasilworks\CFG\ServiceProvider\Silex\ServiceProvider](deasilworks-CFG-ServiceProvider-Silex-ServiceProvider.md)


#### Arguments
* $namespace **string**



### populateConfig

    mixed deasilworks\CFG\ServiceProvider\Silex\ServiceProvider::populateConfig(object $serviceConfig, $serviceKey, array $configStore)





* Visibility: **protected**
* This method is defined by [deasilworks\CFG\ServiceProvider\Silex\ServiceProvider](deasilworks-CFG-ServiceProvider-Silex-ServiceProvider.md)


#### Arguments
* $serviceConfig **object**
* $serviceKey **mixed**
* $configStore **array**



## LICENSE

MIT

##### This open-source project is brought to you by [Deasil Works, Inc.](http://deasil.works/) Copyright &copy; 2017 Deasil Works, Inc.