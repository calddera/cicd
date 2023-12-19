<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TrailerSeeder extends Seeder
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


        /**
         * Seeding Vehicle Statuses
         */
        $vehicleStatusNames = [
            'New acquisition',
            'Repairing',
            'In use',
            'Lost',
            'Broken'
        ];

        foreach ($vehicleStatusNames as $vehicleStatusName) {
            $vehicleStatuses [] = [
                'status_name' => $vehicleStatusName,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        } 

        DB::table('vehicle_statuses')->insert($vehicleStatuses);

        /**
         * Seeding Trailer Types
         */
        $trailerTypeNames = [
            'Trailer Type 1',
            'Trailer Type 2',
            'Trailer Type 3',
            'Trailer Type 4',
            'Trailer Type 5'
        ];

        foreach ($trailerTypeNames as $trailerTypeName) {
            $trailerTypes [] = [
                'trailer_type_name' => $trailerTypeName,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        } 

        DB::table('trailer_types')->insert($trailerTypes);

        /**
         * Seeding Trailer Models
         */
        $trailerModelNames = [
            'Mercedes',
            'Kenworth',
            'Kinsmart',
            'Volvo',
            'Revell'
        ];

        foreach ($trailerModelNames as $trailerModelName) {
            $trailerModels [] = [
                'trailer_model_name' => $trailerModelName,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('trailer_models')->insert($trailerModels);

        // Getting keys all model keys
        $userKeys = \App\Models\User::all()->modelKeys();
        $vehicleStatusesKeys = \App\Models\VehicleStatus::all()->modelKeys();
        $trailerModelsKeys = \App\Models\TrailerModel::all()->modelKeys();
        $trailerTypesKeys = \App\Models\TrailerType::all()->modelKeys();

        /**
         * Seeding Trailers
         */
       

        for ($i = 0; $i < 30; $i++) {
            $trailers [] = [
                'trailer_id' => fake()->unique()->uuid(),
                'unit_number' => fake()->unique()->lexify('?????'),
                'vin_number' => fake()->unique()->lexify('?????????????????'),
                'vehicle_status_id' => fake()->randomElement($vehicleStatusesKeys),
                'trailer_type_id' => fake()->randomElement($trailerTypesKeys),
                'is_active' => fake()->numberBetween(0, 1),
                'trailer_model_id' => fake()->randomElement($trailerModelsKeys),
                'trademark' => fake()->company,
                'IMAI' => fake()->lexify('?????'),
                'created_by' => fake()->randomElement($userKeys),
                'updated_by' => fake()->randomElement($userKeys),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('trailers')->insert($trailers);

        // Getting all trailer keys
        $trailerKeys = \App\Models\Trailer::all()->modelKeys();

        /**
         * Seeding Trailer Tires
         */
        for ($i = 0; $i < 200; $i++) {
            $trailerTires [] = [
                'trailer_tire_id' => fake()->unique()->uuid(),
                'trailer_id' => fake()->randomElement($trailerKeys),
                'buy_date' => fake()->date(),
                'buy_price' => fake()->randomFloat(2),
                'serial_number' => fake()->text(20),
                'is_active' => fake()->numberBetween(0, 1),
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        DB::table('trailer_tires')->insert($trailerTires);

        /**
         * Seeding Trailer Plates
         */
        for ($i = 0; $i < 200; $i++) {
            $trailerPlates [] = [
                'trailer_plate_id' => fake()->unique()->uuid(),
                'trailer_id' => fake()->randomElement($trailerKeys),
                'plate_country' => fake()->lexify('???'),
                'plate_code' => fake()->unique()->lexify('??????'),
                'plate_expires_at' => fake()->date(),
                'plate_photo' => fake()->text(50),
                'is_active' => fake()->numberBetween(0, 1),
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }

        DB::table('trailer_plates')->insert($trailerPlates);

        /**
         * Seeding Trailer Documents
         */
        for ($i = 0; $i < 200; $i++) {
            $trailerDocuments [] = [
                'trailer_document_id' => fake()->unique()->uuid(),
                'trailer_id' => fake()->randomElement($trailerKeys),
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

        DB::table('trailer_documents')->insert($trailerDocuments);
    }
}
