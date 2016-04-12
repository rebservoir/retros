<div class="modal fade" id="pass_edit" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Modificar Contraseña</h4>
			</div>


			<div class="modal-body">

				<p>Ingresa tu dirección de correo para restaurarla. <br> Es posible que tengas que verificar tu carpeta de spam</p>

            <br>

                <form method="POST" action="/pass_recover">
                    {!! csrf_field() !!}

                    @if (count($errors) > 0)
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="form-group">
                        <label>Email</label>
                        <br>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder = 'Ingresa tu Email'>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary">
                            Enviar Correo
                        </button>
                    </div>
                </form>

            <br>

			</div>
			
		</div>
	</div>
</div>
