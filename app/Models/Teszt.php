<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teszt extends Model
{
    public $table = "teszts";

    public $primaryKey = "id";

    public $timestamps = true;

    public $fillable = [
// Teszt table data
    ];

    public static $rules = [
        // create rules
    ];

    // Teszt 
}
