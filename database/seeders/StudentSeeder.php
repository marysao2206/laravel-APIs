<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {

        DB::table('students')->insert([
            [
                'student_id' => 'ST001',
                'email' => 'mary@gmail.com',
                'phone'=>'0167014332',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'ST002',
                'email' => 'sophal@gmail.com',
                'phone'=>'0167014332',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => 'ST003',
                'email' => 'vanda@gmail.com',
                'phone'=>'0167014332',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}