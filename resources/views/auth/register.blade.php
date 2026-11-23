@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h1>Registar Utilizador</h1>

        <form method="POST" action="{{ route('register') }}" class="mt-3">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="form-control">
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="form-control">
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input id="password" type="password" name="password" required class="form-control">
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Registar</button>
        </form>
    </div>
@endsection
