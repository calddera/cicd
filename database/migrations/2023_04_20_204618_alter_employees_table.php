<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropIndex('employees_nss_deleted_at_unique');
            $table->dropIndex('employees_rfc_deleted_at_unique');
            $table->dropIndex('employees_curp_deleted_at_unique');
            $table->unique('NSS');
            $table->unique('RFC');
            $table->unique('CURP');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
