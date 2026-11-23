@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h1>Editar Estúdio: {{ $studio->name }}</h1>

        <form method="POST" action="{{ route('studios.update') }}" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $studio->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Nome do Estúdio</label>
                <input type="text" name="name" id="name" value="{{ old('name', $studio->name) }}" required
                    class="form-control">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label d-block">Imagem Atual</label>
                <img class="photo-table mb-2"
                    src="{{ $studio->photo ? asset('storage/' . $studio->photo) : asset('images/nophoto.jpg') }}"
                    alt="{{ $studio->name }}">

                <label for="photo" class="form-label d-block">Substituir Fotografia / Logo (opcional)</label>
                <input type="file" name="photo" id="photo" accept="image/*" class="form-control">
                @error('photo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Estúdio</button>
            <a href="{{ route('studios.all') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
@endsection
