<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class InsertAdminRecordIntoAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('admin')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$12$j0URgDG7Kd9UP3ZDtl4N7OL/6BszVjZ5RD72110D8pK5gmw/CJuk2', // Assuming this is a hashed password
            'created_at' => Carbon::parse('2024-05-30 11:41:15'),
            'updated_at' => Carbon::parse('2024-05-30 11:41:15'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('admin')->where('email', 'admin@gmail.com')->delete();
    }
}
