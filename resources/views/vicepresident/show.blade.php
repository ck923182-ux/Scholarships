@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">President</h3>
        <a href="{{ route('vicepresident-register') }}" class="btn btn-primary">Add Vice President</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row g-2 mb-3">
                <div class="col-md-6">
                    <input id="searchInput" type="text" class="form-control" placeholder="Search by name or email">
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="chairTable">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $u)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $u->name }}</td>
                                <td><span class="text-muted">{{ $u->email }}</span></td>
                                <td>{{ optional($u->created_at)->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('vicepresident.edit', $u) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('vicepresident.destroy', $u) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Delete this Vice Presidnet?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No President found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('searchInput')?.addEventListener('input', function () {
    const term = this.value.toLowerCase();
    const rows = document.querySelectorAll('#chairTable tbody tr');
    rows.forEach(row => {
        const name = row.children[1]?.textContent.toLowerCase() || '';
        const email = row.children[2]?.textContent.toLowerCase() || '';
        row.style.display = (name.includes(term) || email.includes(term)) ? '' : 'none';
    });
});
</script>
@endsection
