<?php

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

it('shows welcome on home screen')
    ->get('/')
    ->assertViewIs('welcome')
    ->assertViewHas('pageTitle', 'Homepage');

it('finds existing users page', function () {
    $user = User::factory()->create();

    get('/user/' . $user->name)
        ->assertOk()
        ->assertViewIs('users.show');
});

it('nonexisting users page not found')
    ->get('/user/sometotallynonexistinguser')
    ->assertViewIs('users.notfound');

it('loads about page')
    ->get('/about')
    ->assertViewIs('pages.about');

it('checks if auth middleware works', function () {
    $response = $this->get('/app/dashboard');
    expect($response->isRedirect(url('/login')))
        ->toBeTrue();

    $response = $this->get('/app/tasks');
    expect($response->isRedirect(url('/login')))
        ->toBeTrue();
});

it('checks if tasks crud is working', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/app/tasks');
    $response->assertOk();

    $response = $this->actingAs($user)->get('/app/tasks/create');
    $response->assertOk();

    $response = $this->actingAs($user)->post('/app/tasks', ['name' => 'Test']);
    $response->assertRedirect('app/tasks');

    $task = Task::factory()->create();
    $response = $this->actingAs($user)->put('/app/tasks/' . $task->id, ['name' => 'Test 2']);
    $response->assertRedirect('app/tasks');

    $this->assertDatabaseHas(Task::class, ['name' => 'Test 2']);
    $response = $this->actingAs($user)->delete('/app/tasks/' . $task->id);
    $response->assertRedirect('app/tasks');
    $this->assertDatabaseMissing(Task::class, ['name' => 'Test 2']);
});

it('checks if tasks api crud is working', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/api/v1/tasks');
    $response->assertOk();

    $response = $this->actingAs($user)->post('/api/v1/tasks', ['name' => 'Test']);
    $response->assertCreated();
    $this->assertDatabaseHas(Task::class, ['name' => 'Test']);

    $task = Task::factory()->create();
    $response = $this->actingAs($user)->put('/api/v1/tasks/' . $task->id, ['name' => 'Test 2']);
    $response->assertOk();
    $this->assertDatabaseHas(Task::class, ['name' => 'Test 2']);

    $response = $this->actingAs($user)->delete('/api/v1/tasks/' . $task->id);
    $response->assertNoContent();
    $this->assertDatabaseMissing(Task::class, ['name' => 'Test 2']);
});

it('checks if admin middleware is working', function () {
    $response = get('/admin/dashboard');
    expect($response->isRedirect(url('/login')))
        ->toBeTrue();

    $response = get('/admin/stats');
    expect($response->isRedirect(url('/login')))
        ->toBeTrue();

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/admin/dashboard');

    expect($response)
        ->status()
        ->toBe(403);

    $response = $this->actingAs($user)->get('/admin/stats');

    expect($response)
        ->status()
        ->toBe(403);

    $admin = User::factory()->create(['is_admin' => 1]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');
    expect($response)
        ->assertViewIs('admin.dashboard');

    $response = $this->actingAs($admin)->get('/admin/stats');
    expect($response)
        ->assertViewIs('admin.stats');
});
