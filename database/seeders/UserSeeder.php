<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Barangay;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Services\ActivityLogsService;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(ActivityLogsService $service)
    {
        $total_barangays = Barangay::count();

        $users = array(
            // generate sample admin
             [
                'first_name' => 'WimfsNift',
                'middle_name' => 'P',
                'last_name' => 'Admin',
                'sex' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'contact' => '09659312005',
                'email' => 'admin@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::ADMIN,
                'created_at' => now()
             ],
 
            // generate sample user
            [
                'first_name' => 'Dummy',
                'middle_name' => 'Dummy',
                'last_name' => 'Dummy',
                'sex' => 'male',
                'birth_date' => '1998/01/01',
                'address' => 'Sample Address',
                'contact' => '09659312003',
                'email' => 'dummy@gmail.com', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'first_name' => 'Reah Mae',
                'middle_name' => 'B',
                'last_name' => 'Sanchez',
                'sex' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'contact' => '09309222659',
                'email' => 'rmsanchez744@psau.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'first_name' => 'Dennis',
                'middle_name' => 'B',
                'last_name' => 'Esteron',
                'sex' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'contact' => '09511271883',
                'email' => 'desteron456@iskwela.psau.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
            [
                'first_name' => 'Darin Lowen',
                'middle_name' => 'B',
                'last_name' => 'Manalili',
                'sex' => 'male',
                'birth_date' => '2001/01/01',
                'address' => 'Sample Address',
                'contact' => '09661636895',
                'email' => 'dlmanalili724@iskwela.psau.edu.ph', 
                'password' => bcrypt('test1234'),
                'email_verified_at' => now(),
                'is_activated' => true, 
                'role_id' => Role::USER,
                'created_at' => now()
            ],
         
        );
 
          User::insert($users);

          User::all()->each(function($user) use($service){
            $user
            ->addMedia(public_path("/tmp_files/avatars/$user->id.png"))
            ->preservingOriginal()
            ->toMediaCollection('avatar_image');

            $service->log_activity(model:$user, event:'added', model_name: 'User', model_property_name: $user->full_name ?? 'Administrator');
        });
    }
}