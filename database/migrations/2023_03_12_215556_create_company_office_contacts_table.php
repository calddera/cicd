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
        Schema::create('company_office_contacts', function (Blueprint $table) {
            $table->id('company_office_contact_id');
            $table->foreignId('company_office_id')->constrained('company_offices', 'company_office_id');
            $table->string('contact_name', 255);
            $table->string('contact_address', 255)->nullable();
            $table->string('contact_phone_number', 13)->nullable();
            $table->string('contact_email', 255)->nullable();
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
        Schema::dropIfExists('company_office_contacts');
    }
};
