<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function facilities()
    {
        return $this->hasMany(PackageFacility::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
