<?php

namespace App\Actions;

use App\Models\Bodykit;
use App\Models\BodykitShop;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateBodykitAction
{
    public function execute(int $bodykitId, array $fields) : Bodykit
    {
        $bodykit = Bodykit::findOrFail($bodykitId);
        if (array_key_exists('bodykit_shop_id', $fields)) {
            if ($fields['bodykit_shop_id'] != $bodykit->bodykit_shop->id) {
                $shop = BodykitShop::find($fields['bodykit_shop_id']);
                if ($shop->bodykits->count() + 1 > $shop->bodykit_capacity)
                    throw new HttpResponseException(response()->json(["code" => 400, "message" => "Bodykit shop is full"], 400));
            }
        }


        $bodykit->update($fields);
        return Bodykit::findOrFail($bodykitId);
    }
}
