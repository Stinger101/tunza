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
      DB::table('roles')->insert([
          'id'=>1,
          'name' => "parent",
          'description' => "parent/admin role"
      ]);
      DB::table('roles')->insert([
          'id'=>2,
          'name' => "caregiver",
          'description' => "caregiver role"
      ]);
      DB::table('roles')->insert([
          'id'=>3,
          'name' => "both parent and caregiver",
          'description' => "pboth parent and caregiver role"
      ]);
        
    }
}
