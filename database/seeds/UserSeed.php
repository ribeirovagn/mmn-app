<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Genealogy;
use App\GenealogyStatus;
use App\UserResume;
use App\GenealogyResume;

use App\Http\Enum\UserStatusEnum;

class UserSeed extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        $userCreate = User::create([
                    'name' => 'Demo',
                    'email' => 'demo@demo.com',
                    'username' => 'vagner',
                    'password' => bcrypt('zaq12wsx')
        ]);
        
        User::create([
                    'name' => 'Administrator',
                    'email' => 'admin@demo.com',
                    'username' => 'admin',
                    'is_admin' => true,
                    'password' => bcrypt('zaq12wsx')
        ]);
        
        UserResume::create([
            'user_id' => $userCreate->id
        ]);

        $genealogy = Genealogy::create([
                    'user_id' => $userCreate->id,
                    'indicator' => 0,
                    'status' => UserStatusEnum::PENDING
        ]);

        GenealogyStatus::create([
            'user_id' => $userCreate->id,
            'status' => $genealogy->status,
        ]);
        
        GenealogyResume::create([
            'user_id' => $userCreate->id
        ]);
    }

}
