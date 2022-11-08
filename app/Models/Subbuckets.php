<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;


class Subbuckets extends Model
{
    use HasApiTokens, HasFactory;
    protected $table = 'subbuckets';
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'name',
        'tipe',
        'size',
        'class',
        'isFolder',
        'user_id',
        'bucket_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y ',
    ];
}
