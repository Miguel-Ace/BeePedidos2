<?php

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // $role1 = Role::create([
        //     'name' => 'Vendedor',
        //     // 'guard_name' => 'web',
        //     // 'created_at' => null,
        //     // 'updated_at' => null,
        // ]);
        // $role2 = Role::create([
        //     'name' => 'Usuario',
        //     // 'guard_name' => 'web',
        //     // 'created_at' => null,
        //     // 'updated_at' => null,
        // ]);

        // $role1 = Role::create(['name' => 'Administrador']);
        $role1 = Role::create(['name' => 'Vendedor']);
        $role2 = Role::create(['name' => 'Usuario']);

        User::create([
            'name' => 'Vendedor',
            'email' => 'vendedor@example.com',
            'password' => Hash::make('12345678')
        ]);
        
        $user = User::find(1);
        // $user->assignRole($role1);

        if ($user) {
            $user->assignRole($role1);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
