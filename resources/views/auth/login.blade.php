 <!doctype html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

     <title>{{ config('app.name', 'Laravel') }}</title>

     <link rel="stylesheet" type="text/css" href="{{ URL::asset('styles/auth.css') }}">

     <!-- Fonts -->
     <link rel="dns-prefetch" href="//fonts.bunny.net">
     <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
 </head>

 <body>
     <div class="container">
         <div class="screen">
             <div class="screen__content">

                 <form class="login" method="POST" action="{{ route('login') }}">
                     @csrf
                     <div class="login__field">
                         <input type="email" class="login__input" placeholder="Email" name="email"
                             value="{{ old('email') }}" required autocomplete="email" autofocus>
                         @error('email')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                     </div>
                     
                     <div class="login__field">
                         <input id="password" type="password"
                             class="login__input @error('password') is-invalid @enderror" name="password" required
                             autocomplete="current-password">
                         @error('password')
                             <span class="invalid-feedback" role="alert">
                                 <strong>{{ $message }}</strong>
                             </span>
                         @enderror
                     </div>

                     <button class="submit" type="submit">
                         <span class="button__text">Log In Now</span>
                     </button>
                 </form>

             </div>
             <div class="screen__background">
                 <span class="screen__background__shape screen__background__shape4"></span>
                 <span class="screen__background__shape screen__background__shape3"></span>
                 <span class="screen__background__shape screen__background__shape2"></span>
                 <span class="screen__background__shape screen__background__shape1"></span>
             </div>
         </div>
     </div>

 </body>

 </html>
