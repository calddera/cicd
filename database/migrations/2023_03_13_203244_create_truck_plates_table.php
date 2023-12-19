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
        Schema::create('truck_plates', function (Blueprint $table) {
            $table->uuid('truck_plate_id')->primary();
            $table->foreignUuid('truck_id')->constrained('trucks', 'truck_id');
            $table->char('plate_country', 3);
            $table->char('plate_code', 8)->unique();
            $table->date('plate_expires_at')->nullable();
            $table->string('plate_photo', 255)->nullable();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('truck_plates');
    }
};
