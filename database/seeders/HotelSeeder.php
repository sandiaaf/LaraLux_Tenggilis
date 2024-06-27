<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hotels')->insert([
            [
                'name'=> 'Atanaya Kuta Bali',
                'address'=>'kuta',
                'postcode'=>'80361',
                'city'=>'Badung',
                'state'=>'Bali',
                'country_id'=>3,
                'longitude'=>'1.421.403',
                'latitude'=>'-342.039',
                'phone'=>'082274748685',
                'fax'=>'1 913 727-2777',
                'email'=>'info@yourdomain.com',
                'currency'=>'Rupiah',
                'accommodation_type'=>'Hotel',
                'category'=>5,
                'web'=>'http://www.yourdomain.com/hotel',
                'type_id'=>2
            ],
            [
                'name'=> 'Yello',
                'address'=>'Mejoyo',
                'postcode'=>'60474',
                'city'=>'Rungkut',
                'state'=>'Surabaya',
                'country_id'=>4,
                'longitude'=>'1.421.403',
                'latitude'=>'-342.039',
                'phone'=>'081364567867',
                'fax'=>'1 913 727-2777',
                'email'=>'info@yourdomain.com',
                'currency'=>'Rupiah',
                'accommodation_type'=>'Hotel',
                'category'=>5,
                'web'=>'http://www.yourdomain.com/hotel',
                'type_id'=>2
            ]
        ]);
    }
}
