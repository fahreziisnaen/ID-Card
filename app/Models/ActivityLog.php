<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'activity_type', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk format waktu Indonesia
    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)
            ->timezone('Asia/Jakarta')
            ->isoFormat('D MMM Y HH:mm');  // Format Indonesia: "15 Mar 2024 14:30"
    }
} 