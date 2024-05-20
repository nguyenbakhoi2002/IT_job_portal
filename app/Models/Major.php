<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Major extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    // public $timestamps = false;//để không bị thêm  hai trường updated_at và created_at
    protected $table = 'majors';
    protected $fillable = ['id', 'name', 'description','status', 'created_at', 'updated_at'];
    public function jobPost(){
        return $this->hasMany(JobPost::class, 'major_id')
                ->where('status', 1)
                ->where('end_date', '>', now());
     }
}
