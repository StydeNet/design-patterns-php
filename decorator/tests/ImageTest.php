<?php

namespace Styde\Tests;

use Styde\Image;

class ImageTest extends TestCase
{
    /** @test */
    function it_can_draw_an_image()
    {
        $image = Image::make(assets_path('img/decorator.jpeg'));

        $this->assertImageEquals('basic-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_resized_image()
    {
        $image = Image::make(assets_path('img/decorator.jpeg'), 500, 333);

        $this->assertImageEquals('resized-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_grayscale_image()
    {
        $image = Image::make(assets_path('img/decorator.jpeg'), null, null, true);

        $this->assertImageEquals('grayscale-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_framed_image()
    {
        $image = Image::make(assets_path('img/decorator.jpeg'), null, null, false, 10);

        $this->assertImageEquals('framed-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_resized_grayscale_framed_image()
    {
        $this->markTestIncomplete('Cannot apply multiple filters using inheritance');

        $image = Image::make(assets_path('img/decorator.jpeg'), 500, 333, true, 5);

        $this->assertImageEquals('resized-grayscale-framed-image.jpeg', $image);
    }

    protected function assertImageEquals($filename, Image $image)
    {
        if (! file_exists($this->snapshotsPath($filename))) {
            imagejpeg($image->draw(), $this->snapshotsPath($filename));
            $this->markTestIncomplete("The snapshot [{$filename}] didn't exist and was created.");
        }

        imagejpeg($image->draw(), storage_path($filename));

        $this->assertTrue(
            file_get_contents($this->snapshotsPath($filename)) === file_get_contents(storage_path($filename)),
            "The drawn image does not match the expected image [{$filename}]"
        );
    }

    protected function snapshotsPath($filename)
    {
        return __DIR__.'/snapshots/'.$filename;
    }
}