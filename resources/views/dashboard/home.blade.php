@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h1>Olá, {{ auth()->user()->name }}</h1>

        @if (auth()->user()->user_type === \App\Models\User::TYPE_ADMIN)
            <div class="alert alert-info mt-3" role="alert">
                Conta de Administrador
            </div>
        @else
            <div class="alert alert-secondary mt-3" role="alert">
                Conta de Utilizador Autenticado (pode editar estúdios e jogos)
            </div>
        @endif

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card p-3">
                    <h5>Total de Estúdios</h5>
                    <p class="fs-4 mb-0">{{ $totalStudios }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3">
                    <h5>Total de Jogos</h5>
                    <p class="fs-4 mb-0">{{ $totalGames }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
