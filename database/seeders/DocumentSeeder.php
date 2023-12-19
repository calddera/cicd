<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = now();

        /**
         * Seeding Document Types
         */
        $documentTypeNames = [
            'Embarques',
            'Enfermería',
            'Empleados',
            'Cajas',
            'Camiones'
        ];
        
        foreach ($documentTypeNames as $documentTypeName) {
            $documentTypes [] = [
                'document_type_name' => $documentTypeName,
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ];
        }
        
        DB::table('document_types')->insert($documentTypes);

        /**
         * Seeding Documents
         */
        $embarquesDocuments = [
            'Bill of Lading (BOL)',
            'Documento de Operación para Despacho Aduanero (DODA)',
            'Pedimento de Importacion Temporal',
            'Control de Salidas',
            'Entry',
            'Carta Porte',
            'Manifiesto Electrónico'
        ];

        $enfermeriaDocuments = [
            'Control de Salidas Enfermería'
        ];

        $empleadosDocuments = [
            'Acta de nacimiento',
            'Identificación',
            'Comprobante de Domicilio',
            'Numero de Seguro Social (NSS)',
            'CURP',
            'RFC',
            'Constancia de retención Infonavit',
            'Comprobante de Estudios',
            'Cartas de trabajo',
            'Carta Médica',
            'Visa',
            'Pasaporte',
            'Licencia',
            'Apto',
            'Diploma SCT',
            'Constancia de Vacunación'
        ];

        $cajasDocuments = [
            'Inspección Mecánica',
            'Registración'
        ];

        $camionesDocuments = [
            'Seguro Americano',
            'Cab Card',
            'Título',
            'Inspección Anual',
            'Permiso NMFTA/SCAC',
            'US DOT MC',
            'UCR',
            'Paid Transponder',
            'IFTA',
            'Seguro Mexicano',
            'Tarjeta de Circulación',
            'Permiso SCT',
            'Verificación de Humo',
            'Verificación Físico Mecánica',
            'Manual Tableta'
        ];

        foreach ($embarquesDocuments as $embarqueDocument) {
            $documents [] = [
                'document_name' => $embarqueDocument,
                'document_type_id' => 1,
                'is_mandatory' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        foreach ($enfermeriaDocuments as $enfermeriaDocument) {
            $documents [] = [
                'document_name' => $enfermeriaDocument,
                'document_type_id' => 2,
                'is_mandatory' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        foreach ($empleadosDocuments as $empleadoDocument) {
            $documents [] = [
                'document_name' => $empleadoDocument,
                'document_type_id' => 3,
                'is_mandatory' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        foreach ($cajasDocuments as $cajaDocument) {
            $documents [] = [
                'document_name' => $cajaDocument,
                'document_type_id' => 4,
                'is_mandatory' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        foreach ($camionesDocuments as $camionesDocument) {
            $documents [] = [
                'document_name' => $camionesDocument,
                'document_type_id' => 5,
                'is_mandatory' => true,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
            ];
        }

        DB::table('documents')->insert($documents);
    }
}
