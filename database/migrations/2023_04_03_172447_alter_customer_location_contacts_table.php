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
        Schema::table('customer_location_contacts', function(Blueprint $table) {
            $table->dropUnique('customer_location_contacts_contact_name_unique');
            $table->string('contact_email', 255)->nullable()->change();
            $table->string('contact_phone_number', 13)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_location_contacts', function(Blueprint $table) {
            $table->string('contact_email', 255)->nullable(false)->change();
            $table->string('contact_phone_number', 13)->nullable(false)->change();
            $table->unique('contact_name');
        });
    }
};
