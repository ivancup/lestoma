@extends('publica.layouts.app')
@section('content')

<section class="ftco-appointment" id="login">
    <div class="container-wrap">
    	<div class="row no-gutters d-md-flex align-items-center">
    		<div class="col-md-6 d-flex align-self-stretch" style="background-image: url(publica/assets/images/20b.jpeg);">
    		</div>
            <div class="col-md-5 appointment ftco-animate">
                <div class="form login_form">
                <section class="login_content">
				    {!! Form::open(['role' => 'form', 'id' => 'form-login', 'method' => 'POST', 'url' => route('login.in')]) !!}
                    <h1>Login</h1>
                    <div>
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo', 'required', 'autofocus', 'max'
                        => '60']) !!}
                    </div>
                    <div>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) !!}
                    </div>
                    <div>
                        {!! Form::submit('Ingresar', ['class' => 'btn btn-default submit']) !!} {{ link_to('/password/reset', 'Olvidaste tu contraseña?',
                        ['class' => 'reset_pass'])}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="separator">
                        @include('shared.footer')
                    </div>
                    {!! Form::close() !!}
                    </section>
			</div>    			
    	</div>
    </div>
</section>
@endsection

@push('styles')

<link href="gentella/vendors/pnotify/dist/pnotify.css" rel="stylesheet">
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
<link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet"> 
@endpush {{-- Scripts necesarios para el formulario --}} @push('scripts')
<!-- PNotify -->
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
<script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>

@foreach ($errors->all() as $error)
<script type="text/javascript">
    new PNotify({title: 'Error!', text: '{{ $error }}', type: 'error', styling: 'bootstrap3'});
</script>
@endforeach 
@endpush