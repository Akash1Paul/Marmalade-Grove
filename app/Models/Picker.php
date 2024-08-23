<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Picker extends Model
{
    use HasFactory;
    
    protected $table = "pickers";
    
    protected $primaryKey = "id";

    protected $fillable = [
        'fruit_id',
        'product_type',
        'types',
        'units',
        'weight',
        'fruit_yet_to_sorted',
        'sorted',
        'date'
    ];

}
