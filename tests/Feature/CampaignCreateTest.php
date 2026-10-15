<?php

use App\Models\EmailList;
use App\Models\Template;
use App\Models\User;

test('template step renders when the saved campaign session is missing body', function () {
    $response = $this
        ->actingAs(User::factory()->create())
        ->withSession(['campaigns::create' => ['name' => 'Draft campaign']])
        ->get(route('campaigns.create', ['tab' => 'template']));

    $response->assertOk();
});

test('template step preserves campaign tracking checkbox values', function () {
    $emailList = EmailList::factory()->create();
    $template = Template::factory()->create();

    $this
        ->actingAs(User::factory()->create())
        ->post(route('campaigns.create'), [
            'name' => 'Draft campaign',
            'subject' => 'Campaign subject',
            'email_list_id' => $emailList->id,
            'template_id' => $template->id,
            'track_open' => '1',
        ])
        ->assertRedirect(route('campaigns.create', ['tab' => 'template']));

    $this
        ->post(route('campaigns.create', ['tab' => 'template']), [
            'body' => '<p>Campaign body</p>',
        ])
        ->assertRedirect(route('campaigns.create', ['tab' => 'schedule']))
        ->assertSessionHas('campaigns::create.track_click', false)
        ->assertSessionHas('campaigns::create.track_open', true);
});

test('changing the selected template replaces the campaign body with its default body', function () {
    $emailList = EmailList::factory()->create();
    $firstTemplate = Template::factory()->create(['body' => '<p>First template</p>']);
    $secondTemplate = Template::factory()->create(['body' => '<p>Second template</p>']);

    $this
        ->actingAs(User::factory()->create())
        ->post(route('campaigns.create'), [
            'name' => 'Draft campaign',
            'subject' => 'Campaign subject',
            'email_list_id' => $emailList->id,
            'template_id' => $firstTemplate->id,
        ])
        ->assertSessionHas('campaigns::create.body', '<p>First template</p>');

    $this
        ->post(route('campaigns.create', ['tab' => 'template']), [
            'body' => '<p>Customized first template</p>',
        ])
        ->assertSessionHas('campaigns::create.body', '<p>Customized first template</p>');

    $this
        ->post(route('campaigns.create'), [
            'name' => 'Draft campaign',
            'subject' => 'Campaign subject',
            'email_list_id' => $emailList->id,
            'template_id' => $secondTemplate->id,
        ])
        ->assertSessionHas('campaigns::create.body', '<p>Second template</p>');
});
