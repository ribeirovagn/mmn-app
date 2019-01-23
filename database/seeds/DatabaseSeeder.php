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
         $this->call(SysUserStatusTableSeeder::class);
         $this->call(UserSeed::class);
         $this->call(BonusSeed::class);
         $this->call(ProductTypeSeeder::class);
         $this->call(LevelTableSeeder::class);
         $this->call(SysBusinessSeeder::class);
         $this->call(SysTransactionsTypeSeeder::class);
         $this->call(SysTransactionsStatusSeeder::class);
         $this->call(SysOrderStatusTable::class);
         $this->call(SysPaymentTypeTable::class);
         $this->call(SysBinaryTypeTable::class);
         $this->call(SysTransactionOperationTypeTable::class);
         $this->call(SysGenealogyTypeTable::class);
         $this->call(SysWithdrawTypeTable::class);
    }
}
