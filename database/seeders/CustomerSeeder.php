<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Geofence;
use App\Models\LocationType;
use App\Models\CustomerStatus;
use Illuminate\Database\Seeder;
use App\Models\CustomerLocation;
use App\Models\CustomerLocationContact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Seeding Customer Statuses
         */
        $customerStatuses = [
            'Credit Enabled',
            'No Credit'
        ];

        foreach ($customerStatuses as $customerStatus) {
            CustomerStatus::create([
                'customer_status_name' => $customerStatus
            ]);
        }

        /**
         * Seeding Location Types
         */
        $locationTypes = [
            'Office',
            'Warehouse',
            'Factory',
            'Other'
        ];

        foreach ($locationTypes as $locationType) {
            LocationType::create([
                'location_type_name' => $locationType
            ]);
        }

        /**
         * Seeding Geofences
         */
        $geofences = [
            'GF1',
            'GF2',
            'GF3',
            'GF4',
            'GF5'
        ];

        foreach ($geofences as $geofence) {
            Geofence::create([
                'geofence_name' => $geofence,
                'is_active' => true
            ]);
        }

        /**
         * Seeding Customers
         */
        Customer::factory(30)->create();

        /**
         * Seeding Customer Locations
         */
        CustomerLocation::factory(50)->create();

        /**
         * Seeding Customer Location Contacts
         */
        CustomerLocationContact::factory(50)->create();
    }
}
