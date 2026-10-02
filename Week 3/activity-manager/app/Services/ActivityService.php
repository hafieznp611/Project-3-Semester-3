<?php

namespace App\Services;

use App\Models\Activity;
use DomainException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ActivityService
{
    private const TRANSITIONS = [
    'Draft' => ['Draft', 'Published'],
    'Published' => ['Published', 'Completed'],
    'Completed' => ['Completed'],
]   ;

    public function create(array $data, ?UploadedFile $poster = null): Activity
    {
        if ($poster) {
            $data['poster_path'] = $poster->store('posters', 'public');
        }

        return Activity::create($data);
    }

    public function update(Activity $activity, array $data, ?UploadedFile $poster = null): Activity
    {
        $nextStatus = $data['status'] ?? $activity->status;
        $this->ensureValidTransition($activity->status, $nextStatus);

        if ($nextStatus === 'Published' && $activity->status === 'Draft') {
            $this->ensureReadyToStart($activity, $data);
        }

        if ($poster) {
            $data['poster_path'] = $this->replacePoster($activity, $poster);
        }

        $activity->update($data);

        return $activity->refresh();
    }

    private function replacePoster(Activity $activity, UploadedFile $poster): string
    {
        $newPath = $poster->store('posters', 'public');

        if ($activity->poster_path) {
            Storage::disk('public')->delete($activity->poster_path);
        }

        return $newPath;
    }

    private function ensureValidTransition(string $current, string $next): void
    {
        $allowed = self::TRANSITIONS[$current] ?? [];

        if (! in_array($next, $allowed, true)) {
            throw new DomainException(
                "Transisi status {$current} ke {$next} tidak diizinkan."
            );
        }
    }

    private function ensureReadyToStart(Activity $activity, array $data): void
    {
        $missing = collect([
            'kategori' => $data['category_id'] ?? $activity->category_id,
            'kode' => $data['code'] ?? $activity->code,
            'judul' => $data['title'] ?? $activity->title,
            'lokasi' => $data['location'] ?? $activity->location,
            'tanggal mulai' => $data['start_at'] ?? $activity->start_at,
            'tanggal selesai' => $data['end_at'] ?? $activity->end_at,
            'kapasitas' => $data['capacity'] ?? $activity->capacity,
        ])->filter(fn ($value) => empty($value))->keys();

        if ($missing->isNotEmpty()) {
            throw new DomainException(
                'Lengkapi terlebih dahulu: '.$missing->implode(', ').'.'
            );
        }
    }
}
