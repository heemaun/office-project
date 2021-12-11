<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        // app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);
        Permission::create(['name' => 'comment']);
        Permission::create(['name' => 'mail']);


        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('create post');
        $role1->givePermissionTo('edit post');
        $role1->givePermissionTo('delete post');
        $role1->givePermissionTo('comment');
        $role1->givePermissionTo('mail');

        $role2 = Role::create(['name' => 'writer']);
        $role2->givePermissionTo('create post');
        $role2->givePermissionTo('edit post');
        $role2->givePermissionTo('comment');
        $role2->givePermissionTo('mail');

        $role3 = Role::create(['name' => 'editor']);
        $role3->givePermissionTo('edit post');
        $role3->givePermissionTo('comment');

        $role4 = Role::create(['name' => 'user']);
        $role4->givePermissionTo('comment');

        $user = User::create([
            'id' => '1',
            'name' => 'admin',
            'email' => 'office.project.11.12.2021@gmail.com',
            'password' => Hash::make('11111111'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);

        $user->assignRole($role1);

        $user = User::create([
            'id' => '2',
            'name' => 'Md. Maksuduzzaman Maun',
            'email' => 'heemaun@gmail.com',
            'password' => Hash::make('11111111'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);

        //$user = DB::table('users')->get('id',1);
        $user->assignRole($role1);

        $user = User::create([
            'id' => '3',
            'name' => 'Maun Zaman',
            'email' => 'maunzaman@gmail.com',
            'password' => Hash::make('11111111'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);

        //$user = DB::table('users')->get('id',1);
        $user->assignRole($role2);

        $user = User::create([
            'id' => '4',
            'name' => 'Heem Zaman',
            'email' => 'heemzaman@gmail.com',
            'password' => Hash::make('11111111'),
            'email_verified_at' => Carbon::now()->toDateTimeString(),
        ]);

        //$user = DB::table('users')->get('id',1);
        $user->assignRole($role3);
    }
}
