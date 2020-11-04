<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =  new \App\User;
        $user->username = "admin";
        $user->name = "wahyu";
        $user->email = "administrator@mail.com";
        $user->password = \Hash::make("admin");
        $user->level = "admin";
        $user->save();
        $this->command->info("user Admin Berhasil Dibuat");
    }
}
