<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LicenseValidatorController extends Controller
{
    public function getLicense(Request $request)
    {
        $apiUrl = 'https://cedulaprofesional.sep.gob.mx/cedula/buscaCedulaJson.action';

        $json = json_encode([
            'maxResult' => '1000',
            'nombre' => $request->input('name'),
            'paterno' => $request->input('paternal_surname'),
            'materno' => $request->input('maternal_surname'),
            'idCedula' => $request->input('license')
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8'
        ])->get($apiUrl, ['json' => $json]);

        $data = [
            'body' => json_decode(mb_convert_encoding($response->body(), 'UTF-8', 'ISO-8859-1'), true),
            'headers' => $response->headers(),
            'status' => $response->status(),
        ];

        if (isset($data['body']['items']) && count($data['body']['items']) > 0) {
            $item = $data['body']['items'][0];

            dd($data['body']);
            if ($this->isValid($request, $item)) {
                return view('teacher.register')->with([
                    'name' => $item['nombre'],
                    'paternal_surname' => $item['paterno'],
                    'maternal_surname' => $item['materno'],
                    'license' => $request['license']
                ]);
            }
        }
        //this is correct
        // return view('auth.licenseValidator')->with([
        //     'error' => 'Los datos proporcionados no son válidos.'
        // ]);

        return view('teacher.register')->with([
            'error' => 'Los datos proporcionados no son válidos.'
        ]);
    }

    private function isValid($request, $item)
    {
        return $item['nombre'] == $request->input('name') &&
            $item['paterno'] == $request->input('paternal_surname') &&
            $item['materno'] == $request->input('maternal_surname');
    }
}
