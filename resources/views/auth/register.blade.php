<x-guest-layout>
    <x-auth-card>

        <section class="section-conten padding-y" style="min-height:84vh">

            <div class="card mx-auto p-2" style="max-width: 380px; margin-top:100px;">

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-group pr-1 pl-1">
                        <label for="name">{{ __('Name') }}</label>
                        <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

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
                                        name="password" required/>
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" class="form-control"
                                        type="password"
                                        name="password_confirmation" required/>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-link" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>

            </div>

        </section>
    </x-auth-card>
</x-guest-layout>
