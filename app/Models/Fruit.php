<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    use HasFactory;

    protected $primaryKey = "fruit_id";

    protected $fillable = [
        'date',
        'product_type',
        'quality_choice',
        'total_fruits',
        'remaining_fruits',
        'type',
        'weight'
    ];
}
