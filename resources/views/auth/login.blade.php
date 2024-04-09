@extends('layouts.app')

@section('title')
    - Login
@endsection

@section('content')
 
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                    <div class="col-lg-4">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                               <div class="login-logo">
                                                    <a href="{{ route('login') }}"><img src="{{ btheme() }}/images/logo.png?{{ ver() }}"></a>
                                                </div>
                                                <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                                <!-- <p class="text-muted">Sign in to continue to Nazox.</p> -->
                                            </div>

                                            <div class="p-2 mt-1">

                                            <form method="POST" action="{{ url(conf('backend_url')) }}">
                                                @csrf

                                                @if(session('error'))
                                                    <div class="alert alert-danger" role="alert">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif

                                                <div class="form-group auth-form-group-custom mb-4">
                                                    <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" name="email" placeholder="Enter username" value="{{ old('email') }}">

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group auth-form-group-custom mb-4">
                                                    <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                    <label for="userpassword">Password</label>
                                                    <input type="password" class="form-control" name="password" id="userpassword" placeholder="Enter password">

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                              <!--   <div class="form-group auth-form-group-custom mb-4">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember">Remember Me</label>
                                                </div> -->

                                                <div class="mt-3 text-center">
                                                    <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                                </div>

                                           <!--      <div class="mt-4 text-center">
                                                    <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock mr-1"></i> Forgot your password?</a>
                                                </div> -->
                                            </form>

                                         
                                            </div>

                                            <div class="mt-3 text-center">
                                            <!--     <p>Don't have an account ? <a href="auth-register.html" class="font-weight-medium text-primary"> Register </a> </p> -->
                                                <p>© {{ date('Y')}} Church.<i class="mdi mdi-heart text-danger"></i></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
