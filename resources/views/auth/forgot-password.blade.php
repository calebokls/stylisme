@extends('layoutLogin')
@section('content')

  <div class="limiter">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
		<div class="container-login100">
			<div class="wrap-login100">
                <x-auth-session-status class="mb-4" :status="session('status')" />
				<form method="POST" action="{{ route('password.email') }}" class="login100-form validate-form">
                @csrf
					<span class="login100-form-title p-b-26">
						Reinitialisation
					</span>
					<span class="mb-3 ml-5">
						<img style="height:100px;"  src="{{asset('images/plan.PNG')}}">
					</span>
                     <div class="mb-4 text-sm bg-info mb-2">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                     <x-input-error :messages="$errors->get('email')" class="mt-2" />
					<div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is: a@b.c">
						<input class="input100" id="email" type="email" name="email" :value="old('email')" required autofocus>
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>
                    <div class="flex items-center justify-end">
                            <div class="container-login100-form-btn">
						           <div class="wrap-login100-form-btn">
							            <div class="login100-form-bgbtn"></div>
							               <button class="login100-form-btn">
								               Lien de reinitialisation
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
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
