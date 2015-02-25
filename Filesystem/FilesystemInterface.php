<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @author     Aurelien Fontaine <aurelien@fontaine.mx>
 * @copyright  2015 Fontaine.mx 
 */

namespace Funkyproject\Component\JsonEditor\Filesystem;


interface FilesystemInterface
{
    public function rename($src, $target);
    public function dumpFile($src, $content);
    public function touch($file);
} 