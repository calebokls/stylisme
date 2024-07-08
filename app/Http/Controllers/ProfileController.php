<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if(is_null($request->user()->logo) && is_null($request->validated('logo')))
        {
            return back()->with('danger','Vous devez importer un logo');
        }
        $request->user()->fill($this->ExtractLogo($request,$request->user()));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function ExtractLogo(ProfileUpdateRequest $request,User $user)
    {
        $data = $request->validated();
        /**
         * @var HttpUploadedFile $image
         */
        $image = $request->validated('logo');
        if($image === null || $image->getError())
        {
            return $data;
        }
        if($user->logo)
        {
            Storage::disk('public')->delete($user->logo);
        }
        $data['logo']=$image->store('profile/logo','public');
        return $data;
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
