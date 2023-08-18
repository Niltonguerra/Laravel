<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        {{-- Bootstap --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

{{-- estilos --}}
  <link rel="stylesheet" href="/css/style.css">







    </head>

    <body>

       <header>

              <nav class="navbar navbar-expand-lg navbar-light">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand">
                        <img src="\img\imagens_server\logo.png" alt="Logo">

                    </a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/events/create">criar Evento</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/contatos">Contatos</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Dropdown link
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>

                        {{-- o auth serve para mostrar quando a pessoa já fez login no site --}}
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">meus eventos</a>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="post">
                            @csrf
                            <a href="/logout" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Sair</a >
                            </form>
                        </li>
                        @endauth

                        {{-- o guest serve para mostrar coisas quando a pessoa ainda não entrou na conta do site--}}
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/register">Cadastrar</a>
                        </li>
                        @endguest
                    </ul>

                </div>
              </nav>
          </header>







<main>

    {{-- flash messages --}}
    <div class="container-fluid">
        <div class="row">
        @if (session('msg'))
            <p class="msg">{{session('msg') }}</p>
        @endif
    </div>
        @yield('content')

    </div>
</main>



    <footer>
        <p>HDC Events &copy; 2023</p>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </footer>

    </body>
</html>
