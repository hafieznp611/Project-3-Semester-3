<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Http\Requests\StoreRegistrationRequest;
use App\Services\RegistrationService;
use DomainException;
use Illuminate\Http\RedirectResponse;

class RegistrationController extends Controller
{
    public function store(
        StoreRegistrationRequest $request,
        Activity $activity,              
        RegistrationService $service      
    ): RedirectResponse {
        try {
            $service->register($activity, $request->validated());
        } catch (DomainException $exception) {
            return back()
                ->withErrors(['registration' => $exception->getMessage()])
                ->withInput();
        }
        return to_route('activities.show', $activity)->with('success', 'Pendaftaran berhasil.');
    }
}