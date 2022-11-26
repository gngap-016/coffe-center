<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'service_time',
        'address',
        'description',
        'logo',
        'keywords',
        'instagram',
        'facebook',
        'email',
        'whatsapp',
        'phone',
    ];
}
