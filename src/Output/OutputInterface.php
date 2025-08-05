<?php

namespace Console\Output;

interface OutputInterface
{
    public function writeln(string $message): void;
    public function write(string $message): void;
    public function info(string $message): void;
    public function error(string $message): void;
    public function success(string $message): void;
}