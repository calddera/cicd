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
        Schema::create('customer_locations', function (Blueprint $table) {
            $table->id('customer_location_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_location_name', 255)->unique();
            $table->unsignedBigInteger('location_type_id');
            $table->char('location_country', 3);
            $table->char('location_zipcode', 6);
            $table->string('location_state', 255)->nullable();
            $table->string('location_city', 255)->nullable();
            $table->string('location_address', 255)->nullable();
            $table->double('location_lat')->nullable();
            $table->double('location_lng')->nullable();
            $table->unsignedBigInteger('geofence_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('customer_id')
                ->on('customers');
            $table->foreign('location_type_id')
                ->references('location_type_id')
                ->on('location_types');
            $table->foreign('geofence_id')
                ->references('geofence_id')
                ->on('geofences');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_locations');
    }
};
