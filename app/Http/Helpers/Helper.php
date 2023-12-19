<?php

namespace App\Http\Helpers;

use App\Models\Country;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Helper
{


    public static function uploadBase64File($ruta ,$file)
    {
        $fileData = $file; // Obtener el archivo en base64 del objeto JSON enviado en la petición
        $fileParts = explode(';base64,', $fileData);
        $fileExtension = explode('/', $fileParts[0])[1];
        $fileContent = base64_decode($fileParts[1]);
        $fileName = uniqid() . '.' . $fileExtension; // Generar un nombre de archivo único
        Storage::disk('public')->put($ruta . '/' . $fileName, $fileContent); // Subir el archivo a la carpeta publica de Laravel
        return $ruta . '/' . $fileName;
    }
}
