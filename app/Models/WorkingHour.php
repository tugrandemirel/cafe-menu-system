<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Desk;
use App\Models\Appointment;

class WorkingHour extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'hour',
    ];

    // veritabanındaki veriler day alanı string olarak tutulduğu için day alanı string olarak tanımlandı
    // veritabanındaki veriler hour alanı array olarak tutulduğu için hour alanı array olarak tanımlandı
    protected $casts = [
        'day' => 'string',
        'hour' => 'array',
    ];

    // çalışma saatleri ile randevular arasında ilişki kuruldu
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // çalışma saatleri ile masalar arasında ilişki kuruldu
    public function desks()
    {
        return $this->hasMany(Desk::class);
    }



}
