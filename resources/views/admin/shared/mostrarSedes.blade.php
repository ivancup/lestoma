<!-- Modal Procesos-->
<div class="modal fade" id="modal_mostrar_sedes" tabindex="-1" role="dialog" aria-labelledby="modal_titulo">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_titulo">Seleccionar sede</h4>
            </div>
            <div class="modal-body">

                {!! Form::open([ 'route' => 'admin.mostrar_sedes.seleccionar_sede', 'method' => 'POST', 'id' => 'form_mostrar_sede',
                'class' => 'form-horizontal form-label-left', 'novalidate' ])!!}

                <div class="form-group">
                    {!! Form::label('sede', 'Sede', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        {!! Form::select('sede', isset($procesos_usuario)?$procesos_usuario:[], old('sede'), ['class' => 'select2 form-control',
                        'required' => '', 'id' => 'sedes_usuario']) !!}
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> {!! Form::submit( 'Seleccionar
                sede', ['class' => 'btn btn-success']) !!}

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!--FIN Modal Procesos-->