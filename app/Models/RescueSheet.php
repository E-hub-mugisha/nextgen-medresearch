<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RescueSheet extends Model
{
    protected $fillable = [
        'title','slug','file_path','language','qr_code_path','status'
    ];
}
