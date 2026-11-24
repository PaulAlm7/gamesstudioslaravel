@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h1>Adicionar Jogo</h1>

        <form method="POST" action="{{ route('games.store') }}" enctype="multipart/form-data" class="mt-3">
            @csrf

            <div class="mb-3">
                <label for="studio_id" class="form-label">Estúdio</label>
                <select name="studio_id" id="studio_id" required class="form-select">
                    <option value="">-- Seleciona um estúdio --</option>
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}"
                            {{ (string) old('studio_id', $studio_id) === (string) $studio->id ? 'selected' : '' }}>
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
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-control">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="release_date" class="form-label">Data de Lançamento (opcional)</label>
                <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}" class="form-control">
                @error('release_date')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="cover" class="form-label">Capa do Jogo (opcional)</label>
                <input type="file" name="cover" id="cover" accept="image/*" class="form-control">
                @error('cover')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Jogo</button>
            <a href="{{ $studio_id ? route('studios.games', $studio_id) : route('studios.all') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
