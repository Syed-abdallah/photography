<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_number',
        'email',
        'services',
        'no_of_guest',
        'promotions',
        'sales_agents',
        'booking_agent',
        'deposit_amount',
        'sales_amount',
        'start',
         'end',
        'status'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class , 'services');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class , 'promotions_id');
    }

    public function salesAgent()
    {
        return $this->belongsTo(SalesAgent::class, 'sales_agent_id');
    }
    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}