<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    public $table = 'feedbacks';
    protected $fillable = ['service_id', 'name', 'message', 'rate'];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = upper_first(mb_strtolower($value));
    }
}
