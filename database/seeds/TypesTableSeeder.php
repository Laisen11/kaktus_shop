<?php

use App\Type;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create([
            'name' => 'Cactus',
        ]);
        Type::create([
            'name' =>'Succulent'
        ]);
    }
}
