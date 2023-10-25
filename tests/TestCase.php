<?php

namespace Tests;

use App\Models\Admin;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;

    public function login(UserContract $user = null, $guard = null)
    {
        parent::actingAs($user ?? Admin::factory()->create(), $guard);
    }
}
