<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleDB = Role::whereIn('name', ['Admin','User'])->get();
        if(!empty($roleDB) && count($roleDB) > 0){
            $roleDBS = $roleDB->toarray();
            $roleArray = [];
            foreach($roleDBS as $key=>$roleDBSA){
                $roleArray[] = $roleDBS[$key]['name'];
            }

            if(!in_array('Admin',$roleArray) && !in_array('User',$roleArray)){
                Role::create([
                    'name' => 'Admin'
                ]);

                Role::create([
                    'name' => 'User'
                ]);
            }else{
                Role::where('name', 'Admin')->Update([
                    'name' => 'Admin'
                ]);

                Role::where('name', 'User')->Update([
                    'name' => 'User'
                ]);
            }
        }else{
            Role::create([
                'name' => 'Admin'
            ]);

            Role::create([
                'name' => 'User'
            ]);
        }
    }
}
