<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeekerLanguage extends Model
{
    use HasFactory;
    protected $table = 'seeker_language';
    protected $fillable = [
        'id', 'seeker_profile_id', 'language_id', 'level', 'certificate', 'updated_at', 'created_at'
    ];
    public function language()
    {
        return $this->belongsTo(Language::class, 'language_id');
    }
}
