<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSlider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function getCoverAttribute()
    {
        return $this->file ? asset('storage/' . $this->file->path) : 'https://ui-avatars.com/api/?name=' . urlencode($this->title) . '&color=7F9CF5&background=EBF4FF';
    }
}
