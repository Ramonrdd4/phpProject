<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //se crea un objeto de tipo usuario, pueden ser varios, cuando hay un :: es un facade
       $objetoUsuario= \App\User::create([
            'correo'=>'fabiola@gmail.com',
            'contrasenna'=>bcrypt('usuario123'),
            'nobre'=>'Fabiola',
            'primerApellido'=>'Alfaro',
            'segundoApellido'=>'Lopez',
            'sexo'=>'femenino',
            'role_id'=>1
        ]);
        $objetoUsuario->save();

        $objetoUsuario= \App\User::create([
            'correo'=>'jose@gmail.com',
            'contrasenna'=>bcrypt('usuario123'),
            'nobre'=>'Jose',
            'primerApellido'=>'Rodriguez',
            'segundoApellido'=>'Rodriguez',
            'sexo'=>'masculino',
            'role_id'=>3
        ]);
    }
}
