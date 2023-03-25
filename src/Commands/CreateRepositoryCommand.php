<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Filesystem\Filesystem;
use Sandinur157\LaravelExtraCommand\Support\FileGenerator;
use Sandinur157\LaravelExtraCommand\Support\GenerateFile;

class CreateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repository-name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create Repository class';

    /**
     * Return Repository name as convention
     *
     * @return string
     */
    private function getRepositoryName(): string
    {
        $repository = Str::studly($this->argument('repository-name'));

        if (Str::contains(strtolower($repository), 'repository') === false) {
            $repository .= 'Repository';
        }

        return $repository;
    }

    /**
     * Return Inference name for this repository class
     *
     * @return string
     */
    protected function getInterfaceName(): string
    {
        return $this->getRepositoryName() . "Interface";
    }

    /**
     * Return destination path for class file publish
     *
     * @return string
     */
    protected function getDestinationFilePath(): string
    {
        return app_path() .  '/Repositories' . '/' . $this->getRepositoryName() . '.php';
    }

    /**
     * Return stub file path
     *
     * @return string
     */
    protected function getStubFilePath(): string
    {
        return '/stubs/repository.stub';
    }

    /**
     * Generate file content
     *
     * @return string
     */
    protected function getTemplateContents(): string
    {
        return (new GenerateFile(__DIR__ . $this->getStubFilePath(), [
            'CLASS' => class_basename($this->getRepositoryName()),
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

        $contents = $this->getTemplateContents();
        try {
            (new FileGenerator($path, $contents, new Filesystem))->generate();
            $this->line('<bg=blue;> INFO </bg=blue;> Repository <options=bold;>['. str_replace(app_path(), 'app', $path) .']</options=bold;> created successfully.');
        } catch (\Exception) {
            $this->line('<bg=red;> ERROR </bg=red;> Repository already exists.');
        }
    }
}
