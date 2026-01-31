<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MiningMachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mining_machines')->insert([
            [
                'name' => 'Ant Miner S1 (Free Edition)',
                'slug' => 'ant-miner-s1-free',
                'description' => 'Entry-level Ant Miner for beginners. Limited power, free access.',
                'price' => 0.00,
                'daily_reward' => 0.00010,
                'total_reward' => 0.00070,
                'duration_days' => 7,
                'power' => 8.50,
            ],
            [
                'name' => 'Ant Miner S9',
                'slug' => 'ant-miner-s9',
                'description' => 'Popular and reliable miner with stable daily rewards.',
                'price' => 10.00,
                'daily_reward' => 0.00055,
                'total_reward' => 0.00825,
                'duration_days' => 15,
                'power' => 14.00,
            ],
            [
                'name' => 'Ant Miner T17',
                'slug' => 'ant-miner-t17',
                'description' => 'Mid-range mining machine with improved efficiency.',
                'price' => 25.00,
                'daily_reward' => 0.00180,
                'total_reward' => 0.05400,
                'duration_days' => 30,
                'power' => 42.00,
            ],
            [
                'name' => 'Ant Miner S19 Pro',
                'slug' => 'ant-miner-s19-pro',
                'description' => 'High-performance miner designed for serious miners.',
                'price' => 50.00,
                'daily_reward' => 0.00380,
                'total_reward' => 0.17100,
                'duration_days' => 45,
                'power' => 110.00,
            ],
            [
                'name' => 'Ant Miner S21 XP',
                'slug' => 'ant-miner-s21-xp',
                'description' => 'Next-generation mining beast with maximum output.',
                'price' => 100.00,
                'daily_reward' => 0.00850,
                'total_reward' => 0.51000,
                'duration_days' => 60,
                'power' => 250.00,
            ],
        ]);
    }
}
