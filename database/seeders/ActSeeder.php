<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ActSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Act::factory(3)->create();
    }
}
