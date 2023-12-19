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
        Schema::create('customer_location_contacts', function (Blueprint $table) {
            $table->id('customer_location_contact_id');
            $table->unsignedBigInteger('customer_location_id');
            $table->string('contact_name', 255)->unique();
            $table->string('contact_email', 255);
            $table->string('contact_phone_number', 13);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_location_id')
                ->references('customer_location_id')
                ->on('customer_locations');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_location_contacts');
    }
};
