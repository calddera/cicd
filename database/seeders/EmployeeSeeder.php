<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        /**
         * Seeding Contract Types
         */
        $contractTypeNames = [
            'Permanente',
            'Eventual',
            'Construcción',
            'Eventuales del campo'
        ];

        foreach ($contractTypeNames as $contractTypeName) {
            $contractTypes [] = [
                'contract_type_name' => $contractTypeName,
                'is_active' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('contract_types')->insert($contractTypes);

        /**
         * Seeding Salary Types
         */
        $salaryTypeNames = [
            'Fijo',
            'Variable',
            'Mixto',
        ];

        foreach ($salaryTypeNames as $salaryTypeName) {
            $salaryTypes [] = [
                'salary_type_name' => $salaryTypeName,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('salary_types')->insert($salaryTypes);

        /**
         * Seeding Workday Types
         */
        $workdayTypeNames = [
            'Completa',
            '1 Dia',
            '2 Dias',
            '3 Dias',
            '4 Dias',
            '5 Dias',
            'Menos de 8 Horas',
        ];

        foreach($workdayTypeNames as $workdayType) {
            $workdayTypes [] = [
                'workday_type_name' => $workdayType,
                'workday_description_name' => 'Descripción ' . $workdayType,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('workday_types')->insert($workdayTypes);

        /**
         * Seeding Employee Statuses
         */
        $employeeStatusNames = [
            'Nuevo ingreso',
            'En vacaciones',
            'Activo',
            'Enfermo'
        ];

        foreach($employeeStatusNames as $employeeStatusName) {
            $employeeStatuses [] = [
                'employee_status_name' => $employeeStatusName,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('employee_statuses')->insert($employeeStatuses);

        /**
         * Seeding Elo Teams
         */
        for ($i = 0; $i < 10; $i++) {
            $eloTeams [] = [
                'elo_team_name' => 'Team ' . fake()->unique()->lexify('?????'),
                'is_active' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('elo_teams')->insert($eloTeams);

        /**
         * Seeding Companies
         */
        for ($i = 0; $i < 10; $i++) {
            $companies [] = [
                'company_name' => fake()->unique()->company(),
                'employer_register' => fake()->lexify('?????'),
                'RFC' => 'RFC' . fake()->unique()->lexify('??????????'),
                'employer_representative' => fake()->name(),
                'legal_representative' => fake()->name(),
                'tax_residence' => fake()->address(),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('companies')->insert($companies);

        $companyKeys = \App\Models\Company::all()->modelKeys();

        /**
         * Seeding Cost Centers
         */
        for ($i = 0; $i < 10; $i++) {
            $costCenters [] = [
                'cost_center_code' => 'Code' . fake()->unique()->lexify('???'),
                'company_id' => fake()->randomElement($companyKeys),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('cost_centers')->insert($costCenters);

        /**
         * Seeding departments
         */
        for ($i = 0; $i < 10; $i++) {
            $departments [] = [
                'company_id' => fake()->randomElement($companyKeys),
                'department_name' => fake()->companySuffix(),
                'is_active' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];    
        }

        DB::table('departments')->insert($departments);

        $departmentKeys = \App\Models\Department::all()->modelKeys();

        /**
         * Seeding jobs
         */
        for ($i = 0; $i < 10; $i++) {
            $jobs [] = [
                'department_id' => fake()->randomElement($departmentKeys),
                'job_code' => 'Job ' . fake()->unique()->lexify('???'),
                'job_name' => fake()->unique()->jobTitle(),
                'is_active' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('jobs')->insert($jobs);

        /**
         * Seeding employees
         */
        $contractTypesKeys = \App\Models\ContractType::all()->modelKeys();
        $salaryTypesKeys = \App\Models\SalaryType::all()->modelKeys();
        $workdayTypesKeys = \App\Models\WorkdayType::all()->modelKeys();
        $employeeStatusesKeys = \App\Models\EmployeeStatus::all()->modelKeys();
        $eloTeamsKeys = \App\Models\EloTeam::all()->modelKeys();
        $costCentersKeys = \App\Models\CostCenter::all()->modelKeys();
        $jobKeys = \App\Models\Job::all()->modelKeys();


        for ($i = 0; $i < 20; $i++) {
            $employees [] = [
                'employee_id' => fake()->unique()->uuid(),
                'first_name' => fake()->firstName(),
                'first_surname' => fake()->lastName(),
                'second_surname' => fake()->lastName(),
                'gender' => fake()->randomElement(['f', 'm']),
                'NSS' => 'NSS' . fake()->lexify('????????'),
                'RFC' => 'RFC' . fake()->lexify('??????????'),
                'CURP' => 'CURP' . fake()->lexify('????????'),
                'contract_type_id' => fake()->randomElement($contractTypesKeys),
                'salary_type_id' => fake()->randomElement($salaryTypesKeys),
                'workday_type_id' => fake()->randomElement($workdayTypesKeys),
                'SDI' => fake()->randomFloat(2, 0, 10),
                'hire_date' => fake()->date(),
                'birth_date' => fake()->date(),
                'job_id' => fake()->randomElement($jobKeys),
                'UMF' => fake()->lexify('?????'),
                'nationality' => fake()->country(),
                'birth_country' => fake()->randomElement(['MEX', 'USA', 'CAN']),
                'birth_state_code' => fake()->randomElement(['OH', 'NL', 'CDMX']),
                'birth_city' => fake()->city(),
                'address_country' => fake()->randomElement(['MEX', 'USA', 'CAN']),
                'address_state_code' => fake()->randomElement(['OH', 'NL', 'CDMX']),
                'address_city' => fake()->city(),
                'address_zipcode' => fake()->randomNumber(6, true),
                'address_description' => fake()->text(10),
                'address_lat' => fake()->latitude(),
                'address_lng' => fake()->longitude(),
                'marital_status' => fake()->randomElement(['single', 'married', 'divorced']),
                'employee_status_id' => fake()->randomElement($employeeStatusesKeys),
                'email' => fake()->email(),
                'last_update_by' => 'admin',
                'elo_team_id' => fake()->randomElement($eloTeamsKeys),
                'cost_center_id' => fake()->randomElement($costCentersKeys),
                'image' => '',
                'phone_number' => fake()->randomNumber(7, true),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('employees')->insert($employees);
    }
}
