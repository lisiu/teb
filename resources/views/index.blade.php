<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TEB Test</title>
    </head>
    <body>
        <div class="container">
            <div id="app-container"></div>
        </div>
        <script src="{{mix('/js/bundle_app.js')}}"></script>
    </body>
</html>
