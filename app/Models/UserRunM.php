<?php

namespace App\Models;

use App\Http\Controllers\AuthController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class UserRunM extends Model
{
    use HasFactory;

    protected $fillable = [
        'lat_long',
        'time',
        'km',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(AuthController::class);
    }

    protected $table = "user_run";
}
