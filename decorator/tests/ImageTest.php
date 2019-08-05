<?php

namespace Styde\Tests;


use Styde\FrameDecoratorJpeg;
use Styde\GrayscaleDecorator;
use Styde\ImageJpeg;
use Styde\ResizeDecorator;
use Styde\WatermarkDecorator;

class ImageTest extends TestCase
{
    /**
     * @test
     */
    function it_can_draw_an_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $this->assertImageEquals($image, 'basic-image.jpeg');
    }
    /**
     * @test
     */
    function it_can_draw_a_resized_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));
        $image->setDecorator(new ResizeDecorator(1000, 666));

        $this->assertImageEquals($image, 'resized-image.jpeg');
    }
    /**
     * @test
     */
    function it_can_draw_a_greyscale_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $image->setDecorator(new GrayscaleDecorator());

        $this->assertImageEquals($image, 'greyscale-image.jpeg');
    }
    /**
     * @test
     */
    function it_can_draw_a_framed_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $image->setDecorator(new FrameDecoratorJpeg(10));

        $this->assertImageEquals($image, 'framed-image.jpeg');
    }
    /**
     * @test
     */
    function it_can_draw_a_framed__resized_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $image->setDecorator(new ResizeDecorator(1000, 666));

        $image->setDecorator(new FrameDecoratorJpeg(10));

        $this->assertImageEquals($image, 'framed-sized-image.jpeg');
    }
    /**
     * @test
     */
    function it_can_draw_a_resize_greyscale_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $image->setDecorator(new ResizeDecorator(1000, 600));

        $image->setDecorator(new GrayscaleDecorator());

        $this->assertImageEquals($image, 'grey-size-image.jpeg');
    }
    /**
     * @test
     */
    function it_can_draw_a_watermarked_image()
    {
        $image = new ImageJpeg(assets_path('img/decorator.jpeg'));

        $image->setDecorator(new WatermarkDecorator( 10, 10));

        $this->assertImageEquals($image, 'watermarked-image.jpeg');
    }

    /**
     * @param ImageJpeg $image
     * @param string $filename
     */
    public function assertImageEquals($image, string $filename): void
    {
        imagejpeg($image->draw(), storage_path($filename));

        if (!file_exists($this->snapshotPath($filename))) {
            imagejpeg($image->draw(), $this->snapshotPath($filename));
            $this->markTestIncomplete('No exisitia la captura y se creó');
        }

        $this->assertTrue(file_get_contents($this->snapshotPath($filename)) === file_get_contents(storage_path($filename)), "Las imagenes son diferentes");
    }

    /**
     * @param string $filename
     * @return string
     */
    public function snapshotPath(string $filename): string
    {
        return __DIR__ . '/snapshots/' . $filename;
    }
}
