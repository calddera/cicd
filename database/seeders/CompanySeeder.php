<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\Company;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\CompanyOffice;
use App\Models\CompanyParking;
use Illuminate\Database\Seeder;
use App\Models\CompanyOfficeContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seeding Companies
         */
        Company::factory(30)->create();

        /**
         * Seeding Company Parkings
         */
        CompanyParking::factory(30)->create();

        /**
         * Seeding Company Offices
         */
        CompanyOffice::factory(30)->create();

        /**
         * Seeding Company Office Contacts
         */
        CompanyOfficeContact::factory(30)->create();

        /**
         * Seeding Company Parkings
         */
        Department::factory(30)->create();

        /**
         * Seeding Company Parkings
         */
        Job::factory(30)->create();

        /**
         * Seeding Company Parkings
         */
        CostCenter::factory(30)->create();
    }
}
