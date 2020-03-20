<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Schema::disableForeignKeyConstraints();
    	DB::table('roles')->truncate();
    	DB::table('permissions')->truncate();
    	DB::table('role_has_permissions')->truncate();
    	DB::table('model_has_roles')->truncate();
    	DB::table('model_has_permissions')->truncate();
    	Schema::enableForeignKeyConstraints();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $collection = collect([
            'users',
            'roles',
            'markets',
            'pages',
            'categories',
            'tags',
            'coupons',
            'attributes',
            'logos',
            'show schedule',
            'freemails',
            'leads',
            'maps'
        ]);

       $collection->each(function ($item, $key) {
            // create permissions for each collection item
            Permission::create(['group' => $item, 'name' => 'view ' . $item]);
            Permission::create(['group' => $item, 'name' => 'create ' . $item]);
            Permission::create(['group' => $item, 'name' => 'edit ' . $item]);
            Permission::create(['group' => $item, 'name' => 'delete ' . $item]);
            Permission::create(['group' => $item, 'name' => 'manage ' . $item]);
        });

       $softDeleteCollection = collect([
            'articles',
            'events',
            'advertisers',
            'distributors',
        ]);

       $softDeleteCollection->each(function ($item, $key) {
            // create permissions for each soft delete collection item
            Permission::create(['group' => $item, 'name' => 'view ' . $item]);
            Permission::create(['group' => $item, 'name' => 'create ' . $item]);
            Permission::create(['group' => $item, 'name' => 'edit ' . $item]);
            Permission::create(['group' => $item, 'name' => 'delete ' . $item]);
            Permission::create(['group' => $item, 'name' => 'manage ' . $item]);
            Permission::create(['group' => $item, 'name' => 'restore ' . $item]);
            Permission::create(['group' => $item, 'name' => 'forceDelete ' . $item]);
        });

        // create roles and assign created permissions
		$role = Role::create(['name' => 'admin']);
		$role = Role::create(['name' => 'web-developer']);
		$role = Role::create(['name' => 'writer']);
		$role = Role::create(['name' => 'traffic']);
		$role = Role::create(['name' => 'sales']);
		$role = Role::create(['name' => 'distribution']);
		$role = Role::create(['name' => 'artist']);

        // Create a Super-Admin Role and assign all permissions to it
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        // Give User Super-Admin Role
        $user = App\User::whereEmail('meredith@sunnydayguide.com')->first(); // enter your email here 
        $user->assignRole('super-admin');
    }
}
