<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('inmobiliaria', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=inmobiliaria',
  'user' => 'kevin9612',
  'password' => '',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
    'ATTR_TIMEOUT' => 30,
  ),
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('inmobiliaria');
$serviceContainer->setConnectionManager('inmobiliaria', $manager);
$serviceContainer->setDefaultDatasource('inmobiliaria');