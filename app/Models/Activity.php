<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'plan_id',
        'datetime',
        'content',
        'place'
    ];
    
    protected $dates = ['datetime'];


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
}
