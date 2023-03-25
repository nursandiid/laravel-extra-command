<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Sandinur157\LaravelExtraCommand\Support\FileGenerator;
use Sandinur157\LaravelExtraCommand\Support\GenerateFile;

class CreateInterfaceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {interface-name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create Interface class';

    /**
     * Return Interface name as convention
     *
     * @return string
     */
    private function getInterfaceName(): string
    {
        $interface = Str::studly($this->argument('interface-name'));

        if (Str::contains(strtolower($interface), 'interface') === false) {
            $interface .= 'Interface';
        }

        return $interface;
    }

    /**
     * Return destination path for class file publish
     *
     * @return string
     */
    protected function getDestinationFilePath(): string
    {
        return app_path() .  '/Interfaces' . '/' . $this->getInterfaceName() . '.php';
    }

    /**
     * Return stub file path
     *
     * @return string
     */
    protected function getStubFilePath(): string
    {
        return '/stubs/interface.stub';
    }

    /**
     * Generate file content
     *
     * @return string
     */
    protected function getTemplateContents(): string
    {
        return (new GenerateFile(__DIR__ . $this->getStubFilePath(), [
            'INTERFACE' => class_basename($this->getInterfaceName()),
        ]))->render();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filesystem = new Filesystem();
        $path = str_replace('\\', '/', $this->getDestinationFilePath());
        $directory = dirname($path);

        if (! $filesystem->isDirectory($directory)) {
            $filesystem->makeDirectory($directory, 0777, true);
        }

        if (! $filesystem->isDirectory($directory)) {
            $filesystem->makeDirectory($directory, 0777, true);
        }

        $contents = $this->getTemplateContents();

        try {
            (new FileGenerator($path, $contents, new Filesystem))->generate();
            $this->line('<bg=blue;> INFO </bg=blue;> Interface <options=bold;>['. str_replace(app_path(), 'app', $path) .']</options=bold;> created successfully.');
        } catch (\Exception) {
            $this->line('<bg=red;> ERROR </bg=red;> Interface already exists.');
        }
    }
}
