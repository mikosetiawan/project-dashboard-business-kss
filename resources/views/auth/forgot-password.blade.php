<x-guest-layout>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <div class="d-flex flex-column align-items-center text-center my-3">
                                            <a href="/">
                                                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                                            </a>

                                        </div>
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    {{-- <form class="user"> --}}
                                    <form method="POST" name="user" action="{{ route('password.email') }}">
                                        @csrf

                                        <div class="form-group">
                                            {{-- <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..."> --}}
                                                <x-text-input id="email" class="form-control form-control-user" type="email" name="email" :value="old('email')" required autofocus />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                        {{-- <a href="" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </a> --}}
                                        <button type="submit" class="btn btn-primary btn-user btn-block">{{ __('Reset Password') }}</button>
                                    </form>
                                    <hr>
                                    {{-- <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Create an Account!</a>
                                    </div> --}}
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">Already have an account?
                                            Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-guest-layout>
