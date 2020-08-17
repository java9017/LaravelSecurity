<?php

Route::get('/test', function () {
    // CREATE ROLES    
    // return Role::create([
    //     'name' => 'Guest',
    //     'slug' => 'guest',
    //     'description' => 'Administrator',
    //     'full-access' => 'yes',
    // ]);

    // CREATE PERMISSIONS
    // return Permission::create([
    //     'name' => 'List product',
    //     'slug' => 'product.index',
    //     'description' => 'A user can list permission'
    // ]);

    // $user = User::find(1);
    // $user->roles()->attach([4, 7]); 
    // $user->roles()->detach([4]);
    // $user->roles()->sync([1, 4, 7]); # Attach & Detach 
    // return $user->roles;

    $role = Role::find(4);
    
    $role->permissions()->sync([1, 4]);
    return $role->permissions;
});