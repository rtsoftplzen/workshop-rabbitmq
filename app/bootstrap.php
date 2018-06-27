<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

define("APP_DIR", __DIR__);

$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
	->addDirectory(__DIR__)
	->register();

$configurator->addConfig(__DIR__ . '/config/config.neon');

$container = $configurator->createContainer();

return $container;