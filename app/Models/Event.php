<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // fala para o sistema que o elemento items(que é o arquivo em json do formulario) é para ser
    // reconhecido como um array e não como normalmente é reconhecido, um objeto
    protected $casts = ['items' => 'array'];

    protected $dates =['date'];




    // diz ao sistema que o usuario é único  para um evento( o evento é descriminado no nome do arquivo "Event.php"
    // para dizer que são muitos eventos para um usuario você deve ir em user.php e colocar o deguinte código:

    // public function events(){
    //     return $this->hasMany('App\Models\Event');
    // }
    //)

    //Atenção embora eu tenha escrito como se fosse para fazer um ou outro processo, deve-se fazer os dois ir em 'Event.php'
    // e escrever o código e ir em 'User.php' e escrever o código comentado em cima, para o sistema entender que é uma
    //relação de One to many


    //criado para dizer para o sistema que o evento só tem um usuario como criador
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //criado para permitir que seja possivel alterar as informações do evento
protected $guarded = [];


//criado para dizer para o sistema que um evento pode ter varios  participantes
public function users(){
    return $this->belongsToMany('App\Models\User');
}


}
