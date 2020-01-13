<?php

namespace App\Http\Controllers\Api\Panel;

use App\Models\Plan;
use App\Http\Controllers\Controller;

class PlansController extends Controller
{
    public function index()
    {
        return Plan::all();
    }

    public function store()
    {
        return Plan::create($this->validateData());
    }

    public function show(Plan $plan)
    {
        return $plan;
    }

    public function update(Plan $plan)
    {
        $plan->update($this->validateData());
        return $plan;
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();
        return json_encode(['result' => 'ok']);
    }

    private function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required'
        ]);
    }
}
