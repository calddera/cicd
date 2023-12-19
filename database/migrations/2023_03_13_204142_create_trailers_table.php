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
        Schema::create('trailers', function (Blueprint $table) {
            $table->uuid('trailer_id')->primary();
            $table->char('unit_number', 5)->unique();
            $table->char('vin_number', 17)->unique();
            $table->foreignId('vehicle_status_id')->constrained('vehicle_statuses', 'vehicle_status_id');
            $table->foreignId('trailer_type_id')->constrained('trailer_types', 'trailer_type_id');
            $table->boolean('is_active')->default(true);
            $table->foreignId('trailer_model_id')->constrained('trailer_models', 'trailer_model_id');
            $table->string('trademark', 255)->nullable();
            $table->string('IMAI', 255)->nullable()->unique();
            $table->softDeletes();
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('trailers');
    }
};
