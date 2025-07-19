<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyBssPqASFnjF6Skf2qRXeDdpHdI2eipXFs",
            authDomain: "first-project-ba01a.firebaseapp.com",
            databaseURL: "https://first-project-ba01a.firebaseio.com",
            projectId: "first-project-ba01a",
            storageBucket: "first-project-ba01a.firebasestorage.app",
            messagingSenderId: "1042134752785",
            appId: "1:1042134752785:web:f93cff17721c45590c5bb0"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        messaging.requestPermission().then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                fetch('fcm/create?TOKEN=' + response)
            }).catch(function(error) {
                alert(error);
            });
    </script>
</body>

</html>
