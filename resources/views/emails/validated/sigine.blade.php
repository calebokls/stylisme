<x-mail::message>
<p class="btn btn-success">Validation de votre inscription sur le site modo.org</p>
 Votre inscription a été validé vous pouvez desormais pleinement profiter de notre site via ce lien:
 <a href="{{route('login')}}">modo.org</a>
<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
