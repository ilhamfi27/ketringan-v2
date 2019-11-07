Hai {{ $nama }}!<br>
Silahkan konfirmasi email anda 
<a href="{{ $url }}:8000/api/v1/token_confirmation/{{ $id }}?token={{ $token }}">Disini</a>