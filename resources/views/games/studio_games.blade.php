@extends('layouts.fo')

@section('content')
    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h1>Jogos do Estúdio: {{ $studio->name }}</h1>
            <a href="{{ route('studios.all') }}" class="btn btn-link p-0">← Voltar aos Estúdios</a>
        </div>

        @auth
            @if (auth()->user()->user_type === \App\Models\User::TYPE_ADMIN)
                <a href="{{ route('games.add', $studio->id) }}" class="btn btn-success">+ Adicionar Jogo</a>
            @endif
        @endauth
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Capa</th>
                    <th>Nome do Jogo</th>
                    <th>Estúdio</th>
                    <th>Data de Lançamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($games as $game)
                    <tr>
                        <td>{{ $game->id }}</td>
                        <td>
                            <img class="photo-table"
                                src="{{ $game->cover ? asset('storage/' . $game->cover) : asset('images/nophoto.jpg') }}"
                                alt="{{ $game->name }}">
                        </td>
                        <td>{{ $game->name }}</td>
                        <td>{{ $studio->name }}</td>
                        <td>{{ $game->release_date ?? 'Não definida' }}</td>
                        <td class="d-flex flex-wrap gap-1">
                            @auth
                                <a href="{{ route('games.edit', $game->id) }}" class="btn btn-warning btn-sm">
                                    Editar
                                </a>

                                @if (auth()->user()->user_type === \App\Models\User::TYPE_ADMIN)
                                    <a href="{{ route('games.delete', $game->id) }}" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Tens a certeza que queres apagar este jogo?')">
                                        Apagar
                                    </a>
                                @endif
                            @else
                                <span class="text-muted small">Apenas visualização</span>
                            @endauth
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Este estúdio ainda não tem jogos registados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
