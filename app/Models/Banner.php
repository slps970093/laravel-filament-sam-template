<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';

    protected $fillable = [
        'app_language',
        'is_active',
        'file_path',
        'html_alt'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
