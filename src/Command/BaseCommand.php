<?php

namespace Console\Command;

use Console\Input\InputInterface;
use Console\Output\OutputInterface;

abstract class BaseCommand implements CommandInterface
{
    protected string $name = '';
    protected string $description = '';

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getHelp(): string
    {
        return $this->description;
    }

    abstract public function execute(InputInterface $input, OutputInterface $output): int;
}