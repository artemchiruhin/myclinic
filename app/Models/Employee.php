<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name',
        'patronymic', 'email', 'phone',
        'service_category_id', 'image', 'started_at'];
    protected $dates = ['started_at'];
    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = upper_first(mb_strtolower($value));
    }
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = upper_first(mb_strtolower($value));
    }
    public function setPatronymicAttribute($value)
    {
        $this->attributes['patronymic'] = upper_first(mb_strtolower($value));
    }
}
