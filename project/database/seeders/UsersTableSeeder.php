<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {

        $user = User::firstOrNew([
            'email' => 'admin@email.com',
        ]);

        $user->fill([
            'name' => 'Admin',
            'password' => \Hash::make('12345678')
        ]);

        $user->save();


        $user = User::firstOrNew([
            'email' => 'pedrohsida@hotmail.com',
        ]);

        $user->fill([
            'name' => 'Administrador',
            'password' => \Hash::make('josecuervo')
        ]);

        $user->save();

    }
}
