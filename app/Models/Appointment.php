<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desk;
use App\Models\WorkingHour;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'desk_id',
        'appointment_date',
        'working_hour_id',
        'user_name',
        'user_email',
        'user_phone'
    ];

    // masa ve randevu arasında 1-1 ilişki
    public function workingHour()
    {
        return $this->belongsTo(WorkingHour::class);
    }

    // masa ve randevu arasında 1-1 ilişki
    public function desk()
    {
        return $this->belongsTo(Desk::class);
    }

}
