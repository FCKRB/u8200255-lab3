<?php

namespace App\Http\Controllers;

use App\Actions\CreateBodykitShopAction;
use App\Http\Requests\CreateBodykitShopRequest;
use App\Http\Requests\UpdateGuitarShopRequest;
use App\Http\Resources\BodykitShopResource;
use App\Models\BodykitShop;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BodykitShopController extends Controller
{

    public function create(CreateBodykitShopRequest $request, CreateBodykitShopAction $action)
    {
        return new BodykitShopResource($action->execute($request->validated()));
    }
    public function getAll()
    {
        return BodykitShopResource::collection(BodykitShop::all());
    }

    public function get(int $shopId)
    {
        try {
            return new BodykitShopResource(BodykitShop::query()->findOrFail($shopId));
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404,"message" => "Bodykit shop not found"], 404);
        }
    }

    public function update(int $shelterId, UpdateBodykitShopRequest $request, UpdateAnimalShelterAction $action)
    {
        try {
            return new BodykitShopResource($action->execute($shelterId, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Bodykit shop not found"], 404);
        }
    }
}
