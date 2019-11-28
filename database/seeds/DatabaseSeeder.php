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
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminAccountSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(RegionTableSeeder::class);
        $this->call(ClassificationTableSeeder::class);
        // $this->call(CompanyTableSeeder::class);
    }
}
