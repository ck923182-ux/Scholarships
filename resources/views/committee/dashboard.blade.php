@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 text-primary">Committee Dashboard</h2>
                    <p class="text-muted mb-0">Manage and review student scholarship applications.</p>
                </div>
                <div>
                    @php
                        $roleClass = match($user->role->value) {
                            'community-chair' => 'bg-primary',
                            'community-member' => 'bg-success',
                            'president' => 'bg-warning text-dark',
                            'vice-president' => 'bg-info text-dark',
                            default => 'bg-secondary'
                        };
                    @endphp
                    <span class="badge {{ $roleClass }} px-4 py-2 fs-6">
                        {{ ucwords(str_replace('-', ' ', $user->role->value)) }} Access
                    </span>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 text-dark fw-bold">Recent Applications</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">Student Name</th>
                                    <th>Scholarship</th>
                                    <th>Submission Date</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                    {{-- Placeholder for future application data --}}
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="bi bi-file-earmark-text display-4 mb-3 d-block"></i>
                                                <h5>No applications available to review</h5>
                                                <p>When students submit their applications, they will appear here.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Dashboard Stats for Committee -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm bg-primary text-white h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-people fs-1 mb-2 d-block"></i>
                            <h3 class="fw-bold mb-1">0</h3>
                            <p class="mb-0 opacity-75">Pending Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm bg-success text-white h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-check-circle fs-1 mb-2 d-block"></i>
                            <h3 class="fw-bold mb-1">0</h3>
                            <p class="mb-0 opacity-75">Approved Applications</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm bg-info text-white h-100">
                        <div class="card-body text-center p-4">
                            <i class="bi bi-trophy fs-1 mb-2 d-block"></i>
                            <h3 class="fw-bold mb-1">0</h3>
                            <p class="mb-0 opacity-75">Awarded Scholarships</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .card { border-radius: 15px; overflow: hidden; }
    .table thead th { font-weight: 600; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 0.05em; }
    .badge { border-radius: 6px; }
</style>
@endsection
