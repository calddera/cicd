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
        Schema::create('trucks', function (Blueprint $table) {
            $table->uuid('truck_id')->primary();
            $table->char('unit_number', 5)->unique();
            $table->char('vin_number', 16)->unique();
            $table->double('odometer');
            $table->timestamp('odometer_last_updated_at')->nullable();
            $table->integer('fuel_percent');
            $table->timestamp('fuel_last_updated_at')->nullable();
            $table->foreignId('vehicle_status_id')->constrained('vehicle_statuses', 'vehicle_status_id');
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users', 'user_id');
            $table->foreignUuid('updated_by')->nullable()->constrained('users', 'user_id');
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
        Schema::dropIfExists('trucks');
    }
};
