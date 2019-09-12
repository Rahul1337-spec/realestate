<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Truncate();

        $AdminUser = Role::where('name','admin')->first();
        $UserRole = Role::where('name','user')->first();
        $AgentRole = Role::where('name','agent')->first();
        $BuilderRole = Role::where('name','builder')->first();

        $NmAdmin = User::create([
            'name' => 'Admin',
            'email' => 'nmadmin1@gmail.com',
            'password' => bcrypt('nmadmin')
        ]);

        $subscriber = User::create([
            'name' => 'tester',
            'email' => 'tester3@gmail.com',
            'password' => bcrypt('tester@12')
        ]);

        $agent = User::create([
            'name' => 'agenttest',
            'email' => 'agenttest@gmail.com',
            'password' => bcrypt('tester@12')
        ]);

        $builder = User::create([
            'name' => 'buildertest',
            'email' => 'buildertest@gmail.com',
            'password' => bcrypt('tester@12')
        ]);

        $NmAdmin->roles()->attach($AdminUser);
        $subscriber->roles()->attach($UserRole);
        $agent->roles()->attach($AgentRole);
        $builder->roles()->attach($BuilderRole);

    }
}
