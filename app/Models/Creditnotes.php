<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Creditnotes extends Model
{
    use HasFactory;
    protected $table = "creditnotes";
    protected $primaryKey = "id";
}
