<html>
 <head>
  <title>
   Login Page
  </title>
  <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: 600;
        }
        .login-container .form-control {
            margin-bottom: 1rem;
        }
        .login-container .btn-primary {
            width: 100%;
            margin-bottom: 1rem;
        }
        .login-container .btn-outline-secondary {
            width: 48%;
        }
        .login-container .forgot-password {
            text-align: right;
            display: block;
            margin-bottom: 1rem;
        }
        .login-container .signup-link {
            text-align: center;
            display: block;
            margin-top: 1rem;
        }
        .illustration {
            text-align: center;
            margin-top: 2rem;
        }
        .illustration img {
            max-width: 100%;
        }
        @media (max-width: 767.98px) {
            .login-container {
                max-width: 100%;
                padding: 1rem;
            }
            .illustration {
                margin-top: 1rem;
                order: -1;
            }
        }
  </style>
 </head>
 <body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
   <div class="row">
    <div class="col-md-6 illustration">
     <img alt="Illustration of a person lifting a key with a lock symbol in the background" height="450" src="assets/img/login/login.webp" width="300"/>
    </div>
    <div class="col-md-6">
     <div class="login-container">
      <h2>
       Login to your account
      </h2>
      @if (Session::get('warning'))
          <div class="alert alert-warning">
            <p>{{ Session::get('warning')}}</p>
          </div>
      @endif
      <form action="/prosesloginadmin" method="POST" autocomplete="off" novalidate>
        @csrf
       <div class="mb-3">
        <label class="form-label">
         Email address 
        </label>
        <input class="form-control" name="email" placeholder="your@email.com" type="email" autocomplete="off"/>
       </div>
       <div class="mb-3">
        <label class="form-label">
         Password
        </label>
        <input class="form-control"  name="password" placeholder="Your password" type="password" autocomplete="off"/>
        <a class="forgot-password" href="#">
         I forgot password
        </a>
       </div>
       <div class="mb-3 form-check">
        <input class="form-check-input" id="rememberMe" type="checkbox"/>
        <label class="form-check-label" for="rememberMe">
         Remember me on this device
        </label>
       </div>
       <button class="btn btn-primary" type="submit">
        Sign in
       </button>
       </div>
      </form>
      
     </div>
    </div>
   </div>
  </div>
 </body>
</html>