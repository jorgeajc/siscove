@extends('welcome')

@section('content')
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>  
        <title>Error</title>
        <script>
            $(document).ready(function() {
                window.setTimeout(function() {
                    $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                        $('.alert').alert('close'); 
                    });
                }, 5000);
            });
        </script>
    </head>
    <body>
        <br>
        <div class='col-md-8' style="text-align: center; display: flex; justify-content: center;">
            <div id="alert" class="alert alert-danger alert-dismissible" style="background: red;" role="alert" data-auto-dismiss="2000">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h1 style="color: black">
                    ERROR 401
                    <br>
                    ACCESO DENEGADO
                </h1>
            </div> 
        </div>
    </body>
    </html>
@endsection