<?php

namespace Styde\Tests;

use Styde\Forms\LoginForm;

class LoginFormTest extends TestCase
{
    /** @test */
    function it_builds_a_login_form()
    {
        $loginForm = new LoginForm;

        $form = $loginForm->build();

        $expected = <<<HTML
<form action="/login" method="POST">
    <input name="csrf_token" type="hidden" value="token_here">
    <label for="email" class="sr-only">Email address</label>
    <input name="email" type="email" id="email" class="form-control" required placeholder="Email address" autofocus>
    <label for="password" class="sr-only">Password</label>
    <input name="password" type="password" id="password" class="form-control" required placeholder="Password">
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
