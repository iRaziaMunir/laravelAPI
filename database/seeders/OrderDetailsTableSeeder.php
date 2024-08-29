<?php

namespace Database\Seeders;

use App\Models\Orderdetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orderdetail::factory()->count(10)->create();
    }
}
