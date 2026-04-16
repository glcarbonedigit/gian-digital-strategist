<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectAdminController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()
            ->latest()
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'gallery_media' => ['nullable', 'array'],
            'gallery_media.*' => ['file', 'mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime', 'max:51200'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        DB::transaction(function () use ($request, $validated) {
            $projectData = $validated;
            unset($projectData['gallery_media']);

            if ($request->hasFile('cover_image')) {
                $projectData['cover_image'] = $request->file('cover_image')->store('projects', 'public');
            }

            $project = Project::create($projectData);

            if ($request->hasFile('gallery_media')) {
                foreach ($request->file('gallery_media') as $index => $file) {
                    $this->storeGalleryMediaFile($project, $file, $index);
                }
            }
        });

        return redirect()
            ->route('dashboard.projects.index')
            ->with('success', 'Progetto creato correttamente.');
    }

    public function edit(Project $project): View
    {
        $project->load([
            'images' => fn ($query) => $query->orderBy('sort_order')->orderBy('id'),
        ]);

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug,' . $project->id],
            'client_name' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'project_url' => ['nullable', 'url'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'gallery_media' => ['nullable', 'array'],
            'gallery_media.*' => ['file', 'mimetypes:image/jpeg,image/png,image/webp,video/mp4,video/webm,video/quicktime', 'max:51200'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        DB::transaction(function () use ($request, $project, $validated) {
            $projectData = $validated;
            unset($projectData['gallery_media']);

            if ($request->hasFile('cover_image')) {
                if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
                    Storage::disk('public')->delete($project->cover_image);
                }

                $projectData['cover_image'] = $request->file('cover_image')->store('projects', 'public');
            }

            $project->update($projectData);

            if ($request->hasFile('gallery_media')) {
                $currentMaxOrder = (int) ($project->images()->max('sort_order') ?? -1);

                foreach ($request->file('gallery_media') as $index => $file) {
                    $this->storeGalleryMediaFile($project, $file, $currentMaxOrder + $index + 1);
                }
            }
        });

        return redirect()
            ->route('dashboard.projects.index')
            ->with('success', 'Progetto aggiornato correttamente.');
    }

    public function destroyCover(Project $project): RedirectResponse
    {
        if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }

        $project->update([
            'cover_image' => null,
        ]);

        return back()->with('success', 'Immagine di copertina rimossa correttamente.');
    }

    public function destroyImage(Project $project, ProjectImage $image): RedirectResponse
    {
        if ($image->project_id !== $project->id) {
            abort(404);
        }

        $this->deleteGalleryMediaFiles($image);
        $image->delete();

        $remainingImages = $project->images()->orderBy('sort_order')->get();

        foreach ($remainingImages as $index => $remainingImage) {
            $remainingImage->update([
                'sort_order' => $index,
            ]);
        }

        return back()->with('success', 'Media eliminato correttamente.');
    }

    public function reorderImages(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'image_order' => ['required', 'array', 'min:1'],
            'image_order.*' => ['integer'],
        ]);

        $projectImageIds = $project->images()->pluck('id')->map(fn ($id) => (int) $id)->all();
        $submittedIds = collect($validated['image_order'])->map(fn ($id) => (int) $id)->all();

        sort($projectImageIds);
        $sortedSubmittedIds = $submittedIds;
        sort($sortedSubmittedIds);

        if ($projectImageIds !== $sortedSubmittedIds) {
            abort(422, 'Ordine media non valido.');
        }

        DB::transaction(function () use ($validated, $project) {
            foreach ($validated['image_order'] as $index => $imageId) {
                $project->images()
                    ->where('id', $imageId)
                    ->update([
                        'sort_order' => $index,
                    ]);
            }
        });

        return back()->with('success', 'Ordine gallery aggiornato correttamente.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->cover_image && Storage::disk('public')->exists($project->cover_image)) {
            Storage::disk('public')->delete($project->cover_image);
        }

        foreach ($project->images as $image) {
            $this->deleteGalleryMediaFiles($image);
        }

        $project->delete();

        return redirect()
            ->route('dashboard.projects.index')
            ->with('success', 'Progetto eliminato correttamente.');
    }

    private function storeGalleryMediaFile(Project $project, $file, int $sortOrder): void
    {
        $mime = $file->getMimeType();

        if (str_starts_with($mime, 'image/')) {
            $path = $file->store('projects/gallery', 'public');

            $project->images()->create([
                'image_path' => $path,
                'video_path' => null,
                'media_type' => 'image',
                'sort_order' => $sortOrder,
            ]);

            return;
        }

        if (str_starts_with($mime, 'video/')) {
            $path = $file->store('projects/gallery/videos', 'public');

            $project->images()->create([
                'image_path' => null,
                'video_path' => $path,
                'media_type' => 'video',
                'sort_order' => $sortOrder,
            ]);
        }
    }

    private function deleteGalleryMediaFiles(ProjectImage $image): void
    {
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        if ($image->video_path && Storage::disk('public')->exists($image->video_path)) {
            Storage::disk('public')->delete($image->video_path);
        }
    }
}