<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('allows super_admin user (Isaias) to access /dashboard (/admin)', function () {
    $user = User::where('email', 'isaiasxavier@dominicus.nl')->first();
    $this->assertNotNull($user);

    actingAs($user);

    $response = get('/dashboard');

    $response->assertOk();
    $this->assertTrue($user->hasRole('super_admin'));
});


it('allows super_admin user (Simon) to access /dashboard (/admin)', function () {
    $user = User::where('email', 'simon@dominicus.nl')->first();
    $this->assertNotNull($user);

    actingAs($user);

    $response = get('/dashboard');

    $response->assertOk();
    $this->assertTrue($user->hasRole('super_admin'));
});



it('allows admin (dennis) user to access /dashboard (/admin)', function () {
    $user = User::where('email', 'dennis@dominicus.nl')->first();
    $this->assertNotNull($user);

    actingAs($user);

    $response = get('/dashboard');

    $response->assertOk();
    $this->assertTrue($user->hasRole('admin'));
});

it('allows admin (Yesser) user to access /dashboard (/admin)', function () {
    $user = User::where('email', 'yesser@dominicus.nl')->first();
    $this->assertNotNull($user);

    actingAs($user);

    $response = get('/dashboard');

    $response->assertOk();
    $this->assertTrue($user->hasRole('admin'));
});






