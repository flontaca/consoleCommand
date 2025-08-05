<?php

namespace Console\Exceptions;

class CommandNotFoundException extends CommandException
{
    private string $commandName;

    public function __construct(string $commandName, int $code = 0, Throwable $previous = null)
    {
        $this->commandName = $commandName;
        parent::__construct("Команда \"{$commandName}\" не найдена", $code, $previous);
    }

    public function getCommandName(): string
    {
        return $this->commandName;
    }
}