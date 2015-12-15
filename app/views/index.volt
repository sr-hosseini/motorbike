<!DOCTYPE html>
<html>
    <head>
        <title>Welcome to MotorBikes</title>
        {{ stylesheet_link('css/bootstrap.min.css') }}
        {{ stylesheet_link('font/font-awesome/css/font-awesome.min.css') }}
        {{ stylesheet_link('css/style.css') }}
    </head>
    <body>

        {{ content() }}

        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('js/bootstrap.min.js') }}"
    </body>
</html>