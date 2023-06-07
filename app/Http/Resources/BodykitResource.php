<?php

namespace App\Http\Resources;

use App\Models\BodykitShop;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BodykitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'version' => $this->version,
            'name' => $this->name,
            'manufacture_year' => $this->manufacture_year,
            'bodykit_shop_id' => $this->bodykit_shop->id,
        ];
    }
}
