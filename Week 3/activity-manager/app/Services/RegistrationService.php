<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use DomainException;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    public function register(Activity $activity, array $data): Registration
    {
        // IC-01
        if ($activity->status !== 'Published') {
            throw new DomainException('Tidak dapat mendaftar: kegiatan belum dipublikasikan.');
        }

        // IC-02
        if ($activity->start_at->isPast()) {
            throw new DomainException('Kegiatan sudah dimulai, pendaftaran ditutup.');
        }

        // IC-03: tolak jika email sudah terdaftar di kegiatan ini
        if ($activity->registrations()->where('email', $data['email'])->exists()) {
            throw new DomainException('Email ini sudah terdaftar pada kegiatan ini.');
        }

        // IC-04
        if ($activity->registered_count >= $activity->capacity) {
            throw new DomainException('Kuota peserta sudah penuh.');
        }

        // IC-05 & IC-06
        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }
}