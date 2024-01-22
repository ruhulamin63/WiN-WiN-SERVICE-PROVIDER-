<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $area = [
            ['name' => 'Area 1', 'code' => '10'],
            ['name' => 'Area 2', 'code' => '20'],
            ['name' => 'Area 3', 'code' => '30'],
            ['name' => 'Area 4', 'code' => '40'],
            ['name' => 'Area 5', 'code' => '50'],
            ['name' => 'Area 6', 'code' => '60'],
            ['name' => 'Area 7', 'code' => '70'],
            ['name' => 'Area 8', 'code' => '80'],
            ['name' => 'Area 9', 'code' => '90'],
            ['name' => 'Area 10', 'code' => '100'],
        ];

        foreach ($area as $key => $value) {
            Area::insert($value);
        }
    }
}
