<?php

namespace App\Actions;

use App\Models\Bodykit;

class DeleteBodykitAction
{
    public function execute(int $bodykitId)
    {
        $bodykit = Bodykit::query()->findOrFail($bodykitId);
        $bodykit->delete();
    }
}
