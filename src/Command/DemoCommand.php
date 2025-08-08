<?php

namespace Console\Command;

use Console\Input\InputInterface;
use Console\Output\OutputInterface;

class DemoCommand extends BaseCommand
{
    protected string $name = 'command_name';
    protected string $description = 'Демонстрационная команда с примером использования';

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln("\nВызванная команда: ".$input->getCommandName());

        $output->writeln("\nАргументы:");
        foreach ($input->getArguments() as $argument) {
            $output->writeln("\t- $argument");
        }

        $output->writeln("\nПараметры:");
        foreach ($input->getParameters() as $name => $value) {
            $output->writeln("\t- $name");
            if (is_array($value)) {
                foreach ($value as $valueItem){
                    $output->writeln("\t\t- $valueItem");
                }
            } else {
                $output->writeln("\t\t- $value");
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