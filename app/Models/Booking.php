<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'name',
        'title',
        'address',
        'post_code',
        'contact_number',
        'email',
        'services',
        'no_of_guest',
        'promotions',
        'sales_agents',
        'booking_agent',
        'deposit_amount',
        'pay_on_day',
        'status',
        'payment_method',
        'booking_date',
        'start_time',
        'end_time',
    ];

  

    // Relationship to Service (assuming you have a Service model)
    public function service()
    {
        return $this->belongsTo(Service::class, 'services');
    }

    // Relationship to Promotion (assuming you have a Promotion model)
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotions');
    }

    // Relationship to Sales Agent (User model)
    public function salesAgent()
    {
        return $this->belongsTo(User::class, 'sales_agents');
    }

    // Relationship to Booking Agent (User model)
    public function bookingAgent()
    {
        return $this->belongsTo(User::class, 'booking_agent');
    }

    // Relationship to Payment Method (assuming a PaymentMethod model)
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method');
    }

    protected $casts = [
        // Keep booking_date as a Carbon instance
        'booking_date' => 'date:Y-m-d',
        // Remove these invalid 'time' casts:
        // 'start_time'  => 'time:H:i:s',
        // 'end_time'    => 'time:H:i:s',
    ];

    // Combine booking_date + start_time into ISO string
    public function getStartDateTimeAttribute()
    {
        if ($this->booking_date && $this->start_time) {
            return $this->booking_date->format('Y-m-d') . 'T' . $this->start_time;
        }
        return null;
    }

    // Combine booking_date + end_time into ISO string
    public function getEndDateTimeAttribute()
    {
        if ($this->booking_date && $this->end_time) {
            return $this->booking_date->format('Y-m-d') . 'T' . $this->end_time;
        }
        return null;
    }

    // Title shown on the calendar event
    public function getEventTitleAttribute()
    {
        return "{$this->name} - {$this->services}";
    }

}
