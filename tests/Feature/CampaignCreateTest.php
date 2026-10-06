<?php

use App\Models\User;

test('template step renders when the saved campaign session is missing body', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->withSession(['campaigns::create' => ['name' => 'Draft campaign']])
        ->get(route('campaigns.create', ['tab' => 'template']));

    $response->assertOk();
});
