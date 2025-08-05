<?php

namespace Console\Input;

interface InputInterface
{
    public function getCommandName(): ?string;
    public function getArguments(): array;
    public function getParameters(): array;
    public function hasArgument(string $name): bool;
    public function hasParameter(string $name): bool;
    public function getParameter(string $name): mixed;
}