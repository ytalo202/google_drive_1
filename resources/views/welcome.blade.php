<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->


    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="789285150024-91pivhe8fmtqao57vjr15lmkijfops8t.apps.googleusercontent.com">

{{--    <meta name="google-signin-client_id" content="43175392696-3t8agkvkcisqfr9iq2qb21e2c542q9gi.apps.googleusercontent.com.apps.googleusercontent.com">--}}
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ route('google.folders') }}">Ver mis archivos</a>
            @else
                <a href="{{ route('login.google') }}" >Ingresar con Gmail</a>

            @endauth
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            LaraDrive
        </div>

        <div class="g-signin2" ></div>

        <script>
            function onSignIn(googleUser) {
                console.log('ddddd')
                // Useful data for your client-side scripts:
                var profile = googleUser.getBasicProfile();
                // console.log("ID: " + profile.getId()); // Don't send this directly to your server!
                // console.log('Full Name: ' + profile.getName());
                // console.log('Given Name: ' + profile.getGivenName());
                // console.log('Family Name: ' + profile.getFamilyName());
                // console.log("Image URL: " + profile.getImageUrl());
                // console.log("Email: " + profile.getEmail());
                //
                // // The ID token you need to pass to your backend:
                // var id_token = googleUser.getAuthResponse().id_token;
                // console.log("ID Token: " + id_token);

                console.log('profile',profile)
            }
        </script>



    </div>
</div>
</body>
</html>
