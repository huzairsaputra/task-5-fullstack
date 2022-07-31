<?php
use App\Models\Category;

it('[GET index] redirects to login page with user not logged in', function () {
    $response = $this->get(route('categories.index'));
    $response->assertStatus(302);
    $response->assertRedirect('login');
});

it('[GET index] returns to categories page with user logged in', function (){
    $response = actingAsUser()->get(route('categories.index'));
    $response->assertStatus(200);
});

it('[GET create] redirects to login page with user not logged in', function () {
    $response = $this->get(route('categories.create'));
    $response->assertStatus(302);
    $response->assertRedirect('login');
});

it('[GET create] returns to categories page with user logged in', function (){
    $response = actingAsUser()->get(route('categories.create'));
    $response->assertStatus(200);
});

it('[POST store] redirects to login page with user not logged in', function (){
    $response = $this->get(route('categories.store'));
    $response->assertStatus(302);
    $response->assertRedirect('login');
});
