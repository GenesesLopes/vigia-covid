<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Casts\Cpf;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'cpf', 'password','user_adm'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'cpf' => Cpf::class
    ];

    /**Relação adm */
    public function adm()
    {
        return $this->belongsTo(User::class,'user_adm');
    }

    /**Relação funcionarios */

    public function funcionarios()
    {
        return $this->hasMany(User::class,'user_adm');
    }

     /**Verificando login */
     public function getCpf($request): ?User
     {
         foreach(User::all() as $user){
             if($user->cpf === $request->cpf)
                 return $user;
         }
         return null;
     }

    // /**
    //  * Encriptando cpf
    //  */
    // public function setCpfAttribute($value)
    // {
    //     $this->attributes['cpf'] = Crypt::encryptString(preg_replace("/\D/","",$value));
    // }
    // /**Decriptografando cpf */
    // public function getCpfAttribute($value)
    // {
    //     return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/i","$1.$2.$3-$4",Crypt::decryptString($value));

    // }

}
