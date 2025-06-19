    <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->
    <x-guest-layout>
    <section style="background: #dee7ff; width: 100%; margin-top: -2%;">
        <div class="row">
            <div class="container">
                <div class="col-lg-12">
                    <div class="card" style="width: 460px; margin: 6% auto; border: none; background:rgba(255, 255, 255, 1);">
                        <div class="card-header text-center p-3" style="border: none;">
                            <h3 style="font-weight: bold;">Login Todo App</h3>
                        </div>

                        <div class="card-body">
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-3 text-danger" :status="session('status')" />

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="form-control mt-1"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
                                </div>

                                <!-- Remember Me -->
                                <div class="form-check mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="form-check">
                                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                            <label class="form-check-label" for="remember_me">
                                                {{ __('Remember me') }}
                                            </label>
                                        </div>

                                        @if (Route::has('password.request'))
                                            <a class="text-decoration-none small text-muted" href="#">
                                                {{ __('Forgot your password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <x-primary-button class="btn btn-primary btn-block w-100">
                                        {{ __('Log in') }}
                                    </x-primary-button>

                                    <span class="text-center pt-2">Dont Have an account?<a class="text-decoration-none small text-muted text-center" href="{{ route('register') }}">
                                        Sign Up
                                    </a></span>
                                </div>
                                
                            </form>
                        </div>

                        <div class="card-footer text-center text-muted small" style="border: none;">
                            &copy; {{ date('Y') }} Todo App
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
