<?php

namespace Envor\Libstream;

use Spatie\EventSourcing\Commands\CommandBus;

class Dispatcher
{
    protected CommandBus $commandBus;

    protected array $commands = [];

    public static function new(): static
    {
        return new static;
    }

    /**
     * Create a new class instance.
     */
    final public function __construct()
    {
        $this->commandBus = app(CommandBus::class);
    }

    /**
     * Add a command to the dispatcher.
     */
    public function add(Command $command): self
    {
        $this->commands[] = $command;

        return $this;
    }

    /**
     * Dispatch all commands.
     */
    public function dispatch(): void
    {
        foreach ($this->commands as $command) {
            $this->commandBus->dispatch($command);
        }
    }

    /**
     * Clear all commands.
     */
    public function clear(): void
    {
        $this->commands = [];
    }

    /**
     * Get all commands.
     */
    public function all(): array
    {
        return $this->commands;
    }

    public function commandBus(): CommandBus
    {
        return $this->commandBus;
    }
}
