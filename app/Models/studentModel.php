<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class studentModel extends Model
{
    use HasFactory;

    public function parentModel()
    {
        return $this->hasMany(parentModel::class);
    }

}

