<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    /**
     * Admin auth feature test.
     *
     * @return void
     */
    public function test_visit_admin_dashboard_redirected_to_login()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect(route('login'));
    }
}
