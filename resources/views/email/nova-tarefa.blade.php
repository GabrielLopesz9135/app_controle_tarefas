<x-mail::message>
# {{$task}}

Data Limite da Tarefa: {{$deadline}}

<x-mail::button :url="$url">
Acessar Tarefa
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
