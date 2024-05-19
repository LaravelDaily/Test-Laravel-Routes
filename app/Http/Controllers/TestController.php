<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

//Controlador de teste para verificar se o Laravel tem permissão para criar arquivos no disco.
class TestController extends Controller
{
	public function testStorage(): JsonResponse
    {
        Storage::disk('public')->put('test.txt', 'Hello, World!');
        return response()->json(['message' => 'File created successfully']);
	}
}
