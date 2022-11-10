<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'first_name', 'last_name', 'status', 'squad', 'start_date', 'notes'];
    
}
