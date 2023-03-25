<?php

namespace Sandinur157\LaravelExtraCommand\Support;

use Illuminate\Filesystem\Filesystem;

class FileGenerator
{
    /**
     * __construct
     *
     * @param  mixed $path
     * @param  mixed $contents
     * @param  Filesystem $filesystem
     * @return void
     */
    public function __construct(
        protected $path, 
        protected $contents, 
        protected Filesystem $filesystem)
    {
        //
    }

    /**
     * setPath
     *
     * @param  mixed $path
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * getPath
     *
     * @return void
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * setContents
     *
     * @param  mixed $contents
     * @return void
     */
    public function setContents($contents)
    {
        $this->contents = $contents;

        return $this;
    }

    /**
     * getContents
     *
     * @return void
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * setFilesystem
     *
     * @param  mixed $filesystem
     * @return void
     */
    public function setFilesystem(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * getFilesystem
     *
     * @return void
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * Generate the file
     *
     * @return void
     */
    public function generate()
    {
        $path = $this->getPath();
        if (! $this->filesystem->exists($path)) {
            return $this->filesystem->put($path, $this->getContents());
        }
        throw new \Exception('File already exists!');
    }
}