<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\Role;
use App\Models\User;
use App\Models\Metode;
use Illuminate\Database\Seeder;
use App\Models\CategoryParameter;
use App\Models\Home;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Role::create(['name' => 'Super_Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);

        Metode::create([
            'name' => 'Konduktometri'
        ]);

        Metode::create([
            'name' => 'Turbidimetri'
        ]);

        Metode::create([
            'name' => 'SNI'
        ]);

        Metode::create([
            'name' => 'IK'
        ]);

        Metode::create([
            'name' => 'Direct Reading Instrument'
        ]);

        Metode::create([
            'name' => 'Standard Methods'
        ]);

        Metode::create([
            'name' => 'Spektrofotometri'
        ]);

        Metode::create([
            'name' => 'Respirometric'
        ]);

        CategoryParameter::create([
            'name' => 'FISIKA'
        ]);

        CategoryParameter::create([
            'name' => 'KIMIA'
        ]);

        CategoryParameter::create([
            'name' => 'MIKROBIOLOGI'
        ]);

        CategoryParameter::create([
            'name' => 'KHUSUS'
        ]);

        CategoryParameter::create([
            'name' => 'LOGAM'
        ]);


        CategoryParameter::create([
            'name' => 'LOGAM'
        ]);


        CategoryParameter::create([
            'name' => 'LOGAM'
        ]);

        Home::create([
            'title' => 'Came And Enjoy',
            'user_id' => 1,
            'title2' => 'Your Time',
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate,
            exercitationem'
        ]);

        About::create([
            'title' => 'TENTANG',
            'title2' => 'KAMI',
            'user_id' => 1,
            'body' => 'Why This Brand ?',
            'body2' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugit saepe quibusdam accusantium accusamus reiciendis esse!'
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
