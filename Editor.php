<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

namespace Funkyproject\Component\JsonEditor;

use Funkyproject\Component\JsonEditor\Filesystem\FilesystemFacade;
use Funkyproject\Component\JsonEditor\Filesystem\FilesystemInterface;
use Funkyproject\Component\JsonEditor\Finder\FinderFacade;

/**
 * @author     aurelien fontaine <aurelien@fontaine.mx>
 * @copyright  2015 Fontaine.mx
 */
class Editor
{

    private $jsonFile;
    private $path;
    /**
     * @var \Symfony\Component\Filesystem\Filesystem
     */
    private $filesystem;

    private $content;
    private $extension;
    private $fileName;
    private $finder;

    public function __construct($jsonFile, $path)
    {
        $this->jsonFile = $jsonFile;

        $this->path       = $path;
        $this->filesystem = new FilesystemFacade();
        $this->finder     = new FinderFacade();
        $this->loadContent();
    }

    public function availableVersion()
    {
        $finder = clone $this->finder;

        return $finder->files()->
            in($this->path)->
            depth('== 0')->
            name($this->fileName() . '*')->
            count();
    }

    public function flush()
    {
        $this->filesystem->rename($this->currentFilePath(), $this->newLastFilePath());
        $this->filesystem->touch($this->currentFilePath());
        $this->filesystem->dumpFile($this->currentFilePath(), $this->dump());
    }

    public function setFilesystem(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;

        return $this;
    }

    public function get($key)
    {
        if ($this->has($key)) {
            return $this->content->{$key};
        }
    }

    public function set($key, $value)
    {
        $this->content->{$key} = $value;

        return $this;
    }

    public function setFinder(FinderFacade $finder)
    {
        $this->finder = $finder;

        return $this;
    }

    public function dump()
    {
        return json_encode($this->content);
    }

    /**
     * @return string
     */
    private function currentFilePath()
    {
        return $this->path . "/" . $this->jsonFile;
    }

    private function newLastFilePath()
    {
        return $this->path . "/" . sprintf("%s.%d.%s", $this->fileName(), $this->availableVersion(), $this->extension());
    }

    private function previousFilePath()
    {
        return $this->path . "/" . sprintf("%s.%d.%s", $this->fileName(), $this->availableVersion() - 1, $this->extension());
    }

    /**
     * @return array
     */
    private function explodeFilePath()
    {
        if ($this->extension == null || $this->fileName == null) {
            $parts           = explode(".", $this->jsonFile);
            $this->extension = end($parts);
            $this->fileName  = str_replace(".$this->extension", "", $this->jsonFile);
        }
    }

    private function fileName()
    {
        $this->explodeFilePath();

        return $this->fileName;
    }

    private function extension()
    {
        $this->explodeFilePath();

        return $this->extension;
    }

    public function rollback()
    {
        $this->filesystem->rename($this->previousFilePath(), $this->currentFilePath(), true);
        $this->loadContent();
    }

    public function has($key)
    {
        return property_exists($this->content, $key);
    }

    private function loadContent()
    {
        $this->content = json_decode(file_get_contents($this->currentFilePath()));
    }

}
