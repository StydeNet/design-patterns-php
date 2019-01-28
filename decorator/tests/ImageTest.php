<?php

namespace Styde\Tests;

use Styde\FramedDecorator;
use Styde\GrayscaleDecorator;
use Styde\ImageJpeg;
use Styde\ResizeDecorator;

class ImageTest extends TestCase
{
    /** @test */
    function it_can_draw_an_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $this->assertImageEquals('basic-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_resized_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));
        $image = new ResizeDecorator($image, 500, 333);

        $this->assertImageEquals('resized-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_grayscale_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));
        $image = new GrayscaleDecorator($image);

        $this->assertImageEquals('grayscale-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_framed_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));
        $image = new FramedDecorator($image, 10);

        $this->assertImageEquals('framed-image.jpeg', $image);
    }

    /** @test */
    function it_can_draw_a_resized_grayscale_framed_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));
        $image = new ResizeDecorator($image, 500, 333);
        $image = new GrayscaleDecorator($image);
        $image = new FramedDecorator($image, 5);

        $this->assertImageEquals('resized-grayscale-framed-image.jpeg', $image);
    }

    protected function assertImageEquals($filename, $image)
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