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
                'daily_reward' => 1.5,
                'total_reward' => 10.5, // 1.5 x 7
                'duration_days' => 7,
                'duration_hours' => 168,
                'power' => 8.50,
                'image' => 'uploads/mining/ant-s1.png',
            ],
            [
                'name' => 'Ant Miner S9',
                'slug' => 'ant-miner-s9',
                'description' => 'Popular and reliable miner with stable daily rewards.',
                'price' => 10.00,
                'daily_reward' => 3.0,
                'total_reward' => 45.0, // 3.0 × 15
                'duration_days' => 15,
                'duration_hours' => 360,
                'power' => 14.00,
                'image' => 'uploads/mining/ant-s9.png',
            ],
            [
                'name' => 'Ant Miner T17',
                'slug' => 'ant-miner-t17',
                'description' => 'Mid-range mining machine with improved efficiency.',
                'price' => 25.00,
                'daily_reward' => 5.5,
                'total_reward' => 165.0, // 5.5 × 30
                'duration_days' => 30,
                'duration_hours' => 720,
                'power' => 42.00,
                'image' => 'uploads/mining/ant-t17.png',
            ],
            [
                'name' => 'Ant Miner S19 Pro',
                'slug' => 'ant-miner-s19-pro',
                'description' => 'High-performance miner designed for serious miners.',
                'price' => 50.00,
                'daily_reward' => 9.0,
                'total_reward' => 405.0, // 9.0 × 45
                'duration_days' => 45,
                'duration_hours' => 1080,
                'power' => 110.00,
                'image' => 'uploads/mining/ant-s19-pro.png',
            ],
            [
                'name' => 'Ant Miner S21 XP',
                'slug' => 'ant-miner-s21-xp',
                'description' => 'Next-generation mining beast with maximum output.',
                'price' => 100.00,
                'daily_reward' => 18.0,
                'total_reward' => 1080.0, // 18 × 60
                'duration_days' => 60,
                'duration_hours' => 1440,
                'power' => 250.00,
                'image' => 'uploads/mining/ant-s21-xp.png',
            ],
        ]);
    }
}
