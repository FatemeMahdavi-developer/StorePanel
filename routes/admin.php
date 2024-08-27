<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


Route::get('/', function () {
    // $role = Role::where('name','writer')->first();
    // $permission = Permission::create(['name' => 'edit articles']);
    // $permission->assignRole($role);
    // $role->revokePermissionTo('edit articles');
// $permission->removeRole($role);
    return view('admin.base');
})->middleware(['auth:admin'])->name('base');


require __DIR__.'/auth_admin.php';
