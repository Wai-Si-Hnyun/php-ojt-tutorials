<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'major_id',
        'phone',
        'email',
        'address'
    ];

    /**
     * Get the major that owns the Student
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class, 'major_id');
    }
}
