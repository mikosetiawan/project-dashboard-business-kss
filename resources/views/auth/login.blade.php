<x-guest-layout>
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    {{-- <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1> --}}
                                    <div class="d-flex flex-column align-items-center text-center">
                                        <a href="/">
                                            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                                        </a>
                                        <h3>PT Krakatau Samudera Solusi</h3>
                                        <p>#TumbuhMajuSejahtera</p>
                                    </div>
                                    {{-- <form class="user"> --}}
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            {{-- <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."> --}}
                                            <x-text-input :placeholder="'Type in email'" id="email" class="form-control form-control-user"
                                                aria-describedby="emailHelp" type="email" name="email"
                                                :value="old('email')" required autofocus autocomplete="username" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        <div class="form-group">
                                            {{-- <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password"> --}}
                                            <x-text-input :placeholder="'Type in password'" id="password" class="form-control form-control-user"
                                                type="password" name="password" required
                                                autocomplete="current-password" />
                                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="remember_me" class="inline-flex items-center">
                                                <input id="remember_me" type="checkbox"
                                                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                                    name="remember">
                                                <span
                                                    class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                            </label>
                                        </div>
                                        {{-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a> --}}
                                        <button type="submit"
                                            class="btn btn-primary btn-user btn-block">{{ __('Login') }}</button>
                                        <hr>
                                        {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a> --}}
                                    </form>
                                    {{-- <hr> --}}
                                    {{-- <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Forgot Password?</a>
                                    </div> --}}
                                    @if (Route::has('password.request'))
                                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif
                                    {{-- <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-guest-layout>
