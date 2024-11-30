<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   {{-- set title for web page --}}
   <title>{{ config('app_name', 'Learnify')}} | {{ $title }}</title>

   {{-- poppins google fonts --}}
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

   {{-- vite --}}
   @vite([
      'resources/sass/app.scss', 
      'resources/js/app.js',
      'resources/css/auth.css',
      'public/css/custom.min.css',
      ])
</head>

<body>
   <div class="position-relative overflow-x-hidden vw-100 min-vh-100 d-flex align-items-center justify-content-center flex-column">
      <div class="wrapper d-flex flex-column align-items-center justify-content-start">
         <img src="{{ asset('images/logo.png') }}" class="w-50" alt="logo-image">
         @yield('form')   
      </div>
      <div class="rectangle-wrapper position-absolute start-50 translate-middle">
         <div class="rectangle rectangle-1 position-absolute"></div>
         <div class="rectangle rectangle-2 position-absolute"></div>
         <div class="rectangle rectangle-3 position-absolute"></div>
      </div>
      <div class="dotted-design dotted-design-1 position-absolute"></div>
      <div class="dotted-design dotted-design-2 position-absolute"></div>
      <div class="footer-wave position-absolute start-50 translate-middle-x z-n1">
         <img src="{{ asset('images/wave-footer.svg ') }}" class="vw-100" alt="">
      </div>
   </div>
</body>
</html>