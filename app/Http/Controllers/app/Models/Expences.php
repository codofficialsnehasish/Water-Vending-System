<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expences extends Model
{
    use HasFactory;
    protected $table = "expences";
    protected $primaryKey = "id";
}
