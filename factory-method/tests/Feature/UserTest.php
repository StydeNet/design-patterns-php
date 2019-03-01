<?php

namespace Styde\Tests\Feature;

use Styde\Tests\TestCase;

class UserTest extends TestCase
{
    /** @test */
    function a_user_can_see_its_details()
    {
        $this->markTestIncomplete('Finish test');

        $user = new User;

        $user->setAttributes([
            'name' => 'Duilio'
        ]);

        $user->save();

        $this->get('my-profile')
            ->assertSee('Duilio');
    }
}
