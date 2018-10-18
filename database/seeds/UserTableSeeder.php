<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
    * @param int $length
    * @return string
    */
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function run(Faker\Generator $faker)
    {
        User::truncate();
        DB::delete('TRUNCATE role_user');

        //-------------------------------------------------
        // Ben-Piet
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Ben-Piet',
            'lastname'     => 'O\'Callaghan',
            'cellphone'    => '123456789',
            'email'        => 'bpocallaghan@gmail.com',
            'gender'       => 'ninja',
            'password'     => bcrypt('password'),
            'confirmed_at' => Carbon::now(),
            'stream_key'   => $this->generateRandomString(),
            'api_key'      => $this->generateRandomString()
        ]);

        $this->addAllRolesToUser($user);

        //-------------------------------------------------
        // GitHub
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Github',
            'lastname'     => 'Administrator',
            'cellphone'    => '123456789',
            'email'        => 'github@bpocallaghan.co.za',
            'gender'       => 'male',
            'password'     => bcrypt('github'),
            'confirmed_at' => Carbon::now(),
            'stream_key'   => $this->generateRandomString(),
            'api_key'      => $this->generateRandomString()
        ]);

        $this->addAllRolesToUser($user);

        //-------------------------------------------------
        // Default Admin
        //-------------------------------------------------
        $user = User::create([
            'firstname'    => 'Pavel',
            'lastname'     => 'Tashev',
            'cellphone'    => '123456789',
            'email'        => 'paveltashev@gmail.com',
            'gender'       => 'male',
            'password'     => bcrypt('par01a10'),
            'confirmed_at' => Carbon::now(),
            'stream_key'   => '1bibilo8kH',
            'api_key'      => 'KBy1eLuY5q'
        ]);

        $this->addAllRolesToUser($user);

        // dummy users
        /*for ($i = 0; $i < 5; $i++) {
            $user = User::create([
                'firstname'    => $faker->firstName,
                'lastname'     => $faker->lastName,
                'cellphone'    => $faker->phoneNumber,
                'email'        => $faker->email,
                'gender'       => $faker->randomElement(['male', 'female']),
                'password'     => bcrypt('secret'),
                'confirmed_at' => Carbon::now()
            ]);

            $user->syncRoles([
                \App\Models\Role::$WEBSITE,
            ]);
        }*/
    }

    private function addAllRolesToUser($user)
    {
        $user->syncRoles([
            \App\Models\Role::$WEBSITE,
            \App\Models\Role::$ADMIN,
            \App\Models\Role::$ADMIN_SUPER,
            \App\Models\Role::$DEVELOPER,
        ]);
    }
}