<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['service_id',
        'user_id', 'employee_id', 'date',
        'time', 'full_name', 'email', 'phone'];
    protected $dates = ['date'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
