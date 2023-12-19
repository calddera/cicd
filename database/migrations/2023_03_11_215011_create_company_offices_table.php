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
        Schema::create('company_offices', function (Blueprint $table) {
            $table->id('company_office_id');
            $table->foreignId('company_id')->constrained('companies', 'company_id');
            $table->string('office_name', 255);
            $table->string('office_address', 255);
            $table->char('office_country', 3);
            $table->string('office_state', 255)->nullable();
            $table->string('office_city', 255)->nullable();
            $table->string('office_zip_code', 6);
            $table->float('office_lat')->nullable();
            $table->float('office_lng')->nullable();
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
        Schema::dropIfExists('company_offices');
    }
};
