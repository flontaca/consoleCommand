<?php

namespace Console;

use Console\Command\CommandInterface;
use Console\Input\InputInterface;
use Console\Output\OutputInterface;
use Console\Exceptions\CommandNotFoundException;

class CommandRegistry
{
    /** @var CommandInterface[] */
    private array $commands = [];

    public function register(CommandInterface $command): void
    {
        $this->commands[$command->getName()] = $command;
    }

    public function handle(InputInterface $input, OutputInterface $output): int
    {
        // Если команда не указана
        if ($input->getCommandName() === null) {
            $this->showCommandsList($output);
            return 0;
        }

        $commandName = $input->getCommandName();

        // Проверка на help для несуществующей команды
        if (!isset($this->commands[$commandName])) {
            $output->writeln("Команда \"{$commandName}\" не найдена");
            $this->showCommandsList($output);
            return 1;
        }

        $command = $this->commands[$commandName];

        // Вывод помощи
        if ($input->hasArgument('help')) {
            $this->showCommandHelp($command, $output);
            return 0;
        }

        // Выполнение команды
        return $command->execute($input, $output);
    }

    private function showCommandsList(OutputInterface $output): void
    {
        $output->writeln("Доступные команды:");
        $output->writeln("");

        foreach ($this->commands as $command) {
            $output->writeln(sprintf(
                "  %s - %s",
                $command->getName(),
                $command->getDescription()
            ));
        }

        $output->writeln("");
        $output->writeln("Для справки по конкретной команде используйте: {help}");
    }

    private function showCommandHelp(CommandInterface $command, OutputInterface $output): void
    {
        $output->writeln(sprintf("Команда: %s", $command->getName()));
        $output->writeln("");
        $output->writeln($command->getDescription());
        $output->writeln("");

        if (method_exists($command, 'getUsage')) {
            $output->writeln("Использование:");
            $output->writeln("  " . $command->getUsage());
            $output->writeln("");
        }

        $output->writeln($command->getHelp());
        // Можно добавить больше информации о специфичных аргументах команды
    }
}