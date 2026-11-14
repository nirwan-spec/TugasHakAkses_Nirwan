<?php


namespace App\Policies;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PelangganPolicy
{
    // Boleh membuka halaman daftar?
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'staff'], true);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'staff'], true);
    }

      public function update(User $user, Pelanggan $pelanggan): bool|Response
    {
        if ($user->role === 'admin') {
            return true;
        }

        if ($user->role === 'staff' && $pelanggan->status === 'aktif') {
            return true;
        }

        return Response::deny('Staff hanya boleh mengubah data pelanggan yang berstatus aktif.');
    }

    public function delete(User $user, Pelanggan $pelanggan): bool|Response
    {
        return $user->role === 'admin'
            ? true
            : Response::deny('Hanya admin yang boleh menghapus data pelanggan.');
    }
}