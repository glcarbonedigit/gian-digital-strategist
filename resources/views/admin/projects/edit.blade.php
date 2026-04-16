@extends('layouts.admin')

@section('title', 'Modifica progetto')

@section('content')
    <div class="admin-page">
        <div class="admin-page__header">
            <div>
                <h1>Modifica progetto</h1>
                <p>Aggiorna i dettagli del progetto selezionato.</p>
            </div>

            <a href="{{ route('dashboard.projects.index') }}" class="btn btn--secondary">
                ← Torna ai progetti
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert--success admin-alert-spaced">
                {{ session('success') }}
            </div>
        @endif

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
            <form action="{{ route('dashboard.projects.update', $project) }}" method="POST" enctype="multipart/form-data" class="admin-form">
                @csrf
                @method('PUT')

                @include('admin.projects.partials.form', ['project' => $project])

                <div class="admin-form__actions">
                    <button type="submit" class="btn btn--primary">Salva modifiche</button>
                    <a href="{{ route('dashboard.projects.index') }}" class="btn btn--ghost">Annulla</a>
                </div>
            </form>
        </div>

        @if($project->images->count())
            <div class="admin-card admin-card--spaced">
                <div class="admin-section-head">
                    <h2>Ordina gallery</h2>
                    <p>Trascina le immagini per modificare l’ordine nel progetto.</p>
                </div>

                <form
                    action="{{ route('dashboard.projects.images.reorder', $project) }}"
                    method="POST"
                    id="gallery-reorder-form"
                >
                    @csrf

                    <div id="sortable-gallery" class="admin-sortable-gallery">
                        @foreach($project->images as $image)
    <div
        class="sortable-gallery-item"
        draggable="true"
        data-image-id="{{ $image->id }}"
    >
        <input type="hidden" name="image_order[]" value="{{ $image->id }}">

        <div class="sortable-gallery-item__top">
            <strong>Trascina</strong>
            <span>#{{ $loop->iteration }}</span>
        </div>

        @if($image->media_type === 'video' && $image->video_path)
            <video class="sortable-gallery-item__image" controls preload="metadata">
                <source src="{{ asset('storage/' . $image->video_path) }}">
            </video>
        @else
            <img
                src="{{ asset('storage/' . $image->image_path) }}"
                alt="{{ $project->title }}"
                class="sortable-gallery-item__image"
            >
        @endif
    </div>
@endforeach
                    </div>

                    <div class="admin-sortable-gallery__actions">
                        <button type="submit" class="btn btn--primary">Salva ordine gallery</button>
                    </div>
                </form>
            </div>
        @endif

        @if($project->cover_image)
            <form
                id="delete-cover-form"
                action="{{ route('dashboard.projects.cover.destroy', $project) }}"
                method="POST"
                class="admin-hidden-form"
            >
                @csrf
                @method('DELETE')
            </form>
        @endif

        @foreach($project->images as $image)
            <form
                id="delete-image-form-{{ $image->id }}"
                action="{{ route('dashboard.projects.images.destroy', [$project, $image]) }}"
                method="POST"
                class="admin-hidden-form"
            >
                @csrf
                @method('DELETE')
            </form>
        @endforeach
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('sortable-gallery');
            if (!container) return;

            let draggedItem = null;

            const refreshOrderLabels = () => {
                const items = container.querySelectorAll('.sortable-gallery-item');
                items.forEach((item, index) => {
                    const label = item.querySelector('.sortable-gallery-item__top span');
                    if (label) {
                        label.textContent = `#${index + 1}`;
                    }
                });
            };

            container.querySelectorAll('.sortable-gallery-item').forEach((item) => {
                item.addEventListener('dragstart', function () {
                    draggedItem = item;
                    item.classList.add('is-dragging');
                });

                item.addEventListener('dragend', function () {
                    item.classList.remove('is-dragging');
                    draggedItem = null;
                    refreshOrderLabels();
                });

                item.addEventListener('dragover', function (event) {
                    event.preventDefault();
                });

                item.addEventListener('drop', function (event) {
                    event.preventDefault();

                    if (!draggedItem || draggedItem === item) return;

                    const items = Array.from(container.querySelectorAll('.sortable-gallery-item'));
                    const draggedIndex = items.indexOf(draggedItem);
                    const targetIndex = items.indexOf(item);

                    if (draggedIndex < targetIndex) {
                        item.after(draggedItem);
                    } else {
                        item.before(draggedItem);
                    }
                });
            });
        });
    </script>
@endsection