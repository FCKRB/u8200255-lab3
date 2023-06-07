<?php

namespace App\Http\Controllers;

use App\Actions\CreateBodykitAction;
use App\Actions\UpdateBodykitAction;
use App\Http\Requests\CreateBodykitRequest;
use App\Http\Requests\UpdateBodykitRequest;
use App\Http\Resources\BodykitResource;
use App\Models\Bodykit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Actions\DeleteBodykitAction;
use App\Actions\ReplaceBodykitAction;
use App\Http\Requests\ReplaceBodykitRequest;

class BodykitController extends Controller
{
    public function getAll()
    {
        return BodykitResource::collection(Bodykit::all());
    }

    public function get(int $bodykitId)
    {
        try {
            return new BodykitResource(Bodykit::query()->findOrFail($bodykitId));
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404,"message" => "Bodykit not found"], 404);
        }
    }

    public function create(CreateBodykitRequest $request, CreateBodykitAction $action)
    {
        return new BodykitResource($action->execute($request->validated()));
    }

    public function replace(int $bodykitId, ReplaceBodykitRequest $request, ReplaceBodykitAction $action)
    {
        try {
            return new BodykitResource($action->execute($bodykitId, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Bodykit not found"], 404);
        }
    }

    public function update(int $bodykitId, UpdateBodykitRequest $request, UpdateBodykitAction $action)
    {
        try {
            return new BodykitResource($action->execute($bodykitId, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Bodykit not found"], 404);
        }
    }

    public function delete(int $bodykitId, DeleteBodykitAction $action)
    {
        try {
            $action->execute($bodykitId);
            return response()->json(["code" => 200,"message" => "Bodykit deleted"]);
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Bodykit not found"], 404);
        }
    }
}
