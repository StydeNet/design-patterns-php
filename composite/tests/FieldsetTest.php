<?php

namespace Styde\Tests;

use Styde\Html\Fieldset;

class FieldsetTest extends TestCase
{
    /** @test */
    function it_can_add_and_get_elements()
    {
        $fieldset = new Fieldset;

        $fieldset->add('Element');

        $this->assertSame('Element', $fieldset->getChild(0));
    }

    /** @test */
    function it_can_render_elements_as_plain_html()
    {
        $fieldset = new Fieldset;

        $this->assertSame('<fieldset></fieldset>', $fieldset->render());
    }

    /** @test */
    function it_can_remove_elements()
    {
        $fieldset = new Fieldset;

        $fieldset->add('Element');

        $this->assertCount(1, $fieldset->getChildren());

        $fieldset->remove('Element');

        $this->assertCount(0, $fieldset->getChildren());
    }
}