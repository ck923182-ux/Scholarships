@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header fw-bold">Edit Profile</div>

            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- ================= BASIC INFORMATION ================= --}}
                    <h5 class="mb-3">Basic Information</h5>

                    {{-- Row 1: Name & Email --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Row 2: Street 1 & 2 --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Street Address</label>
                            <input type="text" name="street_address" class="form-control"
                                value="{{ old('street_address', optional($user->profile)->street_address) }}">
                            @error('street_address')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Street Address 2</label>
                            <input type="text" name="street_address_2" class="form-control"
                                value="{{ old('street_address_2', optional($user->profile)->street_address_2) }}">
                        </div>
                    </div>

                    {{-- Row 3: City, State, Zip --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control"
                                value="{{ old('city', optional($user->profile)->city) }}">
                            @error('city')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select name="state" id="state" class="form-control @error('state') is-invalid @enderror">
                                <option value="">Select State</option>
                                @foreach ($states as $key => $stateName)
                                    <option value="{{ $key }}"
                                        {{ old('state', optional($user->profile)->state) == $key ? 'selected' : '' }}>
                                        {{ $stateName }}
                                    </option>
                                @endforeach
                            </select>

                            @error('state')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control"
                                value="{{ old('zip_code', optional($user->profile)->zip_code) }}">
                            @error('zip_code')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Phone --}}
                    <div class="mb-4">
                        <label class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control"
                            value="{{ old('phone', optional($user->profile)->phone) }}">
                        @error('phone')
                            <div class="invalid-feedback d-flex">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ================= EDUCATION ================= --}}
                    <h5 class="mb-3">Education</h5>

                    {{-- High School Row --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="state" class="form-label">Select High School</label>
                            <select name="high_school" id="high_school"
                                class="form-control @error('high_school') is-invalid @enderror">
                                <option value="">Select High School</option>
                                @foreach ($high_school as $key => $school)
                                    <option value="{{ $key }}"
                                        {{ old('state', optional($user->profile)->high_school) == $key ? 'selected' : '' }}>
                                        {{ $school }}
                                    </option>
                                @endforeach
                            </select>

                            @error('high_school')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6" id="other_school_container">
                            <label class="form-label">Other High School</label>
                            <input type="text" name="other_high_school" class="form-control"
                                value="{{ old('other_high_school', optional($user->profile)->other_high_school) }}">
                            @error('other_high_school')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Degree Field --}}
                    <div class="mb-3">
                        <label class="form-label">Degree Field</label>
                        <input type="text" name="degree_field" class="form-control"
                            value="{{ old('degree_field', optional($user->profile)->degree_field) }}">
                        @error('degree_field')
                            <div class="invalid-feedback d-flex">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Documents Row --}}
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Transcript</label>

                            {{-- Display existing file if it exists --}}
                            @if (optional($user->profile)->transcript)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $user->profile->transcript) }}" target="_blank">
                                        View Current Transcript
                                    </a>
                                </div>
                            @endif

                            {{-- File Input --}}
                            <input type="file" name="transcript" class="form-control">

                            @error('transcript')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="col-md-4">
                            <label class="form-label">SAR</label>
                            {{-- Display existing file if it exists --}}
                            @if (optional($user->profile)->sar)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $user->profile->sar) }}" target="_blank">
                                        View Current SAR
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="sar" class="form-control">
                            @error('sar')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Acceptance Letter</label>
                            @if (optional($user->profile)->acceptance_letter)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $user->profile->acceptance_letter) }}"
                                        target="_blank">
                                        View Current Acceptance Letter
                                    </a>
                                </div>
                            @endif
                            <input type="file" name="acceptance_letter" class="form-control">
                            @error('acceptance_letter')
                                <div class="invalid-feedback d-flex">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- School Activity Section -->
                    <div class="card mb-4">
                        <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                            <span>School Activity</span>
                            <button type="button" class="btn btn-sm btn-primary add-activity"
                                data-container="#school-activity-container">
                                + Add Row
                            </button>
                        </div>
                        <div class="card-body" id="school-activity-container">
                            @php
                                $profile = $user->profile;

                                $activities = $profile->school_activity ?? [];
                            @endphp
                            @forelse($activities as $index => $activity)
                                <div class="row activity-row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="school_activity[year][]" class="form-control"
                                            value="{{ $activity['year'] ?? '' }}" placeholder="2023">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Activity</label>
                                        <input type="text" name="school_activity[name][]" class="form-control"
                                            value="{{ $activity['name'] ?? '' }}" placeholder="Sports">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="school_activity[description][]" class="form-control"
                                            value="{{ $activity['description'] ?? '' }}" placeholder="Details">
                                    </div>

                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                                    </div>
                                </div>

                            @empty
                                {{-- If no data, show one empty row --}}
                                <div class="row activity-row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="school_activity[year][]" class="form-control"
                                            placeholder="2023">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Activity</label>
                                        <input type="text" name="school_activity[name][]" class="form-control"
                                            placeholder="Sports">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="school_activity[description][]" class="form-control"
                                            placeholder="Details">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>

                    <!-- Community Activity Section -->
                    <div class="card mb-4">
                        <div class="card-header bg-light fw-bold d-flex justify-content-between align-items-center">
                            <span>Community Activity</span>
                            <button type="button" class="btn btn-sm btn-primary add-activity"
                                data-container="#community-activity-container">
                                + Add Row
                            </button>
                        </div>
                        <div class="card-body" id="community-activity-container">

                            @php
                                $profile = $user->profile;

                                $activities = $profile->school_activity ?? [];
                            @endphp
                            @forelse($activities as $index => $activity)
                                <div class="row activity-row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="community_activity[year][]" class="form-control"
                                            value="{{ $activity['year'] ?? '' }}" placeholder="2023">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Activity</label>
                                        <input type="text" name="community_activity[name][]" class="form-control"
                                            value="{{ $activity['name'] ?? '' }}" placeholder="Sports">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="community_activity[description][]" class="form-control"
                                            value="{{ $activity['description'] ?? '' }}" placeholder="Details">
                                    </div>

                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                                    </div>
                                </div>

                            @empty
                                {{-- If no data, show one empty row --}}
                                <div class="row activity-row mb-3">
                                    <div class="col-md-3">
                                        <label class="form-label">Year</label>
                                        <input type="text" name="community_activity[year][]" class="form-control"
                                            placeholder="2023">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Activity</label>
                                        <input type="text" name="community_activity[name][]" class="form-control"
                                            placeholder="Sports">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Description</label>
                                        <input type="text" name="community_activity[description][]" class="form-control"
                                            placeholder="Details">
                                    </div>
                                    <div class="col-md-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm remove-row">&times;</button>
                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>


                    {{-- Buttons --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('profile') }}" class="btn btn-secondary">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Add Row Functionality
        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('add-activity')) {
                const containerSelector = e.target.getAttribute('data-container');
                const container = document.querySelector(containerSelector);

                // Clone the first row
                const firstRow = container.querySelector('.activity-row');
                const newRow = firstRow.cloneNode(true);

                // Clear input values in the cloned row
                newRow.querySelectorAll('input').forEach(input => input.value = '');

                // Append the new row
                container.appendChild(newRow);
            }

            // Remove Row Functionality
            if (e.target && e.target.classList.contains('remove-row')) {
                const container = e.target.closest('.card-body');
                // Ensure at least one row remains
                if (container.querySelectorAll('.activity-row').length > 1) {
                    e.target.closest('.activity-row').remove();
                } else {
                    alert('At least one activity is required.');
                }
            }
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        const highSchoolSelect = document.getElementById('high_school');
        const otherSchoolContainer = document.getElementById('other_school_container');

        function toggleOtherSchool() {
            if (highSchoolSelect.value === 'OT') {
                otherSchoolContainer.style.display = 'block';
            } else {
                otherSchoolContainer.style.display = 'none';
                otherSchoolContainer.value == "";
            }
        }

        // Run on page load
        toggleOtherSchool();

        // Run on change
        highSchoolSelect.addEventListener('change', toggleOtherSchool);
    });
</script>
