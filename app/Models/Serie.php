<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;
    //somente os campos definidos como fillable podem ser preenchidos por mass assignment
    protected $fillable = ['nome'];

    //É necessário criar na model uma função de relacionamento
    //onde informamos que essa série tem muitas temporadas
    public function seasons(){
        return $this->hasMany(Season::class, 'series_id');
    }

    //O booted é criado para que possa ser adicionado um escopo (local ou global)
    //esse escopo permite informar que sempre que for feito um select da tabela serie
    //as informações venham de acordo com o que colocardo no escopo (ordenadas por nome nesse caso)
    protected static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder){
            $queryBuilder->orderBy('nome');
        });
    }
}
