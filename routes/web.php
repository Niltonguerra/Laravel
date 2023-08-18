<?php

use Illuminate\Support\Facades\Route;



// IMPORTANTE, quando colocar as rotas cuidado com a ordem que coloca, pois isso importa, por exemplo se colocar a route:

// Route::get('/events/{id}',[EventController::class,'show']);

//  em cima da route:

// Route::get('/events/create', [EventController::class, 'createe']);

//  a route do create não irá funcionar, pois a função findoufail irá sobrepor a route create é informará uma página 404





use App\Http\Controllers\EventController;


Route::get('/aula08', [EventController::class, 'aula08']);



//create
                                                                //->middleware('auth') esse trecho faz com que só pessoas logadas
                                                                //possam acessar essa página.
Route::get('/events/create', [EventController::class, 'createe'])->middleware('auth');

//dashboard
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');

//botão do formulário!
Route::post('/events',[EventController::class,'store']);

Route::get('/produtos', [EventController::class, 'produtos']);

Route::get('/contatos', [EventController::class, 'contatos']);

Route::get('/', [EventController::class, 'home']);

//carrega página!, com as informações mais bem explicadas do evento
Route::get('/events/{id}',[EventController::class,'show']);

//deleta o evento
Route::delete('/events/{id}',[EventController::class,'destroy'])->middleware('auth');

//edita o evento
Route::get('/events/edit/{id}',[EventController::class,'edit'])->middleware('auth');

//faz o update --- é o botão no formulário de editar
Route::put('/events/update/{id}',[EventController::class,'update'])->middleware('auth');

//participar de um evento
Route::post('/events/join/{id}',[EventController::class,'joinEvent'])->middleware('auth');

Route::delete('/events/leave/{id}',[EventController::class,'leaveEvent'])->middleware('auth');


//////////////////////////////////////////////////////////////////////////////////////////////////////////////


// esse é um jeito funcional para enviar parametros
// a interrogação torna um parâmetro não obrigatório

            // Route::get('/aulas/{id?}', function ($id = null) {
            //     $nome = "Gustavo";
            //     $idade = 20;
            //     $array = [
            //         1,
            //         2,
            //     ];

            //     return view('tela1',[
            //                             'id' => $id,
            //                             'nome' => $nome,
            //                             'idade' => $idade,
            //                             'array' => $array
            //                         ]);
            // });



////////////////////////////////////////////////////////////////////////////////////////////////////////////

            // rota do jetstream para a dashboard
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
