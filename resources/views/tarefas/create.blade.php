@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Adicionar Tarefa</div>

                <div class="card-body">
                    <form action="{{route('tarefas.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="" class="form-label">Tarefa</label>
                            <input type="text" class="form-control" name="task" id="task">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Data Limite</label>
                            <input type="date" class="form-control" id="deadline" name="deadline">
                        </div>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
