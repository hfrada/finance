<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <!-- <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet"> -->
</head>
<body>
<div id="app">
    <v-app light>
        <v-content class="grey lighten-5">
            <navbar-component></navbar-component>
            <div>
                <router-view></router-view>
            </div>
        </v-content>
    </v-app>
</div>
<script src="{{ url (mix('/js/app.js')) }}" type="text/javascript"></script>
<script>
    @auth
        window.Permissions = {!! json_encode(explode(',', Auth::guard('super_user')->user()->role->permission), true) !!};
        console.log(window.Permissions);
    @else
        window.Permissions = [];
    @endauth
</script>
</body>
</html>