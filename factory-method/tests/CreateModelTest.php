<?php

namespace Styde\Tests;

use Styde\Models\BaseModel;

class CreateModelTest extends TestCase
{
    /** @test */
    function a_model_can_be_instantiated()
    {
        $model = new ExampleModel;

        $this->assertInstanceOf(ExampleModel::class, $model);
    }

    /** @test */
    function has_dynamic_access_to_attributes()
    {
        $model = new ExampleModel;
        $model->name = 'Duilio';
        $model->email = 'duilio@styde.net';

        $this->assertSame('Duilio', $model->name);
        $this->assertSame('duilio@styde.net', $model->email);
    }

    /** @test */
    function only_fillable_attributes_are_assigned()
    {
        $model = new ExampleModel([
            'name' => 'Duilio',
            'last_name' => 'Palacios',
        ]);

        $this->assertSame('Duilio', $model->name);
        $this->assertNull($model->last_name);
    }

    /** @test */
    function an_unguarded_model_accepts_all_attributes()
    {
        $model = new ExampleModel;

        $model->unguard();

        $model->setAttributes([
            'first_name' => 'Duilio',
        ]);

        $this->assertSame('Duilio', $model->first_name);

        $model->reguard();

        $model->setAttributes([
            'last_name' => 'Palacios',
        ]);

        $this->assertNull($model->last_name);
    }

    /** @test */
    function a_model_can_be_saved()
    {
        $model = new ExampleModel();

        $model->save();

        $this->assertTrue($model->wasRecentlyCreated);
    }
}

class ExampleModel extends BaseModel
{
    protected $fillable = ['name', 'email'];
}
