<?php
declare(strict_types=1);

namespace Funkyproject\Component\JsonEditor\Finder;

/**
 * Defines how you can find files.
 *
 * @package Funkyproject\Component\JsonEditor\Finder
 */
interface FinderInterface extends \Countable, \IteratorAggregate
{
    /**
     * Sets in directories.
     *
     * @param $dir
     *
     * @return self
     */
    public function in($dir);

    /**
     * @param $depth
     *
     * @return self
     */
    public function depth($depth);

    /**
     * Set name
     *
     * @param $name
     *
     * @return self
     */
    public function name($name);

    /**
     * Set the iterators mode.
     *
     * @return self
     */
    public function files();
} 
