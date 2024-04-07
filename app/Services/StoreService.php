<?php

namespace App\Services;

use App\Http\Requests\StoreUpdateRequest;
use App\Models\Store;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StoreService
{
    public function updateStore(StoreUpdateRequest $request, int $id)
    {
        try {
            $store = Store::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'There is no Store on our records with id ' . $id], 400);
        }
        $store->update($request->validated());
        return $store->refresh();
    }
}
