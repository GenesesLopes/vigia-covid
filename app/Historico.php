<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $fillable = ['id','paciente_id','users_id','action','data'];

    protected $casts = [
        'data' => 'array'
    ];
    /**Relação de usuários */
    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

    /**Relação pacientes */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'paciente_id');
    }
}