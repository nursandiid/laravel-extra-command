<?php

namespace Sandinur157\LaravelExtraCommand\Support;

class GenerateFile
{
    /**
     * __construct
     *
     * @param  string $path
     * @param  array $replaces
     * @return void
     */
    public function __construct(public string $path, public array $replaces = [])
    {
        //
    }

    /**
     *
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }


    /**
     * Get replaced file content
     *
     * @return string
     */
    public function getContents(): string
    {
        $contents = file_get_contents($this->getPath());

        foreach ($this->replaces as $search => $replace) {
            $contents = str_replace('$' . strtoupper($search) . '$', $replace, $contents);
        }

        return $contents;
    }


    /**
     * return the replaced file content
     *
     * @return string
     */
    public function render(): string
    {
        return $this->getContents();
    }
}