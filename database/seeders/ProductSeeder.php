<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('products')->insert([
        //     'name' => 'Suite',
        //     'hotel_id' => 5,
        //     'type_room' => 'Single',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'image' => 'Single2.png'
        // ]);

        // DB::table('products')->insert([
        //     'name' => 'Deluxe Queen',
        //     'hotel_id' => 5,
        //     'type_room' => 'Single Semi Double',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'image' => 'SemiDouble2.png'

        // ]);
        DB::table('products')->insert([
            'name' => 'Executive King',
            'hotel_id' => 7,
            'type_room' => 'Standard Double',
            'price' => 105000,
            'created_at' => now(),
            'updated_at' => now(),
            'image' => 'Double2.png',
            'available_room' => 26

        ]);

        // DB::table('products')->where('id', '3')
        //     ->update(['available_room' => 4]);

        // DB::table('products')->where('id', '4')
        // ->update(['available_room' => 22]);
    }
}
