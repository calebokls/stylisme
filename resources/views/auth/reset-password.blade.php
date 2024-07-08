@extends('layoutLogin')
@section('content')

  <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('password.store') }}" class="login100-form validate-form">
                @csrf
                 <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
					<!-- Session Status -->
                   <x-auth-session-status class="mb-4" :status="session('status')" />
                    <span class="login100-form-title p-b-26">
						Reinitialisation
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
                        <span class="focus-input100" data-placeholder="Mot de passe"></span>
					   <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" id="password_confirmation" type="password"  name="password_confirmation" required autocomplete="current-password" >
                        <span class="focus-input100" data-placeholder="Comfirmer le mot de passe"></span>
					   <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-center justify-end">
                            <div class="container-login100-form-btn">
						           <div class="wrap-login100-form-btn">
							            <div class="login100-form-bgbtn"></div>
							               <button class="login100-form-btn">
								               Reinitialiser le mot de passe
							            </button>
						           </div>
					        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
