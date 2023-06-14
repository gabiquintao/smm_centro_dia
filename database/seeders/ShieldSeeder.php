<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
class ShieldSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_shield::role","view_any_shield::role","create_shield::role","update_shield::role","delete_shield::role","delete_any_shield::role","view_sist::saude","view_any_sist::saude","create_sist::saude","update_sist::saude","restore_sist::saude","restore_any_sist::saude","replicate_sist::saude","reorder_sist::saude","delete_sist::saude","delete_any_sist::saude","force_delete_sist::saude","force_delete_any_sist::saude","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user","view_utente","view_any_utente","create_utente","update_utente","restore_utente","restore_any_utente","replicate_utente","reorder_utente","delete_utente","delete_any_utente","force_delete_utente","force_delete_any_utente","gerir_utente"]},{"name":"coordenador","guard_name":"web","permissions":["view_utente","view_any_utente","create_utente","update_utente","restore_utente","restore_any_utente","replicate_utente","reorder_utente","delete_utente","delete_any_utente","force_delete_utente","force_delete_any_utente","gerir_utente","edit_utente"]},{"name":"colaborador","guard_name":"web","permissions":["view_utente","view_any_utente","update_utente","restore_utente","restore_any_utente","replicate_utente","reorder_utente","delete_utente","delete_any_utente","force_delete_utente","force_delete_any_utente","gerir_utente"]},{"name":"filament_user","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions,true))) {

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = Utils::getRoleModel()::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name']
                ]);

                if (! blank($rolePlusPermission['permissions'])) {

                    $permissionModels = collect();

                    collect($rolePlusPermission['permissions'])
                        ->each(function ($permission) use($permissionModels) {
                            $permissionModels->push(Utils::getPermissionModel()::firstOrCreate([
                                'name' => $permission,
                                'guard_name' => 'web'
                            ]));
                        });
                    $role->syncPermissions($permissionModels);

                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions,true))) {

            foreach($permissions as $permission) {

                if (Utils::getPermissionModel()::whereName($permission)->doesntExist()) {
                    Utils::getPermissionModel()::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
