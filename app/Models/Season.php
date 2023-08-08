<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;
    protected $fillable = ['number'];

    //Essa temporada pertence a uma série
    public function series(){
        return $this->belongsTo(Serie::class);
    }
    
    //Essa temporada tem muitos episódios
    public function episodes(){
        return $this->hasMany(Episode::class);
    }

    public function numberOfWatchedEpisodes() :int{
        return $this->episodes->filter(fn($episode)=>$episode->watched)->count();
    }
}
