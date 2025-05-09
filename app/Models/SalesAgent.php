<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesAgent extends Model
{
    use HasFactory;
    protected $table = 'sales_agents';

    protected $fillable = ['name', 'contact_number', 'email'];
}