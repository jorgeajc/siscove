@extends('welcome') 

@section('content')   
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="/css/toastr.min.css" rel="stylesheet">
  
  <script src="/js/jquery-3.3.1.min.js" type="text/javascript"></script>  
  <script src="/js/toastr.min.js"> type="text/javascript"</script>
  <script> 
      $(document).ready(function(){  
        notificar();  
      });   
      function notificar(){    
          $.each(@json($arrayMensajes), function(i, item) {   
            if(item != null){  
              toastr.error(
                item, "Aviso.",{
                  timeOut:10000, 
                  closeButton: true, 
                  progressBar: true,
                  preventDuplicates: true,
                }
              );   
            } 
          });       
      };
  </script> 
</head>
<body>@endsection
   