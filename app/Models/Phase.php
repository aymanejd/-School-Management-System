<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $fillable=['Name','Notes'];
    use HasFactory;
    public function grades (){
        return $this->hasMany(Grade::class);
    }
    public function sections (){
        return $this->hasMany(Section::class,'phase_id');
    }
}