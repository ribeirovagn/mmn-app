<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Genealogy;
use App\GenealogyStatus;
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
                    'password' => bcrypt('zaq12wsx')
        ]);

        $genealogy = Genealogy::create([
                    'user_id' => $userCreate->id,
                    'indicator' => 0,
                    'status' => UserStatusEnum::PENDING
        ]);

        GenealogyStatus::create([
            'status' => $genealogy->status,
            'user_id' => $genealogy->user_id,
        ]);
    }

}
