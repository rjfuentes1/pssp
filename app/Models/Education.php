<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['scholar_id', 'institution_id', 'course_id', 'year_of_acceptance', 'year_of_ending', 'do_number', 'remarks'];

    public function scholar(): BelongsTo
    {
        return $this->belongsTo(Scholar::class);
    }

    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
