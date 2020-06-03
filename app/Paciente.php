<?php

namespace App;

use App\Casts\Cpf;
use App\Casts\Nome;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

    protected $fillable = [
        'nome',
        'cpf',
        'nome_mae',
        'data_nascimento',
        'sexo',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'telefone',
        'pr_saude',
        'user_create'
    ];

    protected $casts = [
        'cpf' => Cpf::class,
        'nome' => Nome::class,
        'nome_mae' => Nome::class
    ];

    public function getDataNascimentoAttribute($value)
    {
        return date("d/m/Y",strtotime($value));
    }

    public function setDataNascimentoAttribute($value)
    {
        $this->attributes['data_nascimento'] = date("Y-m-d",strtotime(str_replace("/","-",$value)));
    }

    public function getCreatedAtAttribute($value)
    {
        return date("d/m/Y",strtotime($value));
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['data_nascimento'] = date("Y-m-d",strtotime(str_replace("/","-",$value)));
    }

    /**Relacionamentos */
    public function responsavel()
    {
        return $this->belongsTo(User::class, 'user_create');
    }

    public function historico()
    {
        return $this->hasMany(Historico::class, 'paciente_id');
    }

    public function info_clinicas()
    {
        return $this->hasMany(Info_clinicas::class, 'paciente_id');
    }

    public function getPaciente(string $cpf): ?Paciente
    {
        foreach (self::all() as $paciente) {
            if ($paciente->cpf === $cpf)
                return $paciente;
        }
        return null;
    }
}
