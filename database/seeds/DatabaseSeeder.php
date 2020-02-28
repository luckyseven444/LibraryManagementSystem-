<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => '1',
            'name' => 'Jeffery Way',
            'email' => 'jeff@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'role_id' => 1,
            'remember_token' => Str::random(10)
        ]);

        DB::table('users')->insert([
            'id' => '2',
            'name' => 'Kevin Kostner',
            'email' => 'kevin@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'role_id' => 2,
            'remember_token' => Str::random(10)
        ]);

        DB::table('users')->insert([
            'id' => '3',
            'name' => 'Thomas Muller',
            'email' => 'muller@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'role_id' => 2,
            'remember_token' => Str::random(10)
        ]);

        $roles = [
            'admin', 'librarian', 'user'
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $permissions = [
            'delete users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        DB::table('model_has_permissions')->insert([
            'permission_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1
        ]);

        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\User',
            'model_id' => 1
        ]);

        DB::table('role_has_permissions')->insert([
            'permission_id' => 1,
            'role_id' => 1
        ]);

        factory(App\User::class, 10)->create();
        factory(App\Book::class, 10)->create();
        factory(App\Author::class, 15)->create();
        factory(App\CheckOut::class, 1)->create();
        factory(App\Balance::class, 1)->create();
        factory(App\Fine::class, 1)->create();
        factory(App\Location::class, 1)->create();
        factory(App\Shelf::class, 5)->create();
        factory(App\Stock::class, 1)->create();
    }
}
