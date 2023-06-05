<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name','Laravel')  }}</title>

    <!-- Fonts -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <style>
        .highlight{
            color:red;
        }
    </style>
</head>
<body>
<div id="app">
    <v-app>
        <v-main>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</div>
<script>
    window.baseIMAGE_URL = "{{env('IMAGE_BASE_URL')}}"
</script>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
