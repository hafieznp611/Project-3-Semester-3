<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;


class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $category = $request->query('category');
        $search = $request->query('search');
        $sort = $request->query('sort', 'terbaru');

        $activities = Activity::query()
            ->with('category')
            ->filterStatus($status)
            ->filterCategory($category)
            ->filterSearch($search)
            ->when($sort === 'terbaru', fn ($q) => $q->orderBy('start_at', 'desc'))
            ->when($sort === 'terlama', fn ($q) => $q->orderBy('start_at', 'asc'))
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', [
            'activities' => $activities,
            'selectedStatus' => $status,
            'selectedCategory' => $category,
            'selectedSort' => $sort,
        ]);
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('activities.create', compact('categories'));
    }

    public function store(StoreActivityRequest $request, ActivityService $service): RedirectResponse
    {
        $activity = $service->create($request->validated(), $request->file('poster'));

        return to_route('activities.show', $activity)->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        $categories = Category::all();

        return view('activities.edit', compact('activity', 'categories'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->update($activity, $request->validated(), $request->file('poster'));
        } catch (DomainException $exception) {
            return back()->withErrors(['status' => $exception->getMessage()])->withInput();
        }

        return to_route('activities.show', $activity)->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    public function restore(Activity $activity): RedirectResponse
    {
        $activity->restore();

        return to_route('activities.trash')
            ->with('success', 'Kegiatan berhasil dipulihkan.');
    }

    public function trash(): View
    {
        $activities = Activity::onlyTrashed()->paginate(10);

        return view('activities.trash', compact('activities'));
    }

    
}




