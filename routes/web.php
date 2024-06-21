<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/tarefas', TarefaController::class);

Route::get('mensagem-teste', function(){
   /*  return new MensagemTestMail(); */
   /* Mail::to('brbilbits@gmail.com')->send(new MensagemTestMail()); */
});
