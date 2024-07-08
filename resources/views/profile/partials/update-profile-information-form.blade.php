<section>
         @if(!empty($user->logo))
            <div class="d-flex justify-content-center align-items-center">
               <div class="text-center">
                    <h4>Le Logo de votre entreprise</h4>
                    <img style="width:200px; height:200px; border-radius:50%;" src="{{ $user->getUrlForLogo() }}" alt="Logo de l'entreprise">
              </div>
           </div>
         @endif

    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row">
          <div class="mb-3 d-flex">
                  <div class="card-body demo-vertical-spacing demo-only-element">
                      <div class="ml-3 col-md-10  form-password-toggle">
                         @include('shared.input', ['class' => 'col', 'label' => 'Nom:', 'name' => 'name', 'value' => $user->name])
                      </div>
                  </div>
                  <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="ml-3 col-md-10 form-password-toggle">
                          @include('shared.input', ['class' => 'col', 'label' => 'prenoms:', 'name' => 'firstname', 'value' => $user->firstname])
                      </div>
                 </div>
            </div>
        </div>
        <div>
          <div class="row">
              <div class="mb-3 d-flex">
                 <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="ml-3 col-md-10 form-password-toggle">
                          @include('shared.input', ['class' => 'col','type'=>'email','label' => 'Adresse mail:', 'name' => 'email', 'value' => $user->email])
                      </div>
                       @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                          <div>
                               <p class="text-sm mt-2 text-gray-800">
                                  {{ __('Your email address is unverified.') }}
                                     <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                       {{ __('Click here to re-send the verification email.') }}
                                    </button>
                               </p>
                                   @if (session('status') === 'verification-link-sent')
                                      <p class="mt-2 font-medium text-sm text-green-600">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                      </p>
                                 @endif
                         </div>
                     @endif
                 </div>
                 <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="ml-3 col-md-10 form-password-toggle">
                          @include('shared.input', ['class' => 'col', 'label' => 'Télephone', 'name' => 'phone', 'value' => $user->phone])
                      </div>
                 </div>
              </div>
         </div>
            {{-- <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" /> --}}


        </div>
        <div class="row">
           <div class="mb-3 d-flex">
                  <div class="card-body demo-vertical-spacing demo-only-element">
                       <div style="width:410px;" class="col-md-12  form-password-toggle">
                          @include('shared.input', ['class' => 'col', 'label' => 'Nom de l\'entreprise', 'name' => 'entreprise', 'value' => $user->entreprise])
                       </div>
                  </div>
                  <div class="card-body demo-vertical-spacing demo-only-element">
                       <div style="margin-right:70px;" class="col-md-10  form-password-toggle">
                          @include('shared.upload', ['class' => 'col', 'label' => 'Logo de l\'entreprise', 'name' => 'logo'])
                       </div>
                  </div>
           </div>
        </div>
        <div class="row">
           <div class="mb-3 d-flex">
                  <div class="card-body demo-vertical-spacing demo-only-element">
                       <div  class="col-md-10  form-password-toggle">
                          @include('shared.input', ['class' => 'col', 'label' => 'Pays:', 'name' => 'country', 'value' => $user->country])
                       </div>
                  </div>
                  <div class="card-body demo-vertical-spacing demo-only-element">
                       <div  class="col-md-10  form-password-toggle">
                          @include('shared.input', ['class' => 'col', 'label' => 'Addresse', 'name' => 'address','value'=>$user->address])
                       </div>
                  </div>
           </div>
        </div>

        <div class="mt-3 items-center gap-4">
           <button  class="w-50 btn btn-primary">Sauvegarder</button>
            {{-- <x-primary-button>{{ __('Save') }}</x-primary-button> --}}

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
