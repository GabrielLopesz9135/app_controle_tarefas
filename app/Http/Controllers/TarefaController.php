<?php

namespace App\Http\Controllers;

use App\Exports\TaskExport;
use App\Imports\TaskImport;
use App\Models\Task;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TarefaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $tasks = Task::where('user_id', '=', $user_id)->paginate(10);
        return view('tarefas.index', ['tasks' => $tasks, 'request' => $request->all()]);
    }

    public function create()
    {
        return view('tarefas.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $task = Task::create($data);
        return redirect()->route('tarefas.edit', ['tarefa' => $task->id]);
    }

    public function show(Task $tarefa)
    {
        
    }

    public function edit(Task $tarefa)
    {
        if(Auth::user()->id == $tarefa->user_id){
            return view('tarefas.update', ['task' => $tarefa]);
        }else{
            return view('acesso-negado');
        }
        
    }

    public function update(Request $request, Task $tarefa)
    {
        if(Auth::user()->id == $tarefa->user_id){
            $tarefa->update($request->all());
            return redirect()->route('tarefas.edit', ['tarefa' => $tarefa->id]);
        }else{
            return view('acesso-negado');
        }
        
    }

    public function destroy(Task $tarefa)
    {
        if(Auth::user()->id == $tarefa->user_id){
            $tarefa->delete();
            return redirect()->route('tarefas.index');
        }else{
            return view('acesso-negado');
        }  
    }

    public function export($extension)
    {
        if(in_array($extension, ['xlsx', 'csv', 'pdf'])){
            return Excel::download(new TaskExport(Auth::user()), 'tasks.'.$extension);
        }else{
            redirect()->route('tarefas.index');
        }   
    }

    public function import(Request $request) 
    {
       
        $request->validate([
            'file' => 'required|max:2048',
        ]);
  
        Excel::import(new TaskImport(Auth::user()), $request->file('file'));


        return back()->with('success', 'Tarefa importada com sucesso.');
    }

    public function exportPdf()
    {
        $tasks = Task::where('user_id', '=', Auth::user()->id)->get();
        $paginador = 10;
        $numPages = ceil(count($tasks) / $paginador);
        $pdf = Pdf::loadView('pdf.tasks', ['data' => $tasks, 'numPages' => $numPages, 'paginador' => $paginador]);
        return $pdf->download('tasks.pdf'); 
    }

}
