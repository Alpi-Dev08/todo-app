<x-guest-layout>
    <section class="min-vh-90 d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">
                    <div class="card border-0 shadow" style="border:1px solid #dee7ff;">
                        <div class="card-header text-center p-4 border-0">
                            <h3 class="fw-bold">Registration</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <x-input-label for="name" :value="__('Name')" />
                                    <x-text-input id="name" class="form-control mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger" />
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="form-control mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger" />
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="password" :value="__('Password')" />
                                    <x-text-input id="password" class="form-control mt-1" type="password" name="password" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger" />
                                </div>

                                <div class="mb-3">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                    <x-text-input id="password_confirmation" class="form-control mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger" />
                                </div>

                                <div class="d-grid">
                                    <x-primary-button class="btn btn-primary w-100">
                                        {{ __('Register') }}
                                    </x-primary-button>

                                     <span class="text-center pt-2">Already Have an account?<a class="text-decoration-none small text-muted text-center" href="{{ route('login') }}">
                                        Sign In
                                    </a></span>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer text-center text-muted small border-0">
                            &copy; {{ date('Y') }} Todo App
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
