<?php

namespace Styde\Tests;

use Styde\Html\Form;
use Styde\Html\Input;
use Styde\Html\Fieldset;

class FormTest extends TestCase
{
    /** @test */
    function it_can_add_and_get_elements()
    {
        $form = new Form;

        $input = new Input('title');

        $form->add($input);

        $this->assertSame($input, $form->getChild(0));
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

        $fieldset = new Fieldset;

        $form->add($fieldset);

        $this->assertCount(1, $form->getChildren());

        $form->remove($fieldset);

        $this->assertCount(0, $form->getChildren());
    }
    
    /** @test */
    function it_renders_nested_elements()
    {
        $form = new Form;

        $fieldset = new Fieldset;

        $form->add($fieldset);

        $this->assertSame('<form><fieldset></fieldset></form>', $form->render());
    }
}
