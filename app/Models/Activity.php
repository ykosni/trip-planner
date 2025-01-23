<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'plan_id',
        'date',
        'order_number',
        'content',
        'time',
        'place'
    ];
    
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    
}
