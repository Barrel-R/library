<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCreationRequest;
use App\Http\Requests\StoreUpdateRequest;
use App\Models\Store;
use App\Services\StoreService;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::all(); // if dataset gets large, paginate(50)
        return response()->json($stores);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(Store::find($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreationRequest $request)
    {
        $store = Store::create($request->validated());
        return response()->json($store, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUpdateRequest $request, string $id, StoreService $service)
    {
        $store = $service->updateStore($request, $id);
        return response()->json($store);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Store::where('id', $id)->exists()) return response()->json(['error' => 'There is no Store with id ' . $id . ' in our records.'], 400);
        Store::destroy($id);
        return response()->json(['message' => 'Store deleted successfully.'], 200);
    }

    public function attachBooks(Request $request, int $id)
    {
        $store = Store::find($id);
        $request->validate(['books.*' => 'exists:books,id']);
        $store->books()->attach($request->id);
        return response()->json($store);
    }
}
