<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostLanguage extends Model
{
    use HasFactory;
    protected $table = 'job_post_language';
    protected $fillable = [
        'id', 'job_post_id', 'language_id', 'level', 'certificate', 'updated_at', 'created_at'
    ];
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
