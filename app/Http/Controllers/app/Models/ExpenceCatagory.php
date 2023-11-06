<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenceCatagory extends Model
{
    use HasFactory;
    protected $table = "expence_catagory";
    protected $primaryKey = "id";
}
