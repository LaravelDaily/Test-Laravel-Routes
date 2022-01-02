<?php

use App\Models\User;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows welcome on home screen')
    ->get('/')
    ->assertViewIs('welcome')
    ->assertViewHas('pageTitle', 'Homepage');

it('existing users page found', function () {
    $user = User::factory()->create();
    $response = $this->get('/user/' . $user->name);

    $response->assertOk();
    $response->assertViewIs('users.show');
});

it('nonexisting users page not found')
    ->get('/user/sometotallynonexistinguser')
    ->assertViewIs('users.notfound');

it('loads about page')
    ->get('/about')
    ->assertViewIs('pages.about');

it('checks if auth middleware works', function () {
    $response = $this->get('/app/dashboard');
    $response->assertRedirect('/login');

    $response = $this->get('/app/tasks');
    $response->assertRedirect('/login');
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
    $response = $this->get('/admin/dashboard');
    $response->assertRedirect('login');

    $response = $this->get('/admin/stats');
    $response->assertRedirect('login');

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/admin/dashboard');
    $response->assertStatus(403);

    $response = $this->actingAs($user)->get('/admin/stats');
    $response->assertStatus(403);

    $admin = User::factory()->create(['is_admin' => 1]);

    $response = $this->actingAs($admin)->get('/admin/dashboard');
    $response->assertViewIs('admin.dashboard');

    $response = $this->actingAs($admin)->get('/admin/stats');
    $response->assertViewIs('admin.stats');
});
