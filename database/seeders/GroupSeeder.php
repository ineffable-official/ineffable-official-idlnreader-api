<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::factory()->create([
            "name" => "Tensei shitara slime datta-ken",
        ]);

        Group::factory()->create([
            "name" => "One punch man",
        ]);

        Group::factory()->create([
            "name" => "Tensei shitara slime datta-ken",
        ]);

        Group::factory(5)->create();
    }
}
