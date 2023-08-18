@extends('layouts.main')

@section('title','curso Laravel')

    {{-- JavaScript --}}
    <script src="/js/script1.js" defer></script>


@section('content')


        {{-- Aula08 --}}
    {{-- passagem de parametros pelas rotas --}}

    <p>exibir o produto id: {{$id}}</p>





        {{-- Aula 07 --}}
    {{-- inserção de layouts, está no topo da página --}}


        {{-- Aula 06 --}}

    {{-- Essas mesmas linhas estão presentes no arquivo main.blade.php --}}
    {{-- <link rel="stylesheet" href="/css/style.css">
    <script src="/js/script.js" defer></script> --}}

    <p class="euAmoVc" id="txt_amo_vc"> Eu amo você!</p>
    <button class="botao__euAmoVc" id="btn__euAmoVc">❤️</button>
    <br><br>
    <button class="btn_mostra_some" id="btn_mostra_some">👨🏽‍🎨</button>
    <img class="img_aula06" id="img_aula06" src="/img/fundo.png" alt="">





        {{-- Aula 05 --}}
        @for ($i = 1; $i>=0;$i--)

            @if($array[$i] == 1)
                <p>eu amo voçê número 1</p>

            @elseif ($array[$i]== 2)
                <p>Olá mundo! número 2</p>
            @endif

        @endfor

        @php
            $name =  "João";
            echo $name;
        @endphp

        {{-- comentario devem ser feitos assim  --}}

        @foreach ($array as $numeros)
            <p>{{$loop->index}} - {{$numeros}} (índice)</p>
            {{-- o loop é o indice do elemento no array --}}

        @endforeach



@endsection

