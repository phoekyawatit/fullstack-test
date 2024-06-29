<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';
    protected $fillable = ['title', 'description','for_sale','for_rent','sold','price','property_type','bedrooms','bathrooms','area','area_type'];
}
