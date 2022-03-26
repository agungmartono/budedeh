<?php
/*
 * @Author: Agung Martono
 * @Github: https://github.com/agungmartono
 * @Email: agungmartonolabs@gmail.com
 */

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Room;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secure'),
        ]);

        // 0 rawat jalan, 1 rawat inap
        Room::create([
            'installation' => FALSE,
            'name' => 'Poli Mata',
        ]);

        Room::create([
            'installation' => FALSE,
            'name' => 'Poli Jantung',
        ]);

        Room::create([
            'installation' => TRUE,
            'name' => 'Ruangan Elang',
        ]);

        Room::create([
            'installation' => TRUE,
            'name' => 'Ruangan Perkutut',
        ]);

        Doctor::create([
            'name' => 'Dr. Luhut Situmorang'
        ]);

        Doctor::create([
            'name' => 'Dr. Jokowi'
        ]);

        Doctor::create([
            'name' => 'Dr. Prabowo'
        ]);

        Patient::create([
            'norm' => '000001',
            'name' => 'waluyo',
            'gender' => TRUE,
            'address' => 'serang walantaka',
            'dob' => now(),
            'pob' => 'Pandeglang',
        ]);

        
    }
}
