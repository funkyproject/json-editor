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
use PHPUnit\Framework\TestCase;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * @property mixed path
 */
class EditorTest extends TestCase
{
    const JSON_FILE = "testa.json";
    /**
     * @var Editor
     */
    private $editor;

    public static function setUpBeforeClass(): void
    {
        $filesystem = new Filesystem();
        $filesystem->mirror(__DIR__ . "/Data", sys_get_temp_dir() . "/");
    }

    public static function tearDownAfterClass(): void
    {
        $files = Finder::create()->
            files()->
            in(sys_get_temp_dir())->
            depth(0)->
            name("testa*");

        /* @var $file \Symfony\Component\Finder\SplFileInfo */
        foreach ($files as $file) {
            @unlink($file->getRealPath());
        }
    }

    protected function setUp(): void
    {
        $this->path   = sys_get_temp_dir();
        $this->editor = new Editor(self::JSON_FILE, $this->path);
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

    /**
     * @test
     */
    public function shouldHave4VersionAfterFlushModification()
    {
        $this->editor->flush();
        $this->assertEquals(4, $this->editor->availableVersion());
    }

    /**
     * @test
     */
    public function shouldGetValueForKey1()
    {
        $this->assertEquals(
            "Lorem ipsum color sit amet",
            $this->editor->get('KEY_1')
        );
    }

    /**
     * @test
     */
    public function shouldSetValueForKey5()
    {
        $this->editor->set('KEY_5', 'Oho');
        $this->editor->flush();

        $editor = new Editor(self::JSON_FILE, $this->path);
        $this->assertTrue($editor->has('KEY_5'));
        $this->assertEquals(
            "Oho",
            $editor->get('KEY_5')
        );
    }

    /**
     * @test
     */
    public function shouldDoNotHaveKey5AfterRollback()
    {
        $editor = new Editor(self::JSON_FILE, $this->path);
        $editor->rollback();
        $this->assertFalse($editor->has('KEY_5'));
    }
}
