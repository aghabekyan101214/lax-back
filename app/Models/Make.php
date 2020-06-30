<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Make extends Model
{
    public function models()
    {
        return $this->hasMany(CarModel::class, "Make_ID", "Make_ID");
    }
}
