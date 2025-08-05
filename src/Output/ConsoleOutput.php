<?php

namespace Console\Output;

class ConsoleOutput implements OutputInterface
{
    private const COLOR_RED = "\033[31m";
    private const COLOR_GREEN = "\033[32m";
    private const COLOR_YELLOW = "\033[33m";
    private const COLOR_RESET = "\033[0m";

    public function writeln(string $message): void
    {
        $this->write($message . PHP_EOL);
    }

    public function write(string $message): void
    {
        echo $message;
    }

    public function info(string $message): void
    {
        $this->writeln($message);
    }

    public function error(string $message): void
    {
        $this->writeln(self::COLOR_RED . $message . self::COLOR_RESET);
    }

    public function success(string $message): void
    {
        $this->writeln(self::COLOR_GREEN . $message . self::COLOR_RESET);
    }
}