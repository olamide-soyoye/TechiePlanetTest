<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class subject extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function student(): BelongsToMany
    {
        return $this->belongsToMany(Student::class,'student_subject_scores','subject_id', 'student_id');
    }

}
