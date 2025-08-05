<?php

namespace Console\Input;

class InputParser implements InputInterface
{
    private ?string $commandName = null;
    private array $arguments = [];
    private array $parameters = [];

    public function __construct(array $argv)
    {
        $this->parseInput($argv);
    }

    private function parseInput(array $argv): void
    {
        if (count($argv) < 2) {
            return;
        }

        $this->commandName = $argv[1];
        $input = array_slice($argv, 2);

        foreach ($input as $item) {
            if (str_starts_with($item, '{') && str_ends_with($item, '}')) {
                $this->parseArguments($item);
            } elseif (str_starts_with($item, '[') && str_ends_with($item, ']')) {
                $this->parseParameters($item);
            }
        }
    }

    private function parseArguments(string $argumentString): void
    {
        $content = substr($argumentString, 1, -1);
        $args = explode(',', $content);

        foreach ($args as $arg) {
            if (!empty(trim($arg))) {
                $this->arguments[] = trim($arg);
            }
        }
    }

    private function parseParameters(string $parameterString): void
    {
        $content = substr($parameterString, 1, -1);
        $parts = explode('=', $content, 2);

        if (count($parts) !== 2) {
            return;
        }

        $name = trim($parts[0]);
        $value = trim($parts[1]);

        if (str_starts_with($value, '{') && str_ends_with($value, '}')) {
            $value = substr($value, 1, -1);
            $this->parameters[$name] = explode(',', $value);
        } else {
            $this->parameters[$name] = $value;
        }
    }

    public function getCommandName(): ?string
    {
        return $this->commandName;
    }

    public function getArguments(): array
    {
        return $this->arguments;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function hasArgument(string $name): bool
    {
        return in_array($name, $this->arguments, true);
    }

    public function hasParameter(string $name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    public function getParameter(string $name): mixed
    {
        return $this->parameters[$name] ?? null;
    }
}