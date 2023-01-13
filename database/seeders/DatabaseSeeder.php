<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Saw Kyaw Myint',
            'email' => 'sawkyaw@gmail.com',
            'password'=> Hash::make('Saw777236'),
             'bio'=>'bar nyar nyar'
        ]);
        // \App\Models\Category::factory(5)->create();
        $category=['programing','health','history','Science'];
        foreach ($category as $key => $cat) {
            \App\Models\Category::factory()->create([
                'ctitle' => $cat,
            ]);
            // \App\
        }

    }
}
