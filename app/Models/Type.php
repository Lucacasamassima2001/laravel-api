<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;
    use SoftDeletes;
    // public $timestamps = false;
    public function projects(){
        // hasMany si usa sul model della tabella che NON ha la chiave esterna in una relazione UNO a MOLTI
        // hasOne si usa sul model della tabella che NON ha la chiave esterna in una relazione UNO a UNO
        return $this->hasMany(Project::class);
    }
}
