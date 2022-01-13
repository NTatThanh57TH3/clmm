<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToLichSuAttendanceDate extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumns('lich_su_attendance_date', ['sdt_get', 'magiaodich'])) {
            Schema::table('lich_su_attendance_date', function(Blueprint $table) {
                $table->string('sdt_get')->nullable();
                $table->string('magiaodich')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lich_su_attendance_date', function(Blueprint $table) {
            //
        });
    }

}
