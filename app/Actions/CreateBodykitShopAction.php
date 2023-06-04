<?php

namespace App\Actions;

use App\Models\BodykitShop;

class CreateBodykitShopAction
{
    public function execute(array $fields) : BodykitShop
    {
        $shop = new BodykitShop($fields);
        $shop->save();
        return $shop;
    }
}
