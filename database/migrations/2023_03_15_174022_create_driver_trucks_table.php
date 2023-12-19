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
        Schema::create('driver_truck', function (Blueprint $table) {
            $table->uuid('driver_truck_id')->primary();
            $table->foreignUuid('employee_id')->constrained('employees', 'employee_id');
            $table->foreignUuid('truck_id')->constrained('trucks', 'truck_id');
            $table->boolean('is_active');
            $table->foreignUuid('assigned_by')->constrained('users', 'user_id');
            $table->date('assigned_at');
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
        Schema::dropIfExists('driver_truck');
    }
};
