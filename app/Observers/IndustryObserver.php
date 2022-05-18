<?php

namespace App\Observers;

use App\Industry;
use App\Traits\ServerResponse;
use Illuminate\Support\Facades\Validator;

class IndustryObserver
{
    use ServerResponse;
    public function creating(Industry $industry)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|unique:industries|max:255'
        ]);

        if ($validator->fails()) {
            return $this->failure(422,$validator->errors(),null);
        }
    }
}
