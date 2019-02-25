<?php

namespace Styde\Tests;

use Styde\ImageJpeg;
use Styde\ImagePng;

class ImageTest extends TestCase
{
    /** @test */
    function it_can_display_a_jpeg_image()
    {
        $image = new ImageJpeg(assets_path('img/tower-bridge.jpg'));

        $this->assertImageContentEquals('tower-bridge.jpg', $image);
    }

    /** @test */
    function it_can_display_a_png_image()
    {
        $image = new ImagePng(assets_path('img/tower-bridge.png'));

        $this->assertImageContentEquals('tower-bridge.png', $image);
    }

    protected function assertImageContentEquals($filename, $image)
    {
        ob_start();
        $image->display();
        $content = ob_get_clean();

        if (! file_exists($this->snapshotsPath($filename))) {
            file_put_contents($this->snapshotsPath($filename), $content);
            $this->markTestIncomplete("The snapshot [{$filename}] didn't exist and was created.");
        }

        $this->assertTrue(
            file_get_contents($this->snapshotsPath($filename)) === $content,
            "The displayed image does not match the expected image [{$filename}]"
        );
    }

    protected function snapshotsPath($filename)
    {
        return __DIR__.'/snapshots/'.$filename;
    }
}