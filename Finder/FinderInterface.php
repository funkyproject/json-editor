<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @author     Aurelien Fontaine <aurelien@fontaine.mx>
 * @copyright  2015 Fontaine.mx 
 */

namespace Funkyproject\Component\JsonEditor\Finder;


interface FinderInterface extends \Countable
{
    public function in($dir);
    public function depth($depth);
    public function name($name);
    public function files();
} 