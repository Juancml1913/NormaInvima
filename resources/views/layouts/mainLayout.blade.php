<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Norma invima</title>
    <link rel="stylesheet"
        href="{{ asset('assets/bootstrap-4.5.2-dist/css/bootstrap.min.css') }}">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
    <link href="{{ asset('assets/toastr/toastr.min.css') }}" rel="stylesheet" />
    @yield('estilos')
    @laravelPWA
</head>

<body>
    @yield('contenido')
    <script src="{{ asset('assets/Jquery/jquery-3.5.1.min.js') }}" crossorigin="anonymous">
    </script>
    <!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->
    <script src="{{ asset('assets/bootstrap-notify-3.1.3/bootstrap-notify.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/bootstrap-4.5.2-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    @yield('scripts')
    <script type="text/javascript">
        // Initialize the service worker
        /*if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/serviceworker.js', {
                scope: '.'
            }).then(function (registration) {
                // Registration was successful
                console.log('Laravel PWA: ServiceWorker registration successful with scope: ', registration.scope);
            }, function (err) {
                // registration failed :(
                console.log('Laravel PWA: ServiceWorker registration failed: ', err);
            });
        }*/
        var _registration = null;

        function registerServiceWorker() {
            return navigator.serviceWorker.register('/serviceworker.js')
                .then(function (registration) {
                    console.log('Service worker successfully registered.');
                    _registration = registration;

                    return registration;
                })
                .catch(function (err) {
                    console.error('Unable to register service worker.', err);
                });
        }

        function askPermission() {
            return new Promise(function (resolve, reject) {
                    const permissionResult = Notification.requestPermission(function (result) {
                        resolve(result);
                    });
                    if (permissionResult) {
                        permissionResult.then(resolve, reject);
                    }
                })
                .then(function (permissionResult) {
                    if (permissionResult !== 'granted') {
                        throw new Error('We weren\'t granted permission.');
                    } else {
                        subscribeUserToPush();
                    }
                });
        }

        function urlBase64ToUint8Array(base64String) {
            const padding = '='.repeat((4 - base64String.length % 4) % 4);
            const base64 = (base64String + padding)
                .replace(/\-/g, '+')
                .replace(/_/g, '/');
            const rawData = window.atob(base64);
            const outputArray = new Uint8Array(rawData.length);
            for (let i = 0; i < rawData.length; ++i) {
                outputArray[i] = rawData.charCodeAt(i);
            }
            return outputArray;
        }

        function getSWRegistration() {
            var promise = new Promise(function (resolve, reject) {
                // do a thing, possibly async, then…
                if (_registration != null) {
                    resolve(_registration);
                } else {
                    reject(Error("It broke"));
                }
            });
            return promise;
        }

        function subscribeUserToPush() {
            getSWRegistration()
                .then(function (registration) {
                    console.log(registration);
                    const subscribeOptions = {
                        userVisibleOnly: true,
                        applicationServerKey: urlBase64ToUint8Array(
                            "{{ env('VAPID_PUBLIC_KEY') }}"
                        )
                    };
                    return registration.pushManager.subscribe(subscribeOptions);
                })
                .then(function (pushSubscription) {
                    console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
                    sendSubscriptionToBackEnd(pushSubscription);
                    return pushSubscription;
                });
        }

        function sendSubscriptionToBackEnd(subscription) {
            /*return $.ajax({
                    url: "/save-subscription",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    dataType: 'json',
                    data: {'data':JSON.stringify(subscription)}
                })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Bad status code from server.');
                    }
                    return response.json();
                })
                .then(function (responseData) {
                    if (!(responseData.data && responseData.data.success)) {
                        throw new Error('Bad response from server.');
                    }
                });*/
            return fetch('/api/save-subscription/{{Auth::user()->id}}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(subscription)
                })
                .then(function (response) {
                    if (!response.ok) {
                        throw new Error('Bad status code from server.');
                    }
                    return response.json();
                })
                .then(function (responseData) {
                    if (!(responseData.data && responseData.data.success)) {
                        throw new Error('Bad response from server.');
                    }
                });
        }
        registerServiceWorker();
        if (window.location.pathname != '/') {
            askPermission();
        }

    </script>
</body>

</html>
