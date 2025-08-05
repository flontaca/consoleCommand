<?php

namespace Console\Command;

use Console\Input\InputInterface;
use Console\Output\OutputInterface;

interface CommandInterface
{
    public function getName(): string;
    public function getDescription(): string;
    public function execute(InputInterface $input, OutputInterface $output): int;
    public function getHelp(): string;
}