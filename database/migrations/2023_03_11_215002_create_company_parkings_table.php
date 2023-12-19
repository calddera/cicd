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
        Schema::create('company_parkings', function (Blueprint $table) {
            $table->id('company_parking_id');
            $table->foreignId('company_id')->constrained('companies', 'company_id');
            $table->string('parking_name', 255);
            $table->string('parking_address', 255);
            $table->foreignId('geofence_id')->nullable()->constrained('geofences', 'geofence_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_parkings');
    }
};
