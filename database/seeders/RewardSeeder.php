<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rewards')->insert([
            [
                'title' => 'Facebook Follow',
                'short_description' => 'Follow our official Facebook page to earn rewards.',
                'image' => null, // optional
                'reward_amount' => 2.00,
                'action_url' => 'https://facebook.com',
            ],
            [
                'title' => 'YouTube Subscribe',
                'short_description' => 'Subscribe to our YouTube channel and get rewarded.',
                'image' => null, // optional
                'reward_amount' => 3.00,
                'action_url' => 'https://youtube.com',
            ],
        ]);
    }
}
