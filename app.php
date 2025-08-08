#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Console\CommandRegistry;
use Console\Input\InputParser;
use Console\Output\ConsoleOutput;
use Console\Exceptions\CommandException;

try {
    $registry = new CommandRegistry();

    // Автозагрузка всех команд из директории
    $commandFiles = glob(__DIR__.'/src/Command/*Command.php');

    // Обработка ввода
    $input = new InputParser($argv);
    $output = new ConsoleOutput();

    foreach ($commandFiles as $file) {
        $className = 'Console\\Command\\'.basename($file, '.php');

        // Пропускаем BaseCommand, если он есть в директории
        if (str_contains($className, 'BaseCommand')) {
            continue;
        }

        if (class_exists($className)) {
            $registry->register(new $className());
        }
    }

    $exitCode = $registry->handle($input, $output);
    exit($exitCode);
} catch (CommandException $e) {
    (new ConsoleOutput())->error("Fatal error: ".$e->getMessage());
    exit(1);
}