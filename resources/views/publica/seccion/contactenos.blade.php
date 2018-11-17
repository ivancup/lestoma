<section class="ftco-appointment" id="contactenos">
	<div class="overlay"></div>
    <div class="container-wrap">
    	<div class="row no-gutters d-md-flex align-items-center">
    		<div class="col-md-6 d-flex align-self-stretch">
    			<div id="map"></div>
    		</div>
	    	<div class="col-md-6 appointment ftco-animate">
	    		<h3 class="mb-3">Contactenos</h3>
				{!! Form::open(['role' => 'form', 'id' => 'form-contactenos', 'method' => 'POST', 'url' => route('admin.contactenos.store')]) !!}
        		<div>
            		{!! Form::text('nombre',old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre', 'required', 'autofocus', 'max'
            		=> '60']) !!}
        		</div>
				<div>
            		{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Correo', 'required', 'autofocus', 'max'
            		=> '60']) !!}
        		</div>
				<div>
            		{!! Form::textarea('mensaje', old('mensaje'), ['class' => 'form-control', 'placeholder' => 'Mensaje', 'required', 'autofocus', 'max'
            		=> '150']) !!}
        		</div>
        		<div>
					{!! Form::submit('Enviar', ['class' => 'btn btn-default submit']) !!}
				</div>
        		{!! Form::close() !!}
			</div>    			
    	</div>
    </div>
</section>

@push('scripts')
    <!-- Datatables -->
    <script src="{{asset('gentella/vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{asset('gentella/vendors/sweetalert/sweetalert2.all.min.js') }}"></script>
    <!-- PNotify -->
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.js') }}"></script>
    <script src="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.js') }}"></script>

@endpush
{{-- Estilos necesarios para el formulario --}}
@push('styles')
    <!-- Datatables -->
    <link href="{{ asset('gentella/vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <!-- PNotify -->
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">

@endpush
@push('functions')
<script type="text/javascript">
	$(document).ready(function(){
		@if (session('status'))
    new PNotify({
		tittle:'Su Mensaje ha sido enviado',
		text:'Gracias por contactarse con lestoma, su mensaje sera contestado en el menor tiempo posible',
		type:'success',
		styling:'bootstrap3'
	});
	@endif
	});
</script>
@endpush






