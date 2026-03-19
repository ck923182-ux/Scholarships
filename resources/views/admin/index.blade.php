@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <!-- Mobile Toggle Button -->
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
                        <!-- Manage Users -->
                        <li class="nav-item mb-2">
                            <a href="{{ route('admin.manage-users') }}" class="nav-link text-white">
                                Manage Users
                            </a>
                        </li>

                        <!-- Add User With Submenu -->
                        <li class="nav-item mb-2">
                            <a class="nav-link text-white" data-bs-toggle="collapse" href="#addUserSubmenu" role="button">
                                Add User ▼
                            </a>

                            <div class="collapse ps-3" id="addUserSubmenu">
                                <ul class="nav flex-column">

                                    <li class="nav-item">
                                        <a href="{{ route('chair-register') }}" class="nav-link text-white">Create Chair</a>

                                    </li>

                                    <li class="nav-item">
                                        <a href="{{ route('member-register') }}" class="nav-link text-white">
                                            Committee Member
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('presidnet') }}" class="nav-link text-white">
                                            President
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('vicepresident') }}" class="nav-link text-white">
                                           Vice  President
                                        </a>
                                    </li>
                                   

                                    {{-- <li class="nav-item">
                                        <a href="#" class="nav-link text-white">
                                            Student
                                        </a>
                                    </li> --}}

                                </ul>
                            </div>
                        </li>

                        <!-- Scholarships -->
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                Scholarships Year
                            </a>
                        </li>
                        <!-- Scholarships -->
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                Scholarships
                            </a>
                        </li>

                        <!-- Applications -->
                        <li class="nav-item mb-2">
                            <a href="#" class="nav-link text-white">
                                Applications
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">

                <h2 class="mb-4">Admin Dashboard</h2>

                <!-- Statistics Cards -->
                <div class="row">

                    <div class="col-6 col-md-3 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5>Total Users</h5>
                                <h3>120</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5>Total Scholarships</h5>
                                <h3>15</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5>Total Applications</h5>
                                <h3>340</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3 mb-4">
                        <div class="card shadow-sm border-0">
                            <div class="card-body text-center">
                                <h5>Scholarship year</h5>
                                <h3>42</h3>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Recent Activity -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header">
                        Recent Applications
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Scholarship</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>Science Scholarship</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>02 Mar 2026</td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Arts Scholarship</td>
                                    <td><span class="badge bg-success">Approved</span></td>
                                    <td>01 Mar 2026</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
