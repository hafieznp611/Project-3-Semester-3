@extends('layouts.app')

@section('title', 'Kelola Role')

@section('content')
    <h3>Kelola Role Pengguna</h3>

    @if (session('status'))
        <div class="ok">{{ session('status') }}</div>
    @endif

    @error('role')
        <div class="err">{{ $message }}</div>
    @enderror

    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; background:#fff;">
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
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        @if ($user->role === 'admin')
                            <span class="kecil">
                                {{ $user->is(auth()->user()) ? 'Akun kamu' : 'Admin' }} (tidak dapat diubah)
                            </span>
                        @else
                            <form method="POST"
                                  action="{{ route('admin.users.role.update', $user) }}"
                                  style="display:flex; gap:.5rem;">
                                @csrf
                                @method('PATCH')

                                <select name="role">
                                    <option value="customer" @selected($user->role === 'customer')>customer</option>
                                    <option value="staff" @selected($user->role === 'staff')>staff</option>
                                    <option value="admin" @selected($user->role === 'admin')>admin</option>
                                </select>

                                <button type="submit">Simpan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection