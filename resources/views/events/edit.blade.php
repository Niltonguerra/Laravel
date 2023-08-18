@extends('layouts.main')

@section('title','editando:' . $event->title)


@section('content')



<div id="event-create-container" class="col-md-6 offset-md-3">
    <h1>Editando: {{$event->title}}</h1>

    <form action="/events/update/{{$event->id}}" method="POST" enctype="multipart/form-data">
        {{-- a diretiva '@csrf' é essencial, uma vez que se ela não for
        colocada o formulario não será enviado e cadastrado no banco!--}}
        @csrf

        {{-- o @method('PUT') é para o sistema entender que estou editando o registro --}}
        @method('PUT')

        {{-- imagem --}}
    <div class="form-group">
        <label for="image">imagem:</label>
        <input type="file" class="form-control-file" id="image" name="image" >
        <img src="/img/events/{{$event->image}}" alt="{{$event->title}}" class="img-preview">
    </div>


    <div class="form-group">
        <label for="title">Evento:</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" value="{{$event->title}}">
    </div>

    <div class="form-group">
        <label for="title">Data do evento:</label>
        <input type="date" class="form-control" id="date" name="date" value="{{$event->date}}"  >
    </div>


    <div class="form-group">
        <label for="title">cidade:</label>
        <input type="text" class="form-control" id="city" name="city" placeholder="cidade do envento" value="{{$event->city}}">
    </div>
    <div class="form-group">
        <label for="title">Evento é privado:</label>
        <select name="private" id="private" class="form-control">
            <option value="0">Não</option>
            <option value="1" {{ $event->private == 1 ? "'selected:'selected'":"" }}>Sim</option>
        </select>
    </div>
    <div class="form-group">
        <label for="title">descrição:</label>
    <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$event->description}}</textarea>
    </div>



    <div class="form-group">
        <label for="title"> Adicione itens de infraestrutura:</label>

        <div class="form-group">
                                        {{-- É preciso colocar no name: // name="items[]" // para que o programa
                                        identifique que estou enviando mais de um item, caso não coloque ele irá
                                        identificar apenas o último elemento   --}}
            <input type="checkbox" name="items[]" value="cadeiras"> Cadeiras
        </div>

        <div class="form-group">
            <input type="checkbox" name="items[]" value="open bar"> Open bar
        </div>

        <div class="form-group">
            <input type="checkbox" name="items[]" value="brindes"> Brindes
        </div>
    </div>

    <input type="submit" class="btn btn-primary" value="Editar evento">
    </form>
</div>


@endsection
