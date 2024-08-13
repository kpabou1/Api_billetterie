<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_path_welcome',
        'image_path_login',
        'background_images_path_login',
    ];
}
