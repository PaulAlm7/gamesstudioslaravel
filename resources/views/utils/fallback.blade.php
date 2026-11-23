@extends('layouts.fo')

@section('content')
    <div class="mt-4">
        <h4>Página não encontrada</h4>
        <p>Estás perdido? Volta <a href="{{ route('studios.all') }}">aqui</a> para ver os estúdios.</p>
    </div>
@endsection
