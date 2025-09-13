<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ContentPage extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    protected $fillable = [
        'slug',
        'title',
        'description',
        'instructions'
    ];
}
