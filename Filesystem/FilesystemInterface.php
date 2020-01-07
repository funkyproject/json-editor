<?php
declare(strict_types=1);

namespace Funkyproject\Component\JsonEditor\Filesystem;

/**
 * Define the filesystem behaviors.
 *
 * @package Funkyproject\Component\JsonEditor\Filesystem
 */
interface FilesystemInterface
{
    /**
     * Rename files
     *
     * @param string $origin
     * @param string $target
     * @param bool $overwrite
     *
     * @return mixed
     */
    public function rename(string $origin, string $target, bool $overwrite = false);

    /**
     * Dump the content of file.
     *
     * @param string $filename
     * @param $content
     *
     * @return mixed
     */
    public function dumpFile(string $filename, $content);

    /**
     * Create an empty file.
     *
     * @param $file
     *
     * @return mixed
     */
    public function touch(string $filename);
} 
