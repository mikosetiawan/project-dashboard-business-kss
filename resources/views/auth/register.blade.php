@extends('layouts.app')

@section('content')
    <div id="wrapper" class="w-100">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column w-100">
            <div id="content" class="flex-grow-1">
                @include('layouts.topbar')
                <div class="container-fluid p-3 p-md-4">
                    <div
                        class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Register</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="dashboard-container">
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Register</h2>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf

                                        <div class="row">
                                            <!-- Name -->
                                            <div class="col-6 mb-4">
                                                <label for="name"
                                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">Name</label>
                                                <input id="name" class="form-control mt-1 block w-full" type="text"
                                                    name="name" value="{{ old('name') }}" required autofocus
                                                    autocomplete="name" />
                                                @error('name')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Email Address -->
                                            <div class="col-6 mb-4">
                                                <label for="email"
                                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                                                <input id="email" class="form-control mt-1 block w-full" type="email"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="username" />
                                                @error('email')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="col-6 mb-4">
                                                <label for="password"
                                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">Password</label>
                                                <input id="password" class="form-control mt-1 block w-full" type="password"
                                                    name="password" required autocomplete="new-password" />
                                                @error('password')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="col-6 mb-4">
                                                <label for="password_confirmation"
                                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">Confirm
                                                    Password</label>
                                                <input id="password_confirmation" class="form-control mt-1 block w-full"
                                                    type="password" name="password_confirmation" required
                                                    autocomplete="new-password" />
                                            </div>

                                            <!-- Role -->
                                            <div class="col-6 mb-4">
                                                <label for="role"
                                                    class="block font-medium text-sm text-gray-700 dark:text-gray-300">Role</label>
                                                <select id="role" name="role"
                                                    class="form-control mt-1 block w-full">
                                                    <option value="staff_operator"
                                                        {{ old('role') == 'staff_operator' ? 'selected' : '' }}>Staff
                                                        Operator</option>
                                                    <option value="staff_admin"
                                                        {{ old('role') == 'staff_admin' ? 'selected' : '' }}>Staff Admin
                                                    </option>
                                                    <option value="superadmin_ti"
                                                        {{ old('role') == 'superadmin_ti' ? 'selected' : '' }}>Superadmin TI
                                                    </option>
                                                </select>
                                                @error('role')
                                                    <span class="text-danger text-sm">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-end mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    @include('components.logout')
    
@endsection
