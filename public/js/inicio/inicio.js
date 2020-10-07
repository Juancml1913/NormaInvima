function sendNotification() {
    var data = new FormData();
    data.append('title', document.getElementById('title').value);
    data.append('body', document.getElementById('body').value);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "{{ url('/api/send-notification') }}", true);
    xhr.onload = function () {
        // do something to response
        console.log(this.responseText);
    };
    xhr.send(data);
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
    const rawData = atob(base64);
    const outputArray = new Uint8Array(rawData.length);
    for (let i = 0; i < rawData.length; ++i) {
        outputArray[i] = rawData.charCodeAt(i);
    }
    return outputArray;
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
    return fetch('/api/save-subscription/{{ Auth::user()->id }}', {
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

askPermission();