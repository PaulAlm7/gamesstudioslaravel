@extends('layouts.fo')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <h1>Estúdios de Videojogos</h1>

        @auth
            @if (auth()->user()->user_type === \App\Models\User::TYPE_ADMIN)
                <a href="{{ route('studios.add') }}" class="btn btn-success">+ Adicionar Estúdio</a>
            @endif
        @endauth
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo / Foto</th>
                    <th>Nome do Estúdio</th>
                    <th>Nº de Jogos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($studios as $studio)
                    <tr>
                        <td>{{ $studio->id }}</td>
                        <td>
                            <img class="photo-table"
                                src="{{ $studio->photo ? asset('storage/' . $studio->photo) : asset('images/nophoto.jpg') }}"
                                alt="{{ $studio->name }}">
                        </td>
                        <td>{{ $studio->name }}</td>
                        <td>{{ $studio->games_count }}</td>
                        <td class="d-flex flex-wrap gap-1">
                            <a href="{{ route('studios.games', $studio->id) }}" class="btn btn-info btn-sm">
                                Ver Jogos
                            </a>

                            @auth
                                <a href="{{ route('studios.edit', $studio->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                @if (auth()->user()->user_type === \App\Models\User::TYPE_ADMIN)
                                    <a href="{{ route('studios.delete', $studio->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tens a certeza que queres apagar este estúdio?')">
                                        Apagar
                                    </a>
                                @endif
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Ainda não existem estúdios registados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
