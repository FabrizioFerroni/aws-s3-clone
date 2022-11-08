<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Buckets extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'buckets';
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'nombre',
        'region',
        'accceso',
        'url',
        'slug',
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y ',
    ];
}
