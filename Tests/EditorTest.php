<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 *
 * @category    PhpStorm
 * @author     aurelien
 * @copyright  2015 Efidev
 * @version    CVS: Id:$
 */

namespace Funkyproject\Component\JsonEditor\Tests;


use Funkyproject\Component\JsonEditor\Editor;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @property mixed path
 */
class EditorTest extends \PHPUnit_Framework_TestCase
{
    private $editor;

    public static function setUpBeforeClass()
    {
        $filesystem = new Filesystem();
        $filesystem->mirror(__DIR__."/Data", sys_get_temp_dir());
    }


    protected function setUp()
    {
        $this->path = sys_get_temp_dir();
        $this->editor = new Editor($this->path."/testa.json");
    }

    /**
     * @test
     */
    public function shouldBeAnInstanceOfEditor()
    {
        $this->assertInstanceOf('\Funkyproject\Component\JsonEditor\Editor', $this->editor);
    }

    /**
     * @test
     */
    public function shouldHave3VersionOfDocumentYet()
    {
        $this->assertEquals(3, $this->editor->availableVersion());
    }
}
 