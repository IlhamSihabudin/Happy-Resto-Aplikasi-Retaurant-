<?php

use Illuminate\Database\Seeder;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama_level' => 'admin'],
            ['nama_level' => 'waiter'],
            ['nama_level' => 'kasir'],
            ['nama_level' => 'owner'],
            ['nama_level' => 'pelanggan']
        ];

        \App\Level::insert($data);
    }
}
