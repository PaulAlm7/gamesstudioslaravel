@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h1>Editar Jogo: {{ $game->name }}</h1>

        <form method="POST" action="{{ route('games.update') }}" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $game->id }}">

            <div class="mb-3">
                <label for="studio_id" class="form-label">Estúdio</label>
                <select name="studio_id" id="studio_id" required class="form-select">
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}"
                            {{ (string) old('studio_id', $game->studio_id) === (string) $studio->id ? 'selected' : '' }}>
                            {{ $studio->name }}
                        </option>
                    @endforeach
                </select>
                @error('studio_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Jogo</label>
                <input type="text" name="name" id="name" value="{{ old('name', $game->name) }}" required
                    class="form-control">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Data de Lançamento (opcional)</label>
                <input type="date" name="release_date" id="release_date"
                    value="{{ old('release_date', $game->release_date) }}" class="form-control">
                @error('release_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Capa Atual</label>
                <img class="photo-table mb-2"
                    src="{{ $game->cover ? asset('storage/' . $game->cover) : asset('images/nophoto.jpg') }}"
                    alt="{{ $game->name }}">

                <label for="cover" class="form-label d-block">Substituir Capa do Jogo (opcional)</label>
                <input type="file" name="cover" id="cover" accept="image/*" class="form-control">
                @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Jogo</button>
            <a href="{{ route('studios.games', $game->studio_id) }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
@endsection
