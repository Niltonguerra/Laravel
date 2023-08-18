<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


//conecta o model com o controller
use App\Models\Event;
use App\Models\User;

class EventController extends Controller
{
    //
    public function aula08(){

    // você passa pela url algo assim :
    // e depois puxa a informação da url pelo request
    $busca = request('search');
    $events = Event::all();


    return view('aula08',[
                        'busca' => $busca,
                        'events' => $events

                        ]);

}




















public function home(){

    $search = request('search');

if($search) {
    $events = Event::where([
        ['title', 'like', '%'.$search.'%']
        ])->get();
    }else{
        $events = Event::all();
    }





    return view('home',['events' => $events, 'search' => $search]);
}















public function createe(){
    return view('events.create');
}






















//botão cadastrar informações no banco
public function store(request $request){
//o formulario é armazenado dentro desse request

//instaciando o model
    $event = new Event();

    //enviado as informações do formulário para as variáveis do model
    $event->title = $request->title;
    $event->city = $request->city;
    $event->private = $request->private;
    $event->description = $request->description;
    $event->date = $request->date;


    // puxa os itens criados no formato json no formulário, além de fazer isso também deve fazer uma configuração
    // no arquivo Models/Event.php
    $event->items = $request->items;



//tratamento de imagem

// predefine uma imagem para o evento para evitar erros
$event->image = 'imagem_padrao_evento.png';




if($request->hasFile('image') && $request->file('image')->isValid()) {

    //extanciando o variavel apenas para escrever menos código
    $requestImage = $request->image;

    // verifica a extensão do arquivo
    $extension = $requestImage->extension();

    // codificar o nome do arquivo
    $imageName =md5($requestImage->getClientOriginalName().strtotime("now")) . "." .$extension;

    // salva a imagem no servidor no diretório img/events
    $requestImage->move(public_path('img/events'), $imageName);

    //setando a variavel para enviar para o servidor
    $event->image = $imageName;
}

// aqui ele está fazendo a conexão de um usuario para o evento que está sendo criado,essa propriedade foi criada no
// Model/Event.php
$user = auth()->user();
$event->user_id = $user->id;


    //enviando as informações para o banco de dados
    $event ->save();

    return redirect('/events/create')->with('msg',"Evento cadastrado com sucesso");

}















public function show($id){
    $event = Event::findOrFail($id);
                                                    // o '->first()' serve para ele pegar
                                                    // o primeiroque aparecer e não procurar pelo
                                                    // banco de dados todo
    $eventOwner = User::where('id', $event->user_id)->first()->toArray();
                                                    //o '->toArray()' é opcional, se você quiser você pode
                                                    //ou não converter para array



    //tratamento para impedir que o usuario possa se cadastrar duas vezes para o mesmo evento
    $user = auth()->user();

    //criando um variavel para verificar se o usuario já participou do evento
    $hasUserJoined = false;

    //verificando se o usuario está logado
    if($user){

        //nessa linha ele está pegando o usuario logado e com isso ele está pesquisando todos os eventos
        //que ele está participando e transformando em array
        $userEvents = $user->eventsAsParticipant->toArray();

        //aqui ele esta pegando  todos os id's dos eventos que o usuario está
        //participando e comparando com o id do evento passado pela url
        foreach($userEvents as $userEvent){
            if($userEvent['id'] == $id){
                $hasUserJoined = true;
            }
        }

    }



    return view('events.show',['event' => $event, 'eventOwner' => $eventOwner, 'hasUserJoined' => $hasUserJoined]);

}


public function create(){
    return view('events.create');
}

public function contatos(){
    return view('contatos.contatos');

}public function produtos(){
    return view('produtos.produtos');
}



public function dashboard(){
    // pega todos os dados do usuario logado no momento
    $user = auth()->user();

    //pega todos os eventos do usuario logado
    $events = $user->events;

    $eventsAsParticipant = $user->eventsAsParticipant;

    return view('events.dashboard',['events' => $events, 'eventasparticipant' => $eventsAsParticipant]);
}



public function destroy($id){
    Event::findOrFail($id)->delete();

    return redirect('/dashboard')->with('msg',"Evento apagado com sucesso!");
}


public function edit($id) {

    //a função auth(), pega as informações do usuario logado
    $user = auth()->user();

    $event = Event::findOrFail($id);

    if($user->id != $event->user_id){
        return redirect('/dashboard')->with('msg',"Acesso negado!");
    }
    return view('events.edit',['event' => $event]);
}



public function update(request $request){
    $data = $request->all();

        //update da imagem
    if($request->hasFile('image') && $request->file('image')->isValid()) {

        //extanciando o variavel apenas para escrever menos código
        $requestImage = $request->image;

        // verifica a extensão do arquivo
        $extension = $requestImage->extension();

        // codificar o nome do arquivo
        $imageName =md5($requestImage->getClientOriginalName().strtotime("now")) . "." .$extension;

        // salva a imagem no servidor no diretório img/events
        $requestImage->move(public_path('img/events'), $imageName);

        $data['image'] = $imageName;
    }

    // faz o update
    Event::findOrFail($request->id)->update($data);

    return redirect('/dashboard')->with('msg',"Evento editado com sucesso!");
}


public function joinEvent($id){
    $user = auth()->user();

    //faz a ligação entre as tabelas do usuario e do evento usando o id
    $user->eventsAsParticipant()->attach($id);

    $event = Event::findOrFail($id);

    return redirect('/dashboard')->with('msg',"você se cadastrou para o evento: ". $event->title ." com sucesso!");
}



public function leaveEvent($id){
    $user = auth()->user();

    $user->eventsAsParticipant()->detach($id);



    $event = Event::findOrFail($id);


    return redirect('/dashboard')->with('msg',"você saiu do evento: ". $event->title ." com sucesso!");

}







}
