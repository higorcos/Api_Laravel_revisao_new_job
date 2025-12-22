<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CarSeeder::class);
        $this->call(UserSeeder::class);

        //Criar um por um
        //User::factory(4)->create();
        //Car::factory(5)->create(); //Não vai funcionar assim tem um relacionamento na tabela

    }
 } 
