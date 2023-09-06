<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'slug',
      'strip_plan',
      'price',
      'description',
      'duration'
    ];
    public  function getRouteKeyName()
    {
            return 'slug';
    }
}
