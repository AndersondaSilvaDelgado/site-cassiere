<x-guest-layout>
    <x-auth-card>

        <section class="section-conten padding-y" style="min-height:84vh">

            <div class="card mx-auto p-2" style="max-width: 380px; margin-top:100px;">

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <h4 class="card-title mb-4">Sign in</h4>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group pr-1 pl-1">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" class="form-control"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group">
                        <label for="remember_me" class="custom-control custom-checkbox">
                            <input id="remember_me" type="checkbox" class="custom-control-input" name="remember">
                            <div class="custom-control-label">{{ __('Remember me') }}</div>
                        </label>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Log in') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="card-footer text-center">
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif

                </form>

            </div>

        </section>
    </x-auth-card>
</x-guest-layout>
