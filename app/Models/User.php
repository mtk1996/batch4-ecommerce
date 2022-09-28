<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    protected $hidden = ['password'];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return asset('/images/') . '/' . $this->image;
    }
    public function review()
    {
        return $this->hasMany(ProductReview::class);
    }
}
