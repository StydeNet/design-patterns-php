<?php

namespace Styde\Tests;

use Styde\Html\{Button, Div, Form, Input, Label, TextElement};

class FormBuilderTest extends TestCase
{
    /** @test */
    function it_builds_a_login_form()
    {
        $form = new Form(['action' => '/login', 'method' => 'POST']);

        $csrfInput = new Input('csrf_token', ['type' => 'hidden', 'name' => 'csrf_token', 'value' => 'token_here']);

        $form->add($csrfInput);

        $emailLabel = new Label(['for' => 'email', 'class' => 'sr-only']);

        $emailLabel->add(new TextElement('Email address'));

        $form->add($emailLabel);

        $emailInput = new Input('email', [
            'type' => 'email', 'id' => 'email', 'class' => 'form-control',
            'placeholder' => 'Email address', 'required', 'autofocus'
        ]);

        $form->add($emailInput);

        $passwordLabel = new Label(['for' => 'password', 'class' => 'sr-only']);

        $passwordLabel->add(new TextElement('Password'));

        $form->add($passwordLabel);

        $passwordInput = new Input('password', [
            'type' => 'password', 'id' => 'password',
            'class' => 'form-control', 'placeholder' => 'Password', 'required'
        ]);

        $form->add($passwordInput);

        $rememberMeDiv = new Div(['class' => 'checkbox mb-3']);

        $rememberMeLabel = new Label;

        $rememberMeInput = new Input('remember_me', ['type' => 'checkbox', 'value' => 'remember-me']);

        $rememberMeLabel->add($rememberMeInput);
        $rememberMeLabel->add(new TextElement(' Remember me'));

        $rememberMeDiv->add($rememberMeLabel);

        $form->add($rememberMeDiv);

        $button = new Button(['class' => 'btn btn-lg btn-primary btn-block', 'type' => 'submit']);

        $button->add(new TextElement('Sign in'));

        $form->add($button);

        $expected = <<<HTML
<form action="/login" method="POST">
    <input name="csrf_token" type="hidden" value="token_here">
    <label for="email" class="sr-only">Email address</label>
    <input name="email" type="email" id="email" class="form-control" placeholder="Email address" required autofocus>
    <label for="password" class="sr-only">Password</label>
    <input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input name="remember_me" type="checkbox" value="remember-me"> Remember me
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
HTML;

        $this->assertSame($this->removeIndentation($expected), $form->render());
    }
}
