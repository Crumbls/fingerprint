<script>
    @if(isset($fingerprint) && $fingerprint)
    let fingerprint = '{{ $fingerprint }}';
    @else
    let fingerprint = '';
    @endif

    if (!fingerprint) {
        // Initialize the agent at application startup.
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v3')
            .then(FingerprintJS => FingerprintJS.load())

        // Get the visitor identifier when you need it.
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier:
                fingerprint = result.visitorId;

                console.log(fingerprint);
            }).then(function() {
                var data = new Object();
                @if($user = \Auth::user())
                    data.user_id = '{{ $user->getKey() }}';
                @endif
                data.fingerprint = fingerprint;

            var xhr = new XMLHttpRequest();   // new HttpRequest instance
            xhr.open("POST", '{!! \Illuminate\Support\Facades\URL::temporarySignedRoute('fingerprint', now()->addSeconds(60), [])  !!}');
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            xhr.send(JSON.stringify(data));
        });
    } else {
        console.log(fingerprint);
    }
</script>