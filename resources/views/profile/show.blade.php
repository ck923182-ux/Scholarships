@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">User Dashboard</div>

                    <div class="card-body">

                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="profileTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile" type="button" role="tab">
                                    User Profile
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="account-tab" data-bs-toggle="tab" data-bs-target="#account"
                                    type="button" role="tab">
                                    Account Info
                                </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="application-tab" data-bs-toggle="tab"
                                    data-bs-target="#application" type="button" role="tab">
                                    Application
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content pt-4" id="profileTabContent">

                            <!-- User Profile Tab -->
                            <div class="tab-pane fade show active" id="profile" role="tabpanel">

                                @php
                                    $profile = $user->profile;
                                    // dd($user);
                                @endphp
                                @php
                                 if($user->role==="student"){
                                    $state = \App\Enums\State::tryFrom($profile->state);
                                    $high_school = \App\Enums\HighSchool::tryFrom($profile->high_school);

                                 }

                                @endphp
                                @if ($user)
                                    <!-- Contact Information -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            Contact Information
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Name</label>
                                                <div>{{ $user->name ?? 'Not set' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Email</label>
                                                <div>{{ $user->email ?? 'Not set' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Phone</label>
                                                <div>{{ $profile->phone ?? 'Not set' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Address Information -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            Address Information
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Street Address</label>
                                                <div>{{ $profile->street_address ?? '-' }}</div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Street Address 2</label>
                                                <div>{{ $profile->street_address_2 ?? '-' }}</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="fw-semibold">City</label>
                                                <div>{{ $profile->city ?? '-' }}</div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="fw-semibold">State</label>
                                                <div>{{ $state?->label() ?? '-' }}</div>

                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label class="fw-semibold">Zip Code</label>
                                                <div>{{ $profile->zip_code ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Education Information -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            Education Information
                                        </div>
                                        <div class="card-body row">
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">High School</label>
                                                 @if ($user->role==="student")
                                                     @if ($profile->high_school === 'OT')
                                                    <div> {{ $profile->other_high_school }}</div>
                                                @else
                                                    <div>
                                                        <div>{{ $high_school?->label() ?? '-' }}</div>

                                                    </div>
                                                @endif
                                                 @endif
                                                

                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="fw-semibold">Degree Field</label>
                                                <div>{{ $profile->degree_field ?? '-' }}</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Documents & Activities -->
                                    <div class="card shadow-sm mb-4">
                                        <div class="card-header bg-light fw-bold">
                                            Documents & Activities
                                        </div>
                                        <div class="row card-body">

                                            @if (optional($user->profile)->transcript)
                                                <div class="col-lg-4">
                                                    <p class="mb-1">Transcript</p>
                                                    <a href="{{ asset('storage/' . $user->profile->transcript) }}"
                                                        target="_blank">
                                                        View Transcript
                                                    </a>
                                                </div>
                                            @endif

                                            @if (optional($user->profile)->sar)
                                                <div class="col-lg-4">
                                                    <p class="mb-1">SAR</p>
                                                    <a href="{{ asset('storage/' . $user->profile->sar) }}"
                                                        target="_blank">
                                                        View SAR
                                                    </a>
                                                </div>
                                            @endif

                                            @if (optional($user->profile)->acceptance_letter)
                                                <div class="col-lg-4">
                                                    <p class="mb-1">Acceptance Letter</p>
                                                    <a href="{{ asset('storage/' . $user->profile->acceptance_letter) }}"
                                                        target="_blank">
                                                        View Acceptance Letter
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="row card-body">
                                            <span class="fw-semibold">School Activity</span>
                                            @if (!empty($profile->school_activity))
                                                @foreach ($profile->school_activity as $activity)
                                                    <div class="col-lg-5 my-2 border mx-3">
                                                        <h6 class="fw-bold py-2">Activity: {{ $activity['name'] }}</h6>
                                                        <small class="text-muted">Year:
                                                            {{ $activity['year'] }}</small>
                                                        <p class="mb-0">Description: {{ $activity['description'] }}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No school activities added.</p>
                                            @endif
                                        </div>
                                        <div class="row card-body">
                                            <span class="fw-semibold">Community Activity</span>
                                            @if (!empty($profile->community_activity))
                                                @foreach ($profile->community_activity as $activity)
                                                    <div class="col-lg-5 my-2 border mx-3">
                                                        <h6 class="fw-bold py-2">Activity: {{ $activity['name'] }}</h6>
                                                        <small class="text-muted">Year:
                                                            {{ $activity['year'] }}</small>
                                                        <p class="mb-0">Description: {{ $activity['description'] }}</p>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p>No school activities added.</p>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('profile.edit') }}" class="btn btn-primary rounded-pill">
                                        Edit Profile
                                    </a>
                                @else
                                    <div class="alert alert-warning">
                                        Profile information not available.
                                    </div>
                                @endif

                            </div>

                            <!-- Account Info Tab -->
                            <div class="tab-pane fade" id="account" role="tabpanel">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <strong>Username:</strong> {{ $user->name }}
                                </div>

                                <div class="mb-3">
                                    <strong>Email Verified:</strong>
                                    {{ $user->email_verified_at ? 'Yes' : 'No' }}
                                </div>

                                <form method="POST" action="{{ route('password.email') }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="email" value="{{ $user->email }}">
                                    <button type="submit" class="btn btn-warning">
                                        Send Password Reset Link
                                    </button>
                                </form>
                            </div>

                            <!-- Application Tab -->
                            <div class="tab-pane fade" id="application" role="tabpanel">
                                <div class="alert alert-info">
                                    You can manage your application settings here.
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
