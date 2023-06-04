<?php

namespace App\Actions;

use App\Models\BodykitShop;
use App\Models\Bodykit;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateBodykitAction
{
    public function execute(array $fields) : Bodykit
    {
        $bodykitShopId = $fields["bodykit_shop_id"];
        $shop = BodykitShop::find($bodykitShopId);
        if ($shop->bodykits->count() + 1 <= $shop->bodykit_capacity)
        {
            $bodykit = new Bodykit($fields);
            $bodykit->save();
            return $bodykit;
        } else {
            throw new HttpResponseException(response()->json(["code" => 400, "message" => "Bodykit shop is full"], 400));
        }
    }
}
