<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'fname','mname',
        'lname','email',
        'gender','user_type',
        'religion'
    ];
    public function subject(): BelongsToMany
    {
        return $this->belongsToMany(subject::class,'student_subject_scores','student_id', 'subject_id')->withPivot('score');
    }
}
