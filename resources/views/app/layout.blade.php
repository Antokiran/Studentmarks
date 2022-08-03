<!DOCTYPE html>
<html>
    <head>
        <title>Student List</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">

       


       
    </head>
<body>

<div class="container">
    @yield('content')
</div>
</body>
</html>