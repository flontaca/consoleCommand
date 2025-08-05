<?php

namespace Console\Command;

use Console\Input\InputInterface;
use Console\Output\OutputInterface;

class DemoCommand extends BaseCommand
{
    protected string $name = 'demo';
    protected string $description = 'Демонстрационная команда с примером использования';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("Выполнение демонстрационной команды");

        $output->writeln("\nАргументы:");
        foreach ($input->getArguments() as $argument) {
            $output->writeln("  - $argument");
        }

        $output->writeln("\nПараметры:");
        foreach ($input->getParameters() as $name => $value) {
            if (is_array($value)) {
                $output->writeln("  $name: " . implode(', ', $value));
            } else {
                $output->writeln("  $name: $value");
            }
        }

        return 0;
    }

    public function getHelp(): string
    {
        return <<<HELP
            Эта команда демонстрирует работу с аргументами и параметрами.
            
            Примеры использования:
              demo {arg1,arg2} [format=json]
              demo {test} [output=console] [options={verbose,debug}]
            
            Параметры:
              format   - Формат вывода (json, text)
              output   - Куда выводить (console, file)
              options  - Дополнительные опции
        HELP;
    }

}