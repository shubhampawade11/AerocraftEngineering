<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{

    protected $fillable = ['sequence','green_interval','yellow_interval'];
}
