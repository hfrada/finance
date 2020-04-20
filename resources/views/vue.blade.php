<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Financial App</title>
    </head>
    <body>
    	<div id="app">
    		<navbar-component></navbar-component>
    		<router-view></router-view>
    	</div>
        <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
