<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'slug'];

    public function getAbstract() {
        $abstract = substr($this->description, 0, 50) . '...';
        return $abstract;
    }

    public function getDate($date, $format = 'd-m-Y') {
        return Carbon::create($date)->format($format);
    }

    //rende il caricamento delle pagine troppo lento
    // public function isValidImage() {
    //     $imageInfo = @getimagesize($this->image);
    //     $isValidImage = $imageInfo !== false;
    //     return $isValidImage;
    // }

    public function getImagePath() {
        return asset('storage/' . $this->image);
    }
}
