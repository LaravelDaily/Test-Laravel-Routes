<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlabsRequest;
use App\Models\Slab;
use Illuminate\Http\JsonResponse;

class SlabsController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Slab::all();
    }

    public function store(SlabsRequest $request): void{
        $data = $request->all();

        // Calculate square meters
        $data['square_meters'] = (($data['width'] / 1000) * ($data['length'] / 1000)) * $data['quantity'];

        // Save the record
        Slab::create($data);

    }

    public function show(Slab $slabs): Slab
    {
        return $slabs;
    }

    public function update(SlabsRequest $request, Slab $slabs): Slab
    {
        $slabs->update($request->validated());

        return $slabs;
    }

    public function destroy(Slab $slabs): JsonResponse
    {
        $slabs->delete();

        return response()->json();
    }
}
