<?php

use App\Models\City;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->seed();

    $this->user = User::all()->random();
    $this->actingAs($this->user);

    $this->city = City::factory()->make();
});

test('Index', function () {
    $this->get(route('cities.index'))
        ->assertInertia(
            fn(AssertableInertia $page) => $page
                ->component('pages/cities/index')
                ->has('cities')
        );
});

test('Create', function () {
    $this->get(route('cities.create'))
        ->assertInertia(
            fn(AssertableInertia $page) => $page
                ->component('pages/cities/create')
        );
});

test('Store', function () {
    $this->post(route('cities.store'), $this->city->getAttributes());
    $this->assertDatabaseHas(City::class, $this->city->getAttributes());
});

test('Edit', function () {
    $this->city->save();

    $this->get(route('cities.edit', ['city' => $this->city]))
        ->assertInertia(
            fn(AssertableInertia $page) => $page
                ->component('pages/cities/edit')
        );
});

test('Update', function () {
    $this->city->save();

    $this->put(route('cities.update', ['city' => $this->city->id]), $this->city->getAttributes());
    $this->assertDatabaseHas(City::class, $this->city->getAttributes());
});

test('Delete', function () {
    $this->city->save();

    $this->delete(route('cities.destroy', ['city' => $this->city->id]));
    $this->assertDatabaseMissing(City::class, $this->city->getAttributes());
});
