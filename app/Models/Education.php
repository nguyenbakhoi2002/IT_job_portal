<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'educations';
    protected $fillable = [
        'id', 'school_name', 'major_id', 'start_date', 'end_date', 'seeker_profile_id', 'degree_id','description', 'updated_at', 'created_at'
    ];
    public function degree(){
        return $this->belongsTo(Degree::class, 'degree_id');

    }
    public function major(){
        return $this->belongsTo(Major::class, 'major_id');

    }
}
