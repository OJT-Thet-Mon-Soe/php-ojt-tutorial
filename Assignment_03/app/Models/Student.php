<?php

namespace App\Models;

use App\Models\Major;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ["name", "phone", "email", "address", "major_id"];

    public function major(){
        return $this->belongsTo(Major::class,'major_id');
    }
}
