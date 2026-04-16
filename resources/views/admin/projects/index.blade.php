@extends('layouts.admin')

@section('title', 'Progetti')

@section('content')
    <div class="admin-page">
        <div class="admin-page__header">
            <div>
                <h1>Progetti</h1>
                <p>Gestisci i progetti del portfolio.</p>
            </div>

            <a href="{{ route('dashboard.projects.create') }}" class="btn btn--primary">
                + Nuovo progetto
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert--success">
                {{ session('success') }}
            </div>
        @endif

        <div class="admin-card">
            @if($projects->count())
                <div class="projects-table-wrap">
                    <table class="projects-table">
                        <thead>
                            <tr>
                                <th>Immagine</th>
                                <th>Titolo</th>
                                <th>Cliente</th>
                                <th>Categoria</th>
                                <th>Slug</th>
                                <th>In evidenza</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>
                                        @if($project->cover_image)
                                            <img class="projects-thumb" src="{{ asset('storage/' . $project->cover_image) }}" alt="{{ $project->title }}">
                                        @else
                                            <div class="projects-thumb projects-thumb--placeholder">—</div>
                                        @endif
                                    </td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->client_name }}</td>
                                    <td>{{ $project->category }}</td>
                                    <td>{{ $project->slug }}</td>
                                    <td>{{ $project->is_featured ? 'Sì' : 'No' }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('dashboard.projects.edit', $project) }}" class="btn btn--sm btn--secondary">
                                                Modifica
                                            </a>

                                            <form action="{{ route('dashboard.projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Vuoi eliminare questo progetto?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn--sm btn--danger">
                                                    Elimina
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <h2>Nessun progetto presente</h2>
                    <p>Inizia creando il primo progetto del portfolio.</p>
                    <a href="{{ route('dashboard.projects.create') }}" class="btn btn--primary">
                        Crea il primo progetto
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection