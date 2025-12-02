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

        //De 1 -> N
        User::factory(5)
            ->has(Car::factory(1)) // ou hasCars - "Nome da relação dentro de users:model"
            ->create();
        //Cada usuário vai ter um carro cada


        //De N -> 1


        //Car::factory()->count(5)->create();


       /*  User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */
    }
 } 
