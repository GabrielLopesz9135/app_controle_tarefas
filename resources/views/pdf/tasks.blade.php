<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    </head>

    <style>
        .page-break {
            page-break-after: always;
        }

        .title {
            text-transform: uppercase;
            background-color: #c2c2c2;
            border: 1px;
            text-align: center;
            width: 100vw;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .table {
            width: 100%;
        }

        table th {
            text-align: left;
        }
    </style>

<body>

<div class="title">Lista de Tarefas</div>


    
        
        @for ($count = 0; $count < $numPages; $count++)
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tarefa</th>
                    <th>Data Limite</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = $count * $paginador; $i < ($count * $paginador) + $paginador; $i++)
                @if($data->has($i))
                    <tr>
                        <td>{{ $data->get($i)->id }}</td>
                        <td>{{ $data->get($i)->task }}</td>
                        <td>{{ date('d/m/Y', strtotime($data->get($i)->deadline)) }}</td>
                    </tr> 
                @endif
                    
                @endfor
                
            </tbody>
        </table>

        @if ($count != $numPages - 1)
            <div class="page-break"></div>
            <h1>Pagina {{$count+2}}</h1>
        @endif
        @endfor
    



</body>
</html>
