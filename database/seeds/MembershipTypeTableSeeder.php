<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembershipTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('memberships_types')->insert([
            'name' => 'CG',
            'description' => 'Description of CG',
        ]);
        DB::table('memberships_types')->insert([
            'name' => 'Programming',
            'description' => 'Description of programming'
        ]);
        DB::table('memberships_types')->insert([
            'name' => 'Craft',
            'description' => 'Description of craft'
        ]);
    }
}
