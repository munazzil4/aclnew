<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeFieldToEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->text('nic')->after('detail');
            $table->text('basic')->after('nic');
            $table->text('allowance')->after('basic');
            $table->text('gross')->after('allowance');
            $table->text('epf')->after('gross');
            $table->text('net')->after('epf');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['nic','basic','allowance','gross','epf','net']);
        });
    }
}
