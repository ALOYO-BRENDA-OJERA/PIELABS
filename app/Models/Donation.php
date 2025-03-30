<?php
// app/Models/Donation.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['user_id', 'amount', 'donor_name', 'payment_method', 'transaction_id', 'donated_at'];

    protected $casts = [
        'donated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
