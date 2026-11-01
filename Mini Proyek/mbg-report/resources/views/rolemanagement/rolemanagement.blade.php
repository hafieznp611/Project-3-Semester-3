@extends('layouts.app')

@section('title', 'Kelola Role')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link rel="stylesheet" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('css/rolemanagement.css') }}">
@endpush

@section('content')
    <header class="topbar">
        <div class="topbar-brand">🍱 MBG Report</div>
        <div class="topbar-user">
            <a href="{{ route('dashboard') }}" class="link-back">← Dashboard</a>
        </div>
    </header>

    <main class="container role-page">
        <div class="page-head">
            <h2>Kelola Role Pengguna</h2>
            <p class="subtitle">Ubah peran akun complainant dan reviewer. Akun admin tidak dapat diubah dari sini.</p>
        </div>

        @if (session('status'))
            <div class="ok">{{ session('status') }}</div>
        @endif

        @error('role')
            <div class="err">{{ $message }}</div>
        @enderror

        <div class="panel">
            <div class="table-wrap">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Ubah ke</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="col-id">{{ $user->id }}</td>
                                <td class="col-username">{{ $user->username }}</td>
                                <td class="col-name">{{ $user->nama_lengkap }}</td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">{{ $user->role }}</span>
                                </td>
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="kecil">
                                            {{ $user->is(auth()->user()) ? 'Akun kamu' : 'Admin' }} (tidak dapat diubah)
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.users.role.update', $user) }}"
                                              class="role-form">
                                            @csrf
                                            @method('PATCH')

                                            <select name="role" aria-label="Role untuk {{ $user->nama_lengkap }}">
                                                <option value="complainant" @selected($user->role === 'complainant')>Complainant</option>
                                                <option value="reviewer" @selected($user->role === 'reviewer')>Reviewer</option>
                                            </select>

                                            <button type="submit" onclick="return confirm('Ubah role pengguna ini?')">Simpan</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (method_exists($users, 'hasPages') && $users->hasPages())
                <div class="my-pagination">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </main>
@endsection