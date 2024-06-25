@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu Endereço de Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um novo Link de Verificação foi enviado para seu Email.') }}
                        </div>
                    @endif

                    {{ __('Por favor verifique seu Email.') }}
                    {{ __('Se você não recebeu o Email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Clique aqui para efetuar um novo envio') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
