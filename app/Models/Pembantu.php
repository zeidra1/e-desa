<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembantu extends Model
{
    protected $table = 'pembantu';

    public $fillable = ['alternatif_id','kreteria_id','format','jenis','nilai'];

    public function kreteria(){
      return $this->belongsTo('App\Models\Kreteria');
    }

    public function scopeKondisiJenis($query,$format){
      $query->where('format',$format);
    }

    public function scopeKondisiSemua($query,$jenis,$format,$kreteria){
      $query->where('format',$format)
            ->where('kreteria_id',$kreteria)
            ->where('jenis',$jenis);

    }
}