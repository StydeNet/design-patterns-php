<?php

namespace Styde\Tests;

use Mockery;
use Styde\Html\TextElement;
use Styde\Html\VoidElement;
use Styde\Html\PairedElement;

class CacheTest extends TestCase
{
    /** @test */
    function the_generated_html_is_cached()
    {
        $form = new class extends PairedElement {
            public function tagName() { return 'form'; }
        };

        $input = Mockery::spy(VoidElement::class, [
            'render' => '<input>'
        ]);

        $form->add($input);

        $firstResult = $form->render();
        $secondResult = $form->render();

        $this->assertSame('<form><input></form>', $firstResult);
        $this->assertSame('<form><input></form>', $secondResult);

        $input->shouldHaveReceived('render')->once();
    }

    /** @test */
    function html_is_regenerated_after_adding_a_new_child()
    {
        $form = new class extends PairedElement {
            public function tagName() { return 'form'; }
        };

        $label = new class extends PairedElement {
            public function tagName() { return 'label'; }
        };

        $input = new class extends VoidElement {
            public function tagName() { return 'input'; }
        };

        $form->add($label);

        $firstResult = $form->render();

        $form->add($input);

        $secondResult = $form->render();

        $this->assertSame('<form><label></label></form>', $firstResult);
        $this->assertSame('<form><label></label><input></form>', $secondResult);
    }

    /** @test */
    function html_is_regenerated_after_adding_a_new_grandchild()
    {
        $form = new class extends PairedElement {
            public function tagName() { return 'form'; }
        };

        $label = new class extends PairedElement {
            public function tagName() { return 'label'; }
        };

        $form->add($label);

        $firstResult = $form->render();

        $label->add(new TextElement('Label text'));

        $secondResult = $form->render();

        $this->assertSame('<form><label></label></form>', $firstResult);
        $this->assertSame('<form><label>Label text</label></form>', $secondResult);
    }
}
