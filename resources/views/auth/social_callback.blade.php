<script>
    let data = {
        token: "{{ $token }}",
        Nama_Konsumen: "{{ $Nama_Konsumen }}",
        email: "{{ $email }}",
        is_verified: {{ $is_verified }} == 1 ? true : false,
        socialized_account: {{ $socialized_account }} == 1 ? true : false,
    };
    localStorage.setItem('AuthToken', JSON.stringify(data));
    if (localStorage.getItem('AuthToken') != null) {
        window.location = "{{ env('APP_LANDING_PAGE').env('FRONT_END_PORT') }}";
    }
</script>