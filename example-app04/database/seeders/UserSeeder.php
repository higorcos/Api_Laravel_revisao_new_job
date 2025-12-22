<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //De 1 -> N
        User::factory(5)
            ->has(Car::factory(1)) // ou hasCars - "Nome da relação dentro de users:model"
            ->create(); 
        //Cada usuário vai ter um carro cada
    }
}
