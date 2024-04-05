<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

  
            // Crear un usuario con el rol de teacher
            $teacher = \App\Models\User::factory()->teacher()->create();
        
            // Crear un registro en la tabla de teachers con el id del usuario creado
            \App\Models\Teachers::create([
                'users_id' => $teacher->id,
                'license'=> rand(1000000000, 9999999999),
                'professional_tittle' => str::random(10),
                'subjects_taught'=>Str::random(10),
                'enrollment' => rand(1000000000, 9999999999)
            ]);
        
            // Crear un usuario con el rol de student
            $student = \App\Models\User::factory()->student()->create();
        
            // Crear un registro en la tabla de students con el id del usuario creado
            \App\Models\Students::create([
                'users_id' => $student->id,
                'career'=> str::random(8),
                'enrollment' => rand(1000000000, 9999999999)
            ]);
        
    }
}
