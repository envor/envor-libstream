<?php

namespace Envor\Libstream;

use Spatie\EventSourcing\Commands\CommandBus;

class Dispatcher
{
    protected CommandBus $commandBus;

    protected array $commands = [];

    public static function new(): self
    {
        return new self();
    }

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->commandBus = app(CommandBus::class);
    }

    /**
     * Add a command to the dispatcher.
     *
     * @return self
     */
    public function add(Command $command): self
    {
        $this->commands[] = $command;

        return $this;
    }

    /**
     * Dispatch all commands.
     *
     * @return void
     */
    public function dispatch(): void
    {
        foreach ($this->commands as $command) {
            $this->commandBus->dispatch($command);
        }
    }

    /**
     * Clear all commands.
     *
     * @return void
     */
    public function clear(): void
    {
        $this->commands = [];
    }

    /**
     * Get all commands.
     *
     * @return array
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
