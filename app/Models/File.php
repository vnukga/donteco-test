<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class File extends Model
{
    use HasFactory;

    protected $appends = ['link'];

    public function getLinkAttribute()
    {
        return $this->attributes['link'] = URL::to('/') . '/file/' . $this->id;
    }
}
