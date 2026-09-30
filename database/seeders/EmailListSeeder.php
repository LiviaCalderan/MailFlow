<?php

namespace Database\Seeders;

use App\Models\EmailList;
use App\Models\Subscriber;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailListSeeder extends Seeder
{
    public function run(): void
    {
        EmailList::factory()->count(50)->create()
            ->each(function (EmailList $emailList) {
                Subscriber::factory()
                    ->count(rand(50, 150))
                    ->create(['email_list_id' => $emailList->id]);
            });
    }
}
