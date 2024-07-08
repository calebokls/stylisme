@extends('layoutLogin')
@section('content')

  <div class="limiter">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                @csrf
					<span class="login100-form-title p-b-26">
						Connexion
					</span>
					<span class="mb-3 ml-5">
						<img style="height:100px;"  src="{{asset('images/plan.PNG')}}">
					</span>
                     <x-input-error :messages="$errors->get('email')" class="mt-2" />
					<div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is: a@b.c">
						<input class="input100" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" >
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" id="password" type="password"  name="password" required autocomplete="current-password" >
                        <span class="focus-input100" data-placeholder="Password"></span>
					   <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end">
                            <div class="container-login100-form-btn">
						           <div class="wrap-login100-form-btn">
							            <div class="login100-form-bgbtn"></div>
							               <button class="login100-form-btn">
								               Se connecter
							            </button>
						           </div>
					        </div>
                             @if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                          @endif
                               {{-- <x-primary-button class="ms-3">
                                      {{ __('Log in') }}
                                </x-primary-button> --}}
                    </div>

					<div class="text-center pt-2">
						<span class="txt1">
							N'avez-vous pas un compte?
						</span>

						<a class="txt2" href="{{ route('register') }}" style="text-color:blue;">
							S'inscrire
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>

@endsection

{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
