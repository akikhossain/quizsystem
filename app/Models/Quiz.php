<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $dates = ['deadline'];
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function isSubmissionPeriodActive()
    {
        $today = Carbon::today();
        return $this->deadline <= $today && $this->deadline >= $today;
    }
}
