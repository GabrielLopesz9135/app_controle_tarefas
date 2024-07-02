@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Tarefa</div>

                <div class="card-body">
                    <form action="{{route('tarefas.update', ['tarefa' => $task->id ])}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="" class="form-label">Tarefa</label>
                            <input type="text" class="form-control" name="task" id="task" value="{{$task->task}}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Data Limite</label>
                            <input type="date" class="form-control" id="deadline" name="deadline" value="{{$task->deadline}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <a href="{{route('tarefas.index')}}" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
