<?php

namespace Database\Seeders;

use App\Models\RunningTextModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RunningTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RunningTextModel::create([
            "text" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt impedit est a dicta animi quas non reprehenderit vel rem et atque culpa magni voluptatum iure facere ex, eaque eum fugiat!",
        ]);
    }
}
