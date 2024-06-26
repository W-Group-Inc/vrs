@extends('layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown mt-5">
    <div>
        <div class="m-b-md mt-5">
            <img alt="image" src="{{ asset('/images/visitor.png')}}" style='width: 250px'>
        </div>
        <h3>@yield('title', 'Visitor Registration System')</h3>
        <form method="POST" action="{{ route('login') }}"  aria-label="{{ __('Login') }}" onsubmit='show()'>
            @csrf
            <div class="form-group">
                <input type="email" name='email' value="{{ old('email') }}" class="form-control" placeholder="Email" required="">
            </div>
            <div class="form-group">
                <input type="password" name='password' class="form-control" placeholder="******" required="">
            </div>
            @if($errors->any())
                <div class="form-group alert alert-danger alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <strong>{{$errors->first()}}</strong>
                </div>
            @endif
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            {{-- <a href="{{ route('password.request') }}" onclick='show()'><small>Forgot password?</small></a> --}}
        </form>
        <p class="m-t"> <small>Copyright &copy; W Group Inc. {{date('Y')}}</small> </p>  
    </div>
</div>
@endsection
