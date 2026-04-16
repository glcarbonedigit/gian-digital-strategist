<div class="form-grid">
    <div class="form-group">
        <label for="title">Titolo</label>
        <input type="text" name="title" id="title" value="{{ old('title', $project->title ?? '') }}" required>
    </div>

    <div class="form-group">
        <label for="slug">Slug</label>
        <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug ?? '') }}">
    </div>

    <div class="form-group">
        <label for="client_name">Cliente</label>
        <input type="text" name="client_name" id="client_name" value="{{ old('client_name', $project->client_name ?? '') }}">
    </div>

    <div class="form-group">
        <label for="category">Categoria</label>
        <input type="text" name="category" id="category" value="{{ old('category', $project->category ?? '') }}">
    </div>

    <div class="form-group form-group--full">
        <label for="excerpt">Excerpt</label>
        <textarea name="excerpt" id="excerpt" rows="3">{{ old('excerpt', $project->excerpt ?? '') }}</textarea>
    </div>

    <div class="form-group form-group--full">
        <label for="content">Contenuto</label>
        <textarea name="content" id="content" rows="8">{{ old('content', $project->content ?? '') }}</textarea>
    </div>

    <div class="form-group">
        <label for="project_url">URL progetto</label>
        <input type="url" name="project_url" id="project_url" value="{{ old('project_url', $project->project_url ?? '') }}">
    </div>

    <div class="form-group">
        <label for="is_featured">In evidenza</label>
        <div class="admin-checkbox-row">
            <input type="hidden" name="is_featured" value="0">
            <input
                type="checkbox"
                name="is_featured"
                id="is_featured"
                value="1"
                {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}
                class="admin-checkbox-row__input"
            >
            <span>Mostra tra i progetti in evidenza</span>
        </div>
    </div>

    <div class="form-group form-group--full">
        <label for="cover_image">Immagine copertina</label>
        <input type="file" name="cover_image" id="cover_image" accept=".jpg,.jpeg,.png,.webp">

        @if(!empty($project?->cover_image))
            <div class="admin-cover-preview">
                <p class="admin-cover-preview__label">Immagine attuale</p>
                <img
                    src="{{ asset('storage/' . $project->cover_image) }}"
                    alt="{{ $project->title }}"
                    class="admin-cover-preview__image"
                >

                <div class="admin-cover-preview__actions">
                    <button
                        type="submit"
                        form="delete-cover-form"
                        class="admin-gallery-card__delete"
                        onclick="return confirm('Vuoi rimuovere la copertina?')"
                    >
                        Rimuovi copertina
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="gallery_media">Gallery progetto</label>
    <input
        type="file"
        name="gallery_media[]"
        id="gallery_media"
        multiple
        accept=".jpg,.jpeg,.png,.webp,.mp4,.webm,.mov"
    >
    <small>Puoi selezionare immagini e video.</small>
</div>

@if(!empty($project?->images) && $project->images->count())
    <div class="form-group admin-gallery-block">
        <label>Gallery attuale</label>

        <div class="admin-gallery-grid">
            @foreach($project->images as $image)
                <div class="admin-gallery-card">
                    @if($image->media_type === 'video' && $image->video_path)
                        <video class="admin-gallery-card__image" controls preload="metadata">
                            <source src="{{ asset('storage/' . $image->video_path) }}">
                        </video>
                    @else
                        <img
                            src="{{ asset('storage/' . $image->image_path) }}"
                            alt="{{ $project->title }}"
                            class="admin-gallery-card__image"
                        >
                    @endif

                    <div class="admin-gallery-card__meta">
                        <span>{{ $image->media_type === 'video' ? 'Video' : 'Immagine' }}</span>
                    </div>

                    <div class="admin-gallery-card__actions">
                        <button
                            type="submit"
                            form="delete-image-form-{{ $image->id }}"
                            class="admin-gallery-card__delete"
                            onclick="return confirm('Vuoi eliminare questo elemento?')"
                        >
                            Elimina elemento
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif