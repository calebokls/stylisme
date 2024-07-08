@extends('layoutLogin')
@section('content')

 <div class="limiter">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="POST" action="{{ route('register') }}" class="login100-form validate-form">
                @csrf
					<span class="login100-form-title p-b-26">
						BIENVENUE
					</span>
					<span class="mb-3 ml-5">
						<img style="height:100px;"  src="{{asset('images/plan.PNG')}}">
					</span>
                  <div>
                   <x-input-error :messages="$errors->get('name')" class="mt-2" />
					<div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is: a@b.c">
						<input class="input100" id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" >
                        <span class="focus-input100" data-placeholder="Nom"></span>
                    </div>
                  </div>
                  <div>
                   <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
					<div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is: a@b.c">
						<input class="input100" id="firstname" type="text" name="firstname" :value="old('name')" required autofocus autocomplete="username" >
                        <span class="focus-input100" data-placeholder="Prénoms"></span>
                    </div>
                  </div>
                  <div>
                   <x-input-error :messages="$errors->get('email')" class="mt-2" />
					<div class="wrap-input100 validate-input mt-3" data-validate = "Valid email is: a@b.c">
						<input class="input100" id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" >
                        <span class="focus-input100" data-placeholder="Adresse mail"></span>
                    </div>
                  </div>
                  <div>
                   <x-input-error :messages="$errors->get('phone')" class="mt-2" />
					<div class="wrap-input100 validate-input mt-3" >
						<input class="input100" id="phone" type="text" name="phone" :value="old('phone')" required>
                        <span class="focus-input100" data-placeholder="Télephone"></span>
                    </div>
                  </div>


					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" id="password" type="password"  name="password"  required autocomplete="new-password">
                        <span class="focus-input100" data-placeholder="Mot de passe"></span>
					   <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" id="password_confirmation" type="password"  name="password_confirmation" required autocomplete="current-password" >
                        <span class="focus-input100" data-placeholder="Confirmer votre mot de passe"></span>
					   <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div>
                   <div >
                       <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="acteur" id="flexSwitchCheckDefault">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Je suis un acteur de la mode</label>
                       </div>
                    </div>
					{{-- <div id="select" class="wrap-input100 mt-3">
                       <select name="acteur" class="input100">
                         <option value="">--Veuillez choisir un acteur--</option>
                         <option value="styliste">Styliste</option>
                         <option value="manequina">Manequin</option>
                       </select>
                    </div> --}}
                  </div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								S'inscrire
							</button>
						</div>
					</div>

					<div class="text-center">
						<span class="txt1">
							J'ai un compte.
						</span>

						<a class="txt2" href="{{ route('login') }}" style="text-color:blue;">
							Se Connecter
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>
    <script type="text/javascript">
      $(document).ready(function(){
          $('#select').hide();
        $('.form-check-input').change(function(){
            if($(this).is(':checked'))
            {
                $('#select').show();
            }else{
                $('#select').hide();
            }
        })
      })
    </script>

@endsection

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

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
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
