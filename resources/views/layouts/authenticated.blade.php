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

   {{-- iconify --}}
   <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>

   {{-- vite --}}
   @vite([
      'resources/sass/app.scss', 
      'resources/js/app.js',
      'resources/css/dashboard.css',
      'public/css/custom.min.css',
      ])
</head>

<body>
   <div class="container-fluid vw-100 vh-100 d-flex px-0">
      <div class="sidebar vh-100 sticky-top top-0 py-4 ps-4 pe-3 d-flex flex-column justify-content-between">
         <div class="wrapper">
            <div class="side-brand d-flex justify-content-center mb-5">
               <img src="{{ asset("images/logo.png") }}" class="w-50 text-center" alt="">
            </div>
            <div class="side-profile d-flex flex-column align-items-center gap-2 mb-5">
               <img src="{{ asset('images/profile.png') }}" class="w-50" alt="">
               <div class="text-center">
                  <p class="fw-bold mb-0 text-capitalize">{{ auth()->user()->name }}</p>
                  <small class="d-block text-break">{{ auth()->user()->email }}</small>
               </div>
            </div>
            <x-sidebar-links />
         </div>
         <div class="logout">
               <button class="w-full d-block btn btn-primary py-2 w-100 rounded-5" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>
         </div>
      </div>
      <div class="content bg-body-tertiary col-10 d-flex flex-column py-4 px-4">
         @yield('content')
      </div>
   </div>

   <!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
         <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Logout</h1>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
         Apakah kamu yakin ingin keluar dari akun ini?
         </div>
         <div class="modal-footer">
         <button type="button" class="btn btn-primary rounded-2" data-bs-dismiss="modal">Batal</button>
         <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger rounded-2">Yakin</button>
         </form>
         </div>
      </div>
   </div>
</div>
</body>
</html>