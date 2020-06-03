<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_clinicas extends Model
{
    protected $fillable = [
        'paciente_id',
        'data_coleta',
        'instituicao_origem',
        'status',
        'observacoes',
        'sintomas'
    ];

    protected $casts = [
        'sintomas' => 'array'
    ];

    public function getDataColetaAttribute($value)
    {
        return date("d-m-Y", strtotime($value));
    }

    public function setDataColetaAttribute($value)
    {
        $this->attributes['data_coleta'] = date("Y-m-d", strtotime(str_replace("/", "-", $value)));
    }
}
