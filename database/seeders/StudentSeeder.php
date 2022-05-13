<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $result = ['Teknik Informatika', 'Sistem Informasi', 'Akutansi', 'Manajemen'];
        
        for($i = 1; $i <= 1000; $i++){

            $digits = 7;
            $major  = Arr::random($result);
            $nim = rand(pow(10, $digits-1), pow(10, $digits)-1);
            
            Student::create([
                'name'      => $faker->name,
    			'nim'       => $nim,
                'major'     => $major,
    			'age'       => $faker->numberBetween(18,25),
    			'address'   => $faker->address
            ]);
      }
    }
}
