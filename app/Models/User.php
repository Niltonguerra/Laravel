<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


// cria para referenciar o usuario para o evento como criador do evento

//pelo que entendi esse código verifica o usuario para os eventos que ele criou
//,por exemplo, você passa o id do usuario e ele passaa pela tabela event_user verifica os dados
//que tem o id do usuario e trás os id's dos eventos que tem o id do usuario
    public function events(){
        return $this->hasMany('App\Models\Event');
    }




// cria para referenciar o usuario para o evento como participante

//pelo que entendi ele pega os id's dos eventos que tem o id do usuario e trás eles
// varios uma pessoa pode ter apenas um evento como participante
    public function eventsAsParticipant(){
        return $this->belongsToMany('App\Models\Event');
    }


}
