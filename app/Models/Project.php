<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Technology;
// use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    // public function getRouteKey(){
    //     return $this->slug;
    // }




    public function type(){
        // belongsTo si usa nella tabella che ha la chiave esterna, cioè quella che sta dalla parte del molti
        return $this->belongsTo(Type::class);
    }

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    // public static function slugger($string){
    //     // generare slug base
    //     $baseSlug = Str::slug($string);
    //     $i = 1;
    //     $slug = $baseSlug;
    //     while(self::where('slug', $slug)->first()){
    //         $slug = $baseSlug . '-' . $i;
    //         $i++;
    //     }
    //     // verificare se lo slug base è già presente nel db

    //     // se presente incrementare contatotore e concatenare il numero allo slug base per univocità

    //     // ripetere finchè non è univoco
    //     return $slug;
    // }
}
