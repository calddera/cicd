<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Getting keys and time data
        $timestamp = Carbon::now();
        $documentKeys = \App\Models\Document::all()->modelKeys();
        $userKeys = \App\Models\User::all()->modelKeys();
        $vehicleStatusesKeys = \App\Models\VehicleStatus::all()->modelKeys();


        /**
         * Seeding Trucks
         */
        for ($i = 0; $i < 30; $i++) {
            $trucks [] = [
                'truck_id' => fake()->unique()->uuid(),
                'unit_number' => fake()->unique()->lexify('?????'),
                'vin_number' => fake()->unique()->lexify('?????????????????'),
                'vehicle_status_id' => fake()->randomElement($vehicleStatusesKeys),
                'is_active' => fake()->numberBetween(0, 1),
                'odometer' => fake()->randomFloat(2),
                'odometer_last_updated_at' => fake()->date(),
                'fuel_percent' => fake()->numberBetween(0, 100),
                'fuel_last_updated_at' => fake()->date(),
                'created_by' => fake()->randomElement($userKeys),
                'updated_by' => fake()->randomElement($userKeys),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('trucks')->insert($trucks);

        // Getting Truck Keys
        $truckKeys = \App\Models\Truck::all()->modelKeys();

        /**
         * Seeding Truck Tags
         */
        for ($i = 0; $i < 200; $i++) {
            $truckTags [] = [
                'truck_id' => fake()->randomElement($truckKeys),
                'tag_name' => fake()->lexify('?????'),
                'valid_until' => fake()->date(),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('truck_tags')->insert($truckTags);

        /**
         * Seeding Truck Tires
         */
        for ($i = 0; $i < 200; $i++) {
            $truckTires [] = [
                'truck_tire_id' => fake()->unique()->uuid(),
                'truck_id' => fake()->randomElement($truckKeys),
                'buy_date' => fake()->date(),
                'buy_price' => fake()->randomFloat(2),
                'serial_number' => fake()->text(8),
                'is_active' => fake()->numberBetween(0, 1),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('truck_tires')->insert($truckTires);

        /**
         * Seeding Truck Plates
         */
        for ($i = 0; $i < 200; $i++) {
            $truckPlates [] = [
                'truck_plate_id' => fake()->unique()->uuid(),
                'truck_id' => fake()->randomElement($truckKeys),
                'plate_country' => fake()->lexify('???'),
                'plate_code' => fake()->unique()->lexify('??????'),
                'plate_expires_at' => fake()->date(),
                'plate_photo' => fake()->text(50),
                'is_active' => fake()->numberBetween(0, 1),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('truck_plates')->insert($truckPlates);

        /**
         * Seeding Truck Documents
         */
        for ($i = 0; $i < 200; $i++) {
            $truckDocuments [] = [
                'truck_document_id' => fake()->unique()->uuid(),
                'truck_id' => fake()->randomElement($truckKeys),
                'document_id' => fake()->randomElement($documentKeys),
                'file_name' => fake()->text(20),
                'file_path' => fake()->text(20),
                'valid_until' => fake()->date(),
                'is_active' => fake()->numberBetween(0, 1),
                'created_by' => fake()->randomElement($userKeys),
                'updated_by' => fake()->randomElement($userKeys),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('truck_documents')->insert($truckDocuments);
    }
}
