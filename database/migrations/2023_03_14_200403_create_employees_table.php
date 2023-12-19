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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('employee_id')->primary();
            $table->string('first_name', 255);
            $table->string('first_surname', 255);
            $table->string('second_surname', 255);
            $table->char('gender', 1);
            $table->char('NSS', 11);
            $table->char('RFC', 13);
            $table->char('CURP', 18);
            $table->foreignId('contract_type_id')->constrained('contract_types', 'contract_type_id');
            $table->foreignId('salary_type_id')->constrained('salary_types', 'salary_type_id');
            $table->foreignId('workday_type_id')->constrained('workday_types', 'workday_type_id');
            $table->decimal('SDI',$precision=20,$scale=6);
            $table->date('hire_date');
            $table->date('birth_date');
            $table->foreignId('job_id')->constrained('jobs', 'job_id');
            $table->char('UMF', 5);
            $table->string('nationality', 50);
            $table->char('birth_country', 5);
            $table->char('birth_state_code', 5);
            $table->string('birth_city', 50);
            $table->char('address_country', 5);
            $table->char('address_state_code', 5);
            $table->string('address_city', 50);
            $table->char('address_zipcode', 6);
            $table->string('address_description', 255);
            $table->float('address_lat')->nullable();
            $table->float('address_lng')->nullable();
            $table->string('marital_status', 50);
            $table->foreignId('employee_status_id')->constrained('employee_statuses', 'employee_status_id');
            $table->string('email', 50);
            $table->string('last_update_by', 36)->nullable();
            $table->foreignId('elo_team_id')->nullable()->constrained('elo_teams', 'elo_team_id');
            $table->foreignId('cost_center_id')->nullable()->constrained('cost_centers', 'cost_center_id');
            $table->string('image', 255);
            $table->string('phone_number', 14);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['CURP','deleted_at']);
            $table->unique(['RFC','deleted_at']);
            $table->unique(['NSS','deleted_at']);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
