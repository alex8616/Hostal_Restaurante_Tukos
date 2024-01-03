<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="width: 1000px; height: 1500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REGISTRAR OTRO CLIENTE INVITADO - HOSPEDAJE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
                <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row" style="margin: 15px;">
                        <div class="col-md-4">
                            <label for="inputNombre" class="is-required">Documento del Cliente</label>
                            <input class="otraclaseform validate-input" id="Documento_cliente" name="Documento_cliente" type="text" 
                            name="Nombre_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                            <input class="otraclaseform validate-input" id="cliente_id" type="text" 
                            name="cliente_id" onkeyup="javascript:this.value=this.value.toUpperCase();" hidden>
                        </div>
                        <div id="form_cliente" style="display:none; margin: 5px;">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <label for="Nombre_cliente" class="is-required">Nombres</label>
                                    <input class="otraclaseform validate-input" name="Nombre_cliente" 
                                    id="Nombre_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                                </div>
                                <div class="col-md-4">
                                    <label for="Apellido_cliente" class="is-required">Apellidos</label>
                                    <input class="otraclaseform validate-input" name="Apellido_cliente" 
                                    id="Apellido_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                                </div>
                                <div class="col-md-4">
                                    <label for="Profesion_cliente" class="is-required">Profesion</label>
                                    <input class="otraclaseform validate-input" name="Profesion_cliente" 
                                    id="Profesion_cliente" type="text" onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                                </div>
                            </div><br>
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="Nacionalidad_cliente" class="is-required">Nacionalidad</label>
                                    <select class="Nacionalidad_cliente otraclaseform validate-input" id="Nacionalidad_cliente" name="Nacionalidad_cliente">
                                        @foreach ($countries['countries'] as $country)
                                            <option value="{{ $country['nationality'] }}">{{ $country['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="EstadoCivil_cliente" class="is-required">Estado Civil</label><br>
                                    <select class="Nacionalidad_cliente otraclaseform validate-input" id="EstadoCivil_cliente" name="EstadoCivil_cliente">
                                        <option value="Soltero(a)">Soltero(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Viudo(a)">Viudo(a)</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="FechaNacimiento" class="is-required">Fecha De Nacimiento</label>
                                    <input class="otraclaseform validate-input" name="FechaNacimiento" id="FechaNacimiento" type="date" 
                                    onfocus="removeRedBorder(this)" onblur="checkInputValue(this)" onchange="calcularEdad()">
                                </div>
                                <div class="col-md-3">
                                    <label for="Edad_cliente" class="is-required">Edad</label>
                                    <input class="otraclaseform validate-input" name="Edad_cliente" id="Edad_cliente" type="text" 
                                    onfocus="removeRedBorder(this)" onblur="checkInputValue(this)">
                                </div>
                                <div class="col-md-3">
                                    <label for="Img_cliente" class="is-required">Img Documento</label>
                                    <input type="file" id="file-input" name="imagenes[]" multiple>                            
                                    <div id="image-preview"></div>
                                </div>
                                <button type="submit" class="btn btn-success" id="add_employee_btn">Registrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <form onsubmit="validar();" action="{{ route('hostal.habitacion.storeclienteinvitadoReserva') }}" method="POST">
                    @csrf
                    <table class="tg" style="width: 100%;" id="detalles_cliente">
                        <tbody>
                            <tr>
                                <th class="text-center">N°</th>
                                <th class="text-center">Identificacion</th>
                                <th class="text-center">Nombre Completo</th>
                                <th class="text-center">Nacionalidad</th>
                                <th class="text-center">Profesion</th>
                                <th class="text-center">Edad</th>
                                <th class="text-center">Estado Civil</th>
                                <th class="text-center">Quitar</th>
                            </tr>
                        </tbody>
                    </table>
                    <br><br>
                    <input type="text" id="Reserva_id" name="Reserva_id" value="{{ $reservas->id }}" hidden> 
                    <div class="form-row" style="margin: 10px;">
                        <div class="col-md-6">
                            <label for="invitado_ingreso_reserva"  class="is-required">Ingreso</label>
                            <input class="otraclase" id="invitado_ingreso_reserva" type="date" 
                            name="invitado_ingreso_reserva" min="<?php echo date('Y-m-d') ?>" oninput="calculate()">
                        </div>
                        <div class="col-md-6">
                            <label for="invitado_salida_reserva">Salida</label>
                            <input class="otraclase" name="invitado_salida_reserva" id="invitado_salida_reserva" type="date" min="<?php echo date('Y-m-d') ?>" oninput="calculate()">
                        </div>
                    </div>
                    <div class="form-row" style="margin: 10px;">
                        <div class="col-md-6">
                            <label for="pagado"  class="is-required">Estado De Pago</label>
                            <select class="Nacionalidad_cliente" name="pagado" id="pagado">
                                <option value="SI">Pagado</option>
                                <option value="NO">POR Pagar</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="invitado_Total"  class="is-required">Estado De Pago</label>
                            <input class="otraclase" name="invitado_Total" id="invitado_Total" type="text">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        <strong style="font-size: 15px;">enviar</strong>
                    </button>
                </form>                                                  
            </div>
        </div>
    </div>
</div>
<!-- Fin Modal -->
