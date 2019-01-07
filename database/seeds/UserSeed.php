<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Genealogy;
use App\GenealogyStatus;
use App\UserResume;
use App\GenealogyResume;
use App\Http\Enum\UserStatusEnum;
use App\GraduationsHist;

class UserSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        User::create([
            'id' => env('USER_INDICATOR'),
            'name' => 'Demo',
            'email' => 'demo@demo.com',
            'username' => 'vagner',
            'password' => bcrypt('zaq12wsx')
        ]);

        User::create([
            'id' => env('USER_ADMIN'),
            'name' => 'Administrator',
            'email' => 'admin@demo.com',
            'username' => 'admin',
            'is_admin' => true,
            'password' => bcrypt('zaq12wsx')
        ]);

        UserResume::create([
            'user_id' => env('USER_INDICATOR')
        ]);

        Genealogy::create([
            'user_id' => env('USER_INDICATOR'),
            'indicator' => 0,
            'status' => UserStatusEnum::ACTIVE
        ]);

        GenealogyStatus::create([
            'user_id' => env('USER_INDICATOR'),
            'status' => UserStatusEnum::ACTIVE,
        ]);

        GenealogyResume::create([
            'user_id' => env('USER_INDICATOR')
        ]);

        GraduationsHist::create([
            'graduation_id' => 1,
            'user_id' => env('USER_INDICATOR')
        ]);
    }

}
