<?php

namespace Styde\Tests;

use Styde\Html\Form;

class FormTest extends TestCase
{
    /** @test */
    function it_can_add_and_get_elements()
    {
        $form = new Form;

        $form->add('Element');

        $this->assertSame('Element', $form->getChild(0));
    }

    /** @test */
    function it_can_render_elements_as_plain_html()
    {
        $form = new Form;

        $this->assertSame('<form></form>', $form->render());
    }

    /** @test */
    function it_can_remove_elements()
    {
        $form = new Form;

        $form->add('Element');

        $this->assertCount(1, $form->getChildren());

        $form->remove('Element');

        $this->assertCount(0, $form->getChildren());
    }
}