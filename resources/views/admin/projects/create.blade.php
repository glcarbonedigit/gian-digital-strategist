@extends('layouts.admin')

@section('title', 'Nuovo progetto')

@section('content')
    <div class="admin-page">
        <div class="admin-page__header">
            <div>
                <h1>Nuovo progetto</h1>
                <p>Crea un nuovo progetto per il portfolio.</p>
            </div>

            <a href="{{ route('dashboard.projects.index') }}" class="btn btn--secondary">
                ← Torna ai progetti
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert--error">
                <strong>Controlla i campi.</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-card">
            <form action="{{ route('dashboard.projects.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
                @csrf

                @include('admin.projects.partials.form')

                <div class="admin-form__actions">
                    <button type="submit" class="btn btn--primary">Crea progetto</button>
                </div>
            </form>
        </div>
    </div>
@endsection