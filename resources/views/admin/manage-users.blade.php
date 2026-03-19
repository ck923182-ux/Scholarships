@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Toggle for Mobile -->
        <div class="d-md-none bg-dark text-white p-2">
            <button class="btn btn-light btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                ☰ Menu
            </button>
        </div>

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-dark p-0 collapse d-md-block" id="sidebarMenu">
            <div class="p-3 text-white min-vh-100">
                <h4 class="text-center">Admin Panel</h4>
                <hr class="bg-light">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a href="{{ route('dashboard') }}" class="nav-link text-white">Dashboard</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="{{ route('admin.manage-users') }}" class="nav-link text-white active bg-primary">Manage Users</a>
                    </li>
                    <!-- Add User With Submenu -->
                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" data-bs-toggle="collapse" href="#addUserSubmenu" role="button">
                            Add User ▼
                        </a>
                        <div class="collapse ps-3" id="addUserSubmenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('chair-register') }}" class="nav-link text-white small">Create Chair</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('member-register') }}" class="nav-link text-white small">Committee Member</a>
                                </li>
                                <!-- Add other user creation links if available -->
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="m-0">Manage Users</h2>
                <div>
                    <span class="badge bg-info text-dark">Community Chairs, Members, Presidents & Vice Presidents</span>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0 text-primary">User Directory</h5>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="userSearch" class="form-control form-control-sm" placeholder="Search users...">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" id="usersTable">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">User</th>
                                    <th>Role</th>
                                    <th>Joined</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; font-weight: bold;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                                    <small class="text-muted">{{ $user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $roleClass = match($user->role->value) {
                                                    'community-chair' => 'bg-primary',
                                                    'community-member' => 'bg-success',
                                                    'president' => 'bg-warning text-dark',
                                                    'vice-president' => 'bg-info text-dark',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $roleClass }} px-3 py-2">
                                                {{ ucwords(str_replace('-', ' ', $user->role->value)) }}
                                            </span>
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                                        <td class="text-end pe-4">
                                            <div class="btn-group shadow-sm">
                                                <a href="{{ route('admin.impersonate', $user) }}" class="btn btn-sm btn-outline-primary" title="Switch User">
                                                    <i class="bi bi-people-fill"></i> Switch User
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-people display-4 mb-3 d-block"></i>
                                                <h5>No users found</h5>
                                                <p>Try creating a new community chair or member.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('userSearch');
        const table = document.getElementById('usersTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('keyup', function() {
            const filter = searchInput.value.toLowerCase();
            for (let i = 1; i < rows.length; i++) {
                const text = rows[i].textContent.toLowerCase();
                rows[i].style.display = text.includes(filter) ? '' : 'none';
            }
        });
    });
</script>

<style>
    .avatar-sm { font-size: 1.2rem; }
    .nav-link.active { font-weight: bold; border-radius: 4px; }
    .table thead th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; border-top: none; }
    .card { border-radius: 12px; }
    .btn-outline-primary:hover { transform: translateY(-1px); }
</style>
@endsection
