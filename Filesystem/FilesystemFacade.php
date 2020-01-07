<?php
declare(strict_types=1);

namespace Funkyproject\Component\JsonEditor\Filesystem;

use Symfony\Component\Filesystem\Filesystem;

/**
 * Limited file system.
 *
 * @package Funkyproject\Component\JsonEditor\Filesystem
 */
class FilesystemFacade  extends Filesystem implements FilesystemInterface
{

}
