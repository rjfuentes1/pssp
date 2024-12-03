<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReturnOfService extends Model
{
    use HasFactory;

    protected $fillable = ['scholar_id', 'agreement', 'board_take', 'board_status', 'start_of_deployment', 'end_of_deployment', 'remarks'];

    public function scholar(): BelongsTo
    {
        return $this->belongsTo(Scholar::class);
    }
}
