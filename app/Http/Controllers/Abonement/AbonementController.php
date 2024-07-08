<?php

namespace App\Http\Controllers\Abonement;

use App\Http\Controllers\Controller;
use App\Models\Abonement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbonementController extends Controller
{
    public function susbcribe()
{
    $find = Abonement::where('user_id', Auth::user()->id)->first();

    if (empty($find)) {
        $user = auth()->user();
        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addMonth();
        $premium = true;

        $abonement = new Abonement([
            'user_id' => $user->id,
            'debut' => $startDate,
            'fin' => $endDate,
            'premium' => $premium,
        ]);

        $abonement->save();

        return $this->redirectAfterSubscribe($user, 'Vous êtes à présent un membre premium');
    }
     elseif ($find && $find->premium == false)
     {
        $user = auth()->user();
        $currentSubscription = Abonement::where('user_id', $user->id)->first();
        if ($currentSubscription && $currentSubscription->fin instanceof \Carbon\Carbon && $currentSubscription->fin->isPast()) {
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addMonth();
            $premium = true;
            $currentSubscription->debut= $startDate;
            $currentSubscription->fin = $endDate;
            $currentSubscription->premium = $premium;
            $currentSubscription->save();
            return $this->redirectUser($user, 'Renouvellement effectué avec succès');
        }
    }else {
        return redirect()->route('index')->with('success', 'Vous êtes déjà un membre premium');
    }
}


    private function redirectUser($user, $message)
     {
        if ($user->acteur == 'styliste') {
           return redirect()->intended(route('style.modely.index'))->with('success', $message);
        } elseif ($user->acteur == 'manequina') {
          return redirect()->intended(route('manequina.manequin.index'))->with('success', $message);
        } else {
          return redirect()->route('home')->with('success', $message);
        }
    }
}
