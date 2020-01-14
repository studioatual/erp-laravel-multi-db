<?php

namespace Tests\Feature\Api\Panel;

use Tests\TestCase;
use App\Models\Plan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlansTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function plans_can_be_listed()
    {
        $this->withoutExceptionHandling();

        $plans = factory(Plan::class, 3)->create();
        $response = $this->get('/api/panel/plans');
        $response->assertJsonCount(count($plans));
    }

    /** @test */
    public function a_plan_can_be_added()
    {
        $this->withoutExceptionHandling();

        $data = $this->data();
        $this->post('/api/panel/plans', $data);
        $plan = Plan::first();

        $this->assertEquals($data['name'], $plan->name);
        $this->assertEquals($data['price'], $plan->price);
        $this->assertEquals($data['description'], $plan->description);
    }

    /** @test */
    public function fields_are_required()
    {
        //$this->withoutExceptionHandling();

        collect(['name', 'price', 'description'])
            ->each(function ($field) {
                $response = $this->post(
                    '/api/panel/plans',
                    array_merge($this->data(), [$field => ''])
                );
                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Plan::all());
            });
    }

    /** @test */
    public function a_plan_can_be_retrieved()
    {
        $this->withoutExceptionHandling();

        $plan = factory(Plan::class)->create();
        $response = $this->get('/api/panel/plans/' . $plan->id);
        $response->assertJson([
            'name' => $plan->name,
            'price' => $plan->price,
            'description' => $plan->description,
        ]);
    }

    /** @test */
    public function a_plan_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $plan = factory(Plan::class)->create();
        $data = $this->data();
        $this->put('/api/panel/plans/' . $plan->id, $data);
        $plan = $plan->fresh();

        $this->assertEquals($data['name'], $plan->name);
        $this->assertEquals($data['price'], $plan->price);
        $this->assertEquals($data['description'], $plan->description);
    }

    /** @test */
    public function a_plan_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $plan = factory(Plan::class)->create();
        $this->delete('/api/panel/plans/' . $plan->id);
        $this->assertCount(0, Plan::all());
    }

    private function data()
    {
        return [
            'name' => 'Discovery',
            'price' => 135.50,
            'description' => 'Plano de Teste chamado Discovery'
        ];
    }
}
