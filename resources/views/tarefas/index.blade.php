@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header row d-flex align-items-center">
                    
                    <div class="col-4 mb-3">
                        Lista de Tarefas
                    </div>
                    
                    <div class="col-8 d-flex justify-content-end mb-3"> 
                        <a class="px-3" href="{{route('tarefas.create')}}" class=""> Nova Tarefa</a>
                        <a class="px-3" href="{{route('task.export', ['extension' => 'xlsx'])}}">XSLX</a>
                        <a class="px-3" href="{{route('task.export', ['extension' => 'csv'])}}">CSV</a>
                        <a class="px-3" href="{{route('task.exportPdf')}}" target="_blanck">PDF</a>
                    </div>

                        <form class="row mt-2 mb-2" action="{{ route('task.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-3"><button type="submit" class="btn btn-success"><i class="fa fa-file px-2"></i> Importar Arquivo</button></div>
                            <div class="col-9"><input type="file" name="file" class="form-control"></div>   
                        </form>
            
                </div>

                <div class="card-body">

                    <table class="table">
                        <tbody>
                            @foreach ($tasks as $item)
                                <tr >
                                    <td style="vertical-align: middle;"><b>Tarefa:</b> {{$item->task}}</td>
                                    <td style="vertical-align: middle;"><b>Data Limite:</b> {{date('d/m/Y', strtotime($item->deadline))}}</td>
                                    <td class="row d-flex justify-content-center align-itens-center"> 
                                       <a class="btn btn-primary col-4" href="{{route('tarefas.edit', ['tarefa' => $item->id])}}">Editar Tarefa</a>

                                        <form method="POST" class="col-6" action="{{route('tarefas.destroy', ['tarefa' => $item->id])}}">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger">Excluir Tarefa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                    {{-- <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item"><a class="page-link" href="{{$tasks->previousPageUrl() }}">Voltar</a></li>

                          @for ($i = 1; $i <= $tasks->lastPage(); $i++)
                            <li class="page-item {{$tasks->currentPage() == $i ? 'active' : ''}}"><a class="page-link" href="{{$tasks->url($i)}}">{{$i}}</a></li>
                          @endfor
                          
                          <li class="page-item"><a class="page-link"  href="{{$tasks->nextPageUrl() }}">Avançar</a></li>
                        </ul>
                      </nav> --}}

                      <div class="pt-1">
                            {{$tasks->appends($request)->links()}}
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
