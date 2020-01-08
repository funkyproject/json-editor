<?php
declare(strict_types=1);

namespace Funkyproject\Component\JsonEditor\Filesystem;

use Symfony\Component\Filesystem\Filesystem as SfFilesystem;

/**
 * Limited file system.
 *
 * @package Funkyproject\Component\JsonEditor\Filesystem
 */
class FilesystemFacade implements FilesystemInterface
{
    /**
     * @var SfFilesystem
     */
    private $fs;

    /**
     * FilesystemFacade constructor.
     */
    public function __construct()
    {
        $this->fs = new SfFilesystem();
    }

    /**
     * Rename files
     *
     * @param string $origin
     * @param string $target
     * @param bool $overwrite
     *
     * @return mixed
     */
    public function rename(string $origin, string $target, bool $overwrite = false)
    {
        return $this->fs->rename($origin, $target, true);
    }

    /**
     * Dump the content of file.
     *
     * @param string $filename
     * @param $content
     *
     * @return mixed
     */
    public function dumpFile(string $filename, $content)
    {
        return $this->fs->dumpFile($filename, $content);
    }

    /**
     * Create an empty file.
     *
     * @param $file
     *
     * @return mixed
     */
    public function touch(string $filename)
    {
        return $this->fs->touch($filename);
    }

    /**
     * @inheritDoc
     */
    public function copy(string $origin, string $target)
    {
       $this->fs->copy($origin, $target, true);
    }
}
