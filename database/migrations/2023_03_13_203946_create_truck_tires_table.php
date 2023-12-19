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
        Schema::create('truck_tires', function (Blueprint $table) {
            $table->uuid('truck_tire_id')->primary();
            $table->foreignUuid('truck_id')->constrained('trucks', 'truck_id');
            $table->date('buy_date');
            $table->decimal('buy_price', 20, 6);
            $table->char('serial_number', 8);
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
        Schema::dropIfExists('truck_tires');
    }
};
