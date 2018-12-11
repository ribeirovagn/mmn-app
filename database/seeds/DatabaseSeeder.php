<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(GraduationSeeder::class);
         $this->call(UserSeed::class);
         $this->call(BonusSeed::class);
         $this->call(ProductTypeSeeder::class);
//         $this->call(SysUserStatusTableSeeder::class);
         $this->call(LevelTableSeeder::class);
         $this->call(SysBusinessSeeder::class);
         $this->call(SysTransactionsTypeSeeder::class);
         $this->call(SysTransactionsStatusSeeder::class);
    }
}
