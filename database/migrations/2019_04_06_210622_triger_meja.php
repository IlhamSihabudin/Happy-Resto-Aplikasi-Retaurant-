<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TrigerMeja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER triger_meja AFTER INSERT ON orders FOR EACH ROW
                BEGIN
                   UPDATE mejas SET status_meja = \'1\' WHERE id_meja = new.id_meja;
                END;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `user_default_role`');
    }
}
