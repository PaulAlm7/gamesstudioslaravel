@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h1>Adicionar Estúdio</h1>

        <form method="POST" action="{{ route('studios.store') }}" enctype="multipart/form-data" class="mt-3">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Estúdio</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required class="form-control">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Fotografia / Logo (opcional)</label>
                <input type="file" name="photo" id="photo" accept="image/*" class="form-control">
                @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Estúdio</button>
            <a href="{{ route('studios.all') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
