<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description',
        'price', 'image', 'service_category_id'];
    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class);
    }
}
