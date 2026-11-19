<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan & Member - VenueAccess</title>
    <link rel="stylesheet" href="{{ asset('css/styling.css') }}">
</head>
<body>

    <!-- Top Navigation Bar -->
    <header class="app-navbar">
        <div class="nav-container">
            <div class="nav-left">
                <a href="{{ route('dashboard') }}" class="nav-brand">
                    <div class="brand-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    <span>Sistem<strong>Venue</strong></span>
                </a>
                <nav class="nav-links">
                    <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                    <a href="{{ route('pelanggan.index') }}" class="nav-link active">Data Pelanggan</a>
                </nav>
            </div>

            <div class="nav-right">
                <div class="user-profile-badge">
                    <div class="user-avatar">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="user-info">
                        <span class="user-name">{{ auth()->user()->name }}</span>
                        <span class="badge-role role-{{ auth()->user()->role }}">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn-logout" title="Keluar dari sistem">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <p class="breadcrumb"><a href="{{ route('dashboard') }}">Dashboard</a> &gt; Pelanggan &amp; Member</p>
                <h1>Data Pelanggan &amp; Member</h1>
                <p>Kelola data pelanggan, level keanggotaan, dan status profil pengguna venue.</p>
            </div>
            @can('create', \App\Models\Pelanggan::class)
                <div>
                    <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Tambah Pelanggan
                    </a>
                </div>
            @endcan
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('pelanggan.index') }}">
            <div class="filter-box">
                <input type="text" name="cari" placeholder="Cari nama, email, atau no. HP..." value="{{ $cari }}">

                <select name="level">
                    <option value="">Semua Level Member</option>
                    <option value="basic" @selected($level == 'basic')>Basic</option>
                    <option value="gold" @selected($level == 'gold')>Gold</option>
                    <option value="vip" @selected($level == 'vip')>VIP</option>
                </select>

                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="aktif" @selected($status == 'aktif')>Aktif</option>
                    <option value="nonaktif" @selected($status == 'nonaktif')>Nonaktif</option>
                </select>

                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('pelanggan.index') }}" class="btn-reset">Reset</a>
            </div>
        </form>

        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Pelanggan</th>
                        <th>No. HP</th>
                        <th>Level Member</th>
                        <th>Tanggal Bergabung</th>
                        <th>Status</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pelanggan as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $p->nama }}</strong></td>
                        <td>{{ $p->no_hp }}</td>
                        <td><span class="{{ $p->level_member }}">{{ ucfirst($p->level_member) }}</span></td>
                        <td>{{ $p->tanggal_bergabung }}</td>
                        <td><span class="{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                        <td style="text-align: center;">
                            @canany(['update', 'delete'], $p)
                                @can('update', $p)
                                    <a href="{{ route('pelanggan.edit', $p) }}" style="font-weight: 600;">Ubah</a>
                                @endcan

                                @can('delete', $p)
                                    <span style="color: #cbd5e1; margin: 0 6px;">|</span>
                                    <form action="{{ route('pelanggan.destroy', $p) }}" method="POST" style="display:inline"
                                          onsubmit="return confirm('Yakin mau menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none;border:none;padding:0;font:inherit;color:#ef4444;text-decoration:underline;cursor:pointer;font-weight:600;">Hapus</button>
                                    </form>
                                @endcan
                            @else
                                <span style="color:#94a3b8; font-size: 13px;">Tidak ada akses</span>
                            @endcanany
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 32px; color: #64748b;">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>
