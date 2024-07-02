<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTestMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tarefas.index');
});


Auth::routes(['verify' => true]);

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified'); */

Route::resource('/tarefas', TarefaController::class)
    ->middleware('verified');



Route::get('/export/{extension}', [TarefaController::class, 'export'])->name('task.export');
Route::post('/import', [TarefaController::class, 'import'])->name('task.import');

Route::get('mensagem-teste', function(){
    return new MensagemTestMail(); 
   /* Mail::to('brbilbits@gmail.com')->send(new MensagemTestMail()); */
});
