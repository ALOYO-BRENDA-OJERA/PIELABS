<?php
// app/Models/Cause.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    protected $fillable = ['title', 'description', 'image', 'donation_link', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
