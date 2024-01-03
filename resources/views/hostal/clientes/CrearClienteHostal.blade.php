
<div class="modal fade bd-example-modal-lg" id="modalCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR CLIENTE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="inputNombre"  class="is-required">Documento del Cliente</label>
                                <input class="typeahead form-control" id="Documento_cliente" type="text" 
                                name="Documento_cliente" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                            </div>
                            <div class="col-md-8">
                                <label for="Nombre_cliente">Nombre Completo</label>
                                <input class="typeahead form-control" name="Nombre_cliente" 
                                id="Nombre_cliente" type="text">
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="Nacionalidad_cliente"  class="is-required">Nacionalidad</label>
                                <select class="Nacionalidad_cliente" id="Nacionalidad_cliente" name="Nacionalidad_cliente">
                                    @foreach ($countries['countries'] as $country)
                                        <option value="{{ $country['nationality'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="EstadoCivil_cliente">Estado Civil</label><br>
                                <select class="Nacionalidad_cliente" id="EstadoCivil_cliente" name="EstadoCivil_cliente">
                                    <option value="Soltero(a)">Soltero(a)</option>
                                    <option value="Casado(a)">Casado(a)</option>
                                    <option value="Viudo(a)">Viudo(a)</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="Profesion_cliente">Profesion</label>
                                <input class="typeahead form-control" name="Profesion_cliente" 
                                id="Profesion_cliente" type="text" >
                            </div>
                        </div><br>
                        <div class="form-row">
                            <div class="col-md-4">
                                <label for="fechaNacimiento">Fecha De Nacimiento</label>
                                <input class="typeahead form-control" name="fechaNacimiento" 
                                id="fechaNacimiento" type="date" onchange="calculateAge()">
                            </div>
                            <div class="col-md-2">
                                <label for="Edad_cliente"  class="is-required">Edad</label>
                                <input class="typeahead form-control" id="Edad_cliente" type="text" 
                                name="Edad_cliente" >
                            </div>
                            <div class="col-md-6">
                                <label for="Celular_cliente"  class="is-required">Numero Celular</label>
                                <input class="typeahead form-control" id="Celular_cliente" type="text" 
                                name="Celular_cliente" value=" ">
                            </div>
                        </div>  
                        <div class="footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancelar</button>
                            <button type="submit" class="btn btn-success" id="add_employee_btn">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#Documento_cliente').on('blur', function() {
    var documento = $("#Documento_cliente").val();
    var url = window.location.origin;
        $.ajax({
            url: url + '/validar-documento',
            type: 'GET',
            data: { documento: documento },
            success: function(data) {
            if (data == 'existe') {
                Swal.fire({
                    icon: 'error',
                    title: 'C.I / Passaporte',
                    text: 'EL DOCUMENTO YA EXITE NO SE PUEDE VOLVER A REGISTRAR',
                })
                $('#Documento_cliente').val('');
            }
            }
        });
    });
</script>

<script>
    function calculateAge() {
        var birthday = new Date(document.getElementById("fechaNacimiento").value);
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();
        if ( today.getMonth() < birthday.getMonth() || 
            ( today.getMonth() === birthday.getMonth() && today.getDate() < birthday.getDate() )) {
            age--;
        }
        document.getElementById("Edad_cliente").value = age;
    }
</script>
<style>
    select.form-custom::-ms-expand {
    display: none; }

    .custom-file-input:focus ~ .custom-file-label {
    border: 1px solid #ced4da;
    box-shadow: none; }
    .custom-file-input:focus ~ .custom-file-label::after {
        border: none;
        border-left: 1px solid #ced4da; }

    .lead a.btn.btn-primary.btn-lg {
    margin-top: 15px;
    border-radius: 4px; }

    .jumbotron {
    background-color: #f1f2f3; }

    .mark, mark {
    background-color: #ffeccb; }

    .code-section-container {
    margin-top: 20px;
    text-align: left; }

    .toggle-code-snippet {
    border: none;
    background-color: transparent !important;
    padding: 0px !important;
    box-shadow: none !important;
    color: #888ea8 !important;
    margin-bottom: -24px;
    border-bottom: 1px dashed #bfc9d4;
    border-radius: 0; }
    .toggle-code-snippet svg {
        color: #1b55e2; }

    .code-section {
    padding: 0;
    height: 0; }

    .code-section-container.show-code .code-section {
    margin-top: 20px;
    height: auto; }

    .code-section pre {
    margin-bottom: 0;
    height: 0;
    padding: 0;
    border-radius: 6px; }

    .code-section-container.show-code .code-section pre {
    height: auto;
    padding: 22px; }

    .code-section code {
    color: #fff; }

    /*blockquote*/
    blockquote.blockquote {
    color: #0e1726;
    padding: 20px 20px 20px 14px;
    font-size: 0.875rem;
    background-color: #ffffff;
    border-bottom-right-radius: 8px;
    border-top-right-radius: 8px;
    border: 1px solid #e0e6ed;
    border-left: 2px solid #1b55e2;
    -webkit-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);
    -moz-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);
    box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07); }
    blockquote.blockquote > p {
        margin-bottom: 0; }

    blockquote .small:before, blockquote footer:before, blockquote small:before {
    content: '\2014 \00A0'; }

    blockquote .small, blockquote footer, blockquote small {
    display: block;
    font-size: 80%;
    line-height: 1.42857143;
    color: #777; }

    blockquote.media-object.m-o-border-right {
    border-right: 4px solid #1b55e2;
    border-left: none; }

    blockquote.media-object .media .usr-img img {
    width: 55px; }

    /* Icon List */
    .list-icon {
    list-style: none;
    padding: 0;
    margin-bottom: 0; }
    .list-icon li:not(:last-child) {
        margin-bottom: 15px; }
    .list-icon svg {
        width: 18px;
        height: 18px;
        color: #1b55e2;
        margin-right: 2px;
        vertical-align: sub; }
    .list-icon .list-text {
        font-size: 14px;
        font-weight: 600;
        color: #515365;
        letter-spacing: 1px; }

    a {
    color: #515365;
    outline: none; }
    a:hover {
        color: #555555;
        text-decoration: none; }
    a:focus {
        outline: none;
        text-decoration: none; }

    button:focus {
    outline: none; }

    textarea {
    outline: none; }
    textarea:focus {
        outline: none; }

    .btn-link:hover {
    text-decoration: none; }

    span.blue {
    color: #1b55e2; }

    span.green {
    color: #8dbf42; }

    span.red {
    color: #e7515a; }

    /*      Form Group Label       */
    .form-group label, label {
    font-size: 15px;
    color: #acb0c3;
    letter-spacing: 1px; }

    /*  Disable forms     */
    .custom-control-input:disabled ~ .custom-control-label {
    color: #d3d3d3; }

    /*      Form Control       */
    .form-control {
    height: auto;
    border: 1px solid #bfc9d4;
    color: #3b3f5c;
    font-size: 15px;
    padding: 8px 10px;
    letter-spacing: 1px;
    height: calc(1.4em + 1.4rem + 2px);
    padding: .75rem 1.25rem;
    border-radius: 6px; }
    .form-control[type="range"] {
        padding: 0; }
    .form-control:focus {
        box-shadow: 0 0 5px 2px rgba(194, 213, 255, 0.619608);
        border-color: #1b55e2;
        color: #3b3f5c; }
    .form-control::-webkit-input-placeholder, .form-control::-ms-input-placeholder, .form-control::-moz-placeholder {
        color: #acb0c3;
        font-size: 15px; }
    .form-control:focus::-webkit-input-placeholder, .form-control:focus::-ms-input-placeholder, .form-control:focus::-moz-placeholder {
        color: #d3d3d3;
        font-size: 15px; }
    .form-control.form-control-lg {
        font-size: 19px;
        padding: 11px 20px; }
    .form-control.form-control-sm {
        padding: 7px 16px;
        font-size: 13px; }

    /*      Custom Select       */
    .custom-select {
    height: auto;
    border: 1px solid #f1f2f3;
    color: #3b3f5c;
    font-size: 15px;
    padding: 8px 10px;
    letter-spacing: 1px;
    background-color: #f1f2f3; }
    .custom-select.custom-select-lg {
        font-size: 18px;
        padding: 16px 20px; }
    .custom-select.custom-select-sm {
        font-size: 13px;
        padding: 7px 16px; }
    .custom-select:focus {
        box-shadow: none;
        border-color: #1b55e2;
        color: #3b3f5c; }

    /*      Form Control File       */
    .form-control-file {
    width: 100%;
    color: #5c1ac3; }
    .form-control-file::-webkit-file-upload-button {
        letter-spacing: 1px;
        padding: 9px 20px;
        text-shadow: none;
        font-size: 12px;
        color: #fff;
        font-weight: normal;
        white-space: normal;
        word-wrap: break-word;
        transition: .2s ease-out;
        touch-action: manipulation;
        cursor: pointer;
        background-color: #5c1ac3;
        box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.2);
        will-change: opacity, transform;
        transition: all 0.3s ease-out;
        -webkit-transition: all 0.3s ease-out;
        border-radius: 4px;
        border: transparent;
        outline: none; }
    .form-control-file::-ms-file-upload-button {
        letter-spacing: 1px;
        padding: 9px 20px;
        text-shadow: none;
        font-size: 14px;
        color: #fff;
        font-weight: normal;
        white-space: normal;
        word-wrap: break-word;
        transition: .2s ease-out;
        touch-action: manipulation;
        cursor: pointer;
        background-color: #5c1ac3;
        box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.2);
        will-change: opacity, transform;
        transition: all 0.3s ease-out;
        -webkit-transition: all 0.3s ease-out;
        border-radius: 4px;
        border: transparent;
        outline: none; }
    .form-control-file.form-control-file-rounded::-webkit-file-upload-button {
        -webkit-border-radius: 1.875rem !important;
        -moz-border-radius: 1.875rem !important;
        -ms-border-radius: 1.875rem !important;
        -o-border-radius: 1.875rem !important;
        border-radius: 1.875rem !important; }

    select.form-control.form-custom {
    display: inline-block;
    width: 100%;
    height: calc(2.25rem + 2px);
    vertical-align: middle;
    background: #fff url(../img/arrow-down.png) no-repeat right 0.75rem center;
    background-size: 13px 14px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none; }

    /*      Form Control Custom File       */
    .custom-file {
    height: auto; }
    .custom-file input {
        height: auto; }

    .custom-file-label {
    height: auto;
    border: 1px solid #f1f2f3;
    color: #3b3f5c;
    font-size: 15px;
    padding: 8px 10px;
    letter-spacing: 1px;
    background-color: #f1f2f3; }
    .custom-file-label::after {
        height: auto;
        padding: 8px 12px;
        color: #515365; }

    /*      Input Group      */
    .input-group button:hover, .input-group .btn:hover, .input-group button:focus, .input-group .btn:focus {
    transform: none; }

    .input-group .input-group-prepend .input-group-text {
    border: 1px solid #bfc9d4;
    background-color: #f1f2f3; }
    .input-group .input-group-prepend .input-group-text svg {
        color: #888ea8; }

    .input-group:hover .input-group-prepend .input-group-text svg {
    color: #1b55e2;
    fill: rgba(27, 85, 226, 0.239216); }

    .input-group .input-group-append .input-group-text {
    border: 1px solid #bfc9d4;
    background-color: #f1f2f3; }
    .input-group .input-group-append .input-group-text svg {
        color: #888ea8; }

    .input-group:hover .input-group-append .input-group-text svg {
    color: #1b55e2;
    fill: rgba(27, 85, 226, 0.239216); }

    /*      Input Group append       */
    /*      Input Group Append       */
    /*      Validation Customization      */
    .invalid-feedback {
    color: #e7515a;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px; }

    .valid-feedback {
    color: #8dbf42;
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px; }

    .valid-tooltip {
    background-color: #8dbf42; }

    .invalid-tooltip {
    background-color: #e7515a; }

    .custom-select.is-valid, .form-control.is-valid {
    border-color: #8dbf42;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%238dbf42' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'%3e%3cpolyline points='20 6 9 17 4 12'%3e%3c/polyline%3e%3c/svg%3e"); }

    .was-validated .custom-select:valid, .was-validated .form-control:valid {
    border-color: #8dbf42;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%238dbf42' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'%3e%3cpolyline points='20 6 9 17 4 12'%3e%3c/polyline%3e%3c/svg%3e"); }

    .custom-control-input.is-valid ~ .custom-control-label, .was-validated .custom-control-input:valid ~ .custom-control-label {
    color: #8dbf42; }

    .form-control.is-invalid, .was-validated .form-control:invalid {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23e7515a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'%3e%3cline x1='18' y1='6' x2='6' y2='18'%3e%3c/line%3e%3cline x1='6' y1='6' x2='18' y2='18'%3e%3c/line%3e%3c/svg%3e"); }

    .custom-control-input.is-invalid ~ .custom-control-label, .was-validated .custom-control-input:invalid ~ .custom-control-label {
    color: #e7515a; }

    .dropdown-toggle:after, .dropup .dropdown-toggle::after, .dropright .dropdown-toggle::after, .dropleft .dropdown-toggle::before {
    display: none; }

    .dropdown-toggle svg.feather[class*="feather-chevron-"] {
    width: 15px;
    height: 15px;
    vertical-align: middle; }

    .btn {
    padding: 0.4375rem 1.25rem;
    text-shadow: none;
    font-size: 14px;
    color: #3b3f5c;
    font-weight: normal;
    white-space: normal;
    word-wrap: break-word;
    transition: .2s ease-out;
    touch-action: manipulation;
    cursor: pointer;
    background-color: #f1f2f3;
    box-shadow: 0px 5px 20px 0 rgba(0, 0, 0, 0.1);
    will-change: opacity, transform;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out; }
    .btn svg {
        width: 20px;
        height: 20px;
        vertical-align: bottom; }
    .btn.rounded-circle {
        height: 40px;
        width: 40px;
        padding: 8px 8px; }
    .btn:hover, .btn:focus {
        color: #3b3f5c;
        background-color: #f1f2f3;
        border-color: #d3d3d3;
        -webkit-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        -moz-box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        box-shadow: 0 2px 5px 0 #e0e6ed,0 2px 10px 0 #e0e6ed;
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px); }

    .btn-group .btn:hover, .btn-group .btn:focus {
    -webkit-transform: none;
    transform: none; }

    .btn.disabled, .btn.btn[disabled] {
    background-color: #f1f2f3;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border: 1px solid rgba(0, 0, 0, 0.13); }

    .btn.disabled:hover, .btn.btn[disabled]:hover {
    cursor: not-allowed; }

    .btn .caret {
    border-top-color: #0e1726;
    margin-top: 0;
    margin-left: 3px;
    vertical-align: middle; }

    .btn + .caret, .btn + .dropdown-toggle .caret {
    margin-left: 0; }

    .btn-group > .btn, .btn-group .btn {
    padding: 8px 14px; }

    .btn-group-lg > .btn, .btn-group-lg .btn {
    font-size: 1.125rem; }

    .btn-group-lg > .btn {
    padding: .625rem 1.5rem;
    font-size: 16px; }

    .btn-lg {
    padding: .625rem 1.5rem;
    font-size: 16px; }

    .btn-group > .btn.btn-lg, .btn-group .btn.btn-lg {
    padding: .625rem 1.5rem;
    font-size: 16px; }

    .btn-group-lg > .btn, .btn-group-lg .btn {
    font-size: 1.125rem; }

    .btn-group-sm > .btn, .btn-sm {
    font-size: 0.6875rem; }

    .btn-group > .btn.btn-sm, .btn-group .btn.btn-sm {
    font-size: 0.6875rem; }

    .btn-group .dropdown-menu {
    border: 1px solid #e0e6ed;
    box-shadow: rgba(113, 106, 202, 0.2) 0px 0px 15px 1px;
    padding: 10px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial; }
    .btn-group .dropdown-menu a.dropdown-item {
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        color: #888ea8;
        padding: 11px 8px; }
        .btn-group .dropdown-menu a.dropdown-item:hover {
        background-color: #f1f2f3; }
        .btn-group .dropdown-menu a.dropdown-item svg {
        cursor: pointer;
        color: #888ea8;
        margin-right: 6px;
        vertical-align: middle;
        width: 20px;
        height: 20px;
        fill: rgba(0, 23, 55, 0.08); }
        .btn-group .dropdown-menu a.dropdown-item:hover svg {
        color: #1b55e2; }

    .dropdown:not(.custom-dropdown-icon) .dropdown-menu {
    border: none;
    border: 1px solid #e0e6ed;
    z-index: 899;
    box-shadow: rgba(113, 106, 202, 0.2) 0px 0px 15px 1px;
    padding: 10px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial; }
    .dropdown:not(.custom-dropdown-icon) .dropdown-menu a.dropdown-item {
        border-radius: 5px;
        font-size: 12px;
        font-weight: 700;
        color: #888ea8;
        padding: 11px 8px; }
        .dropdown:not(.custom-dropdown-icon) .dropdown-menu a.dropdown-item.active, .dropdown:not(.custom-dropdown-icon) .dropdown-menu a.dropdown-item:active {
        background-color: transparent;
        color: #3b3f5c;
        font-weight: 700; }
        .dropdown:not(.custom-dropdown-icon) .dropdown-menu a.dropdown-item:hover {
        color: #888ea8;
        background-color: #f1f2f3; }

    .btn-primary:not(:disabled):not(.disabled).active:focus, .btn-primary:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-primary.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-secondary:not(:disabled):not(.disabled).active:focus, .btn-secondary:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-secondary.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-success:not(:disabled):not(.disabled).active:focus, .btn-success:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-success.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-info:not(:disabled):not(.disabled).active:focus, .btn-info:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-info.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-danger:not(:disabled):not(.disabled).active:focus, .btn-danger:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-danger.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-warning:not(:disabled):not(.disabled).active:focus, .btn-warning:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-warning.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-secondary:not(:disabled):not(.disabled).active:focus, .btn-secondary:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-secondary.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-dark:not(:disabled):not(.disabled).active:focus, .btn-dark:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-dark.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-primary:not(:disabled):not(.disabled).active:focus, .btn-outline-primary:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-primary.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-success:not(:disabled):not(.disabled).active:focus, .btn-outline-success:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-success.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-info:not(:disabled):not(.disabled).active:focus, .btn-outline-info:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-info.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-danger:not(:disabled):not(.disabled).active:focus, .btn-outline-danger:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-danger.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-warning:not(:disabled):not(.disabled).active:focus, .btn-outline-warning:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-warning.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-secondary:not(:disabled):not(.disabled).active:focus, .btn-outline-secondary:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-secondary.dropdown-toggle:focus {
    box-shadow: none; }

    .btn-outline-dark:not(:disabled):not(.disabled).active:focus, .btn-outline-dark:not(:disabled):not(.disabled):active:focus {
    box-shadow: none; }

    .show > .btn-outline-dark.dropdown-toggle:focus {
    box-shadow: none; }

    .btn.focus, .btn:focus {
    box-shadow: none; }

    .btn-success:focus, .btn-info:focus, .btn-danger:focus, .btn-warning:focus, .btn-secondary:focus, .btn-dark:focus, .btn-outline-success:focus, .btn-outline-info:focus, .btn-outline-danger:focus, .btn-outline-warning:focus, .btn-outline-secondary:focus, .btn-outline-dark:focus .btn-light-default:focus, .btn-light-primary:focus, .btn-light-success:focus, .btn-light-info:focus, .btn-light-danger:focus, .btn-light-warning:focus, .btn-light-secondary:focus, .btn-light-dark:focus {
    box-shadow: none; }

    /*      Default Buttons       */
    .btn-primary {
    color: #fff !important;
    background-color: #1b55e2 !important;
    border-color: #1b55e2; }
    .btn-primary:hover, .btn-primary:focus {
        color: #fff !important;
        background-color: #1b55e2;
        box-shadow: none;
        border-color: #1b55e2; }
    .btn-primary:active, .btn-primary.active {
        background-color: #1b55e2;
        border-top: 1px solid #1b55e2; }
    .btn-primary.disabled, .btn-primary.btn[disabled], .btn-primary:disabled {
        background-color: #1b55e2;
        border-color: #1b55e2;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none; }
    .btn-primary.active.focus, .btn-primary.active:focus, .btn-primary.active:hover {
        color: #fff !important;
        background-color: #2aebcb;
        border-color: #2aebcb; }
    .btn-primary.focus:active {
        color: #fff !important;
        background-color: #2aebcb;
        border-color: #2aebcb; }
    .btn-primary:active:focus, .btn-primary:active:hover {
        color: #fff !important;
        background-color: #2aebcb;
        border-color: #2aebcb; }

    .open > .dropdown-toggle.btn-primary.focus, .open > .dropdown-toggle.btn-primary:focus, .open > .dropdown-toggle.btn-primary:hover {
    color: #fff !important;
    background-color: #2aebcb;
    border-color: #2aebcb; }

    .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active {
    color: #fff !important;
    background-color: #1b55e2;
    border-color: #1b55e2; }

    .show > .btn-primary.dropdown-toggle {
    color: #fff !important;
    background-color: #1b55e2;
    border-color: #1b55e2; }

    .btn-primary .caret {
    border-top-color: #fff; }

    .btn-group.open .btn-primary.dropdown-toggle {
    background-color: #c2d5ff; }

    .btn-secondary {
    color: #fff !important;
    background-color: #5c1ac3;
    border-color: #5c1ac3; }
    .btn-secondary:hover, .btn-secondary:focus {
        color: #fff !important;
        background-color: #5c1ac3;
        box-shadow: none;
        border-color: #5c1ac3; }
    .btn-secondary:active, .btn-secondary.active {
        background-color: #5c1ac3;
        border-top: 1px solid #5c1ac3; }
    .btn-secondary:not(:disabled):not(.disabled).active, .btn-secondary:not(:disabled):not(.disabled):active {
        color: #fff !important;
        background-color: #5c1ac3;
        border-color: #5c1ac3; }

    .show > .btn-secondary.dropdown-toggle {
    color: #fff !important;
    background-color: #5c1ac3;
    border-color: #5c1ac3; }

    .btn-secondary.disabled, .btn-secondary.btn[disabled], .btn-secondary:disabled {
    background-color: #5c1ac3;
    border-color: #5c1ac3;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }

    .btn-secondary .caret {
    border-top-color: #fff; }

    .btn-info {
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3; }
    .btn-info:hover, .btn-info:focus {
        color: #fff !important;
        background-color: #2196f3;
        box-shadow: none;
        border-color: #2196f3; }
    .btn-info:active, .btn-info.active {
        background-color: #2196f3;
        border-top: 1px solid #2196f3; }
    .btn-info:not(:disabled):not(.disabled).active, .btn-info:not(:disabled):not(.disabled):active {
        color: #fff !important;
        background-color: #2196f3;
        border-color: #2196f3; }

    .show > .btn-info.dropdown-toggle {
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3; }

    .btn-info.disabled, .btn-info.btn[disabled], .btn-info:disabled {
    background-color: #2196f3;
    border-color: #2196f3;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }

    .btn-info.active.focus, .btn-info.active:focus, .btn-info.active:hover {
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3; }

    .btn-info.focus:active {
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3; }

    .btn-info:active:focus, .btn-info:active:hover {
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3; }

    .open > .dropdown-toggle.btn-info.focus, .open > .dropdown-toggle.btn-info:focus, .open > .dropdown-toggle.btn-info:hover {
    color: #fff !important;
    background-color: #2196f3;
    border-color: #2196f3; }

    .btn-info .caret {
    border-top-color: #fff; }

    .btn-group.open .btn-info.dropdown-toggle {
    background-color: #bae7ff; }

    .btn-warning {
    color: #fff !important;
    background-color: #e2a03f;
    border-color: #e2a03f; }
    .btn-warning:hover, .btn-warning:focus {
        color: #fff !important;
        background-color: #e2a03f;
        box-shadow: none;
        border-color: #e2a03f; }
    .btn-warning:active, .btn-warning.active {
        background-color: #e2a03f;
        border-top: 1px solid #e2a03f; }
    .btn-warning:not(:disabled):not(.disabled).active, .btn-warning:not(:disabled):not(.disabled):active {
        color: #0e1726;
        background-color: #e2a03f;
        border-color: #e2a03f; }

    .show > .btn-warning.dropdown-toggle {
    color: #0e1726;
    background-color: #e2a03f;
    border-color: #e2a03f; }

    .btn-warning.disabled, .btn-warning.btn[disabled], .btn-warning:disabled {
    background-color: #e2a03f;
    border-color: #e2a03f;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }

    .btn-warning.active.focus, .btn-warning.active:focus, .btn-warning.active:hover {
    color: #fff !important;
    background-color: #e2a03f;
    border-color: #e2a03f; }

    .btn-warning.focus:active {
    color: #fff !important;
    background-color: #e2a03f;
    border-color: #e2a03f; }

    .btn-warning:active:focus, .btn-warning:active:hover {
    color: #fff !important;
    background-color: #e2a03f;
    border-color: #e2a03f; }

    .open > .dropdown-toggle.btn-warning.focus, .open > .dropdown-toggle.btn-warning:focus, .open > .dropdown-toggle.btn-warning:hover {
    color: #fff !important;
    background-color: #e2a03f;
    border-color: #e2a03f; }

    .btn-warning .caret {
    border-top-color: #fff; }

    .btn-group.open .btn-warning.dropdown-toggle {
    background-color: #df8505; }

    .btn-danger {
    color: #fff !important;
    background-color: #e7515a;
    border-color: #e7515a; }
    .btn-danger:hover, .btn-danger:focus {
        color: #fff !important;
        background-color: #e7515a;
        box-shadow: none;
        border-color: #e7515a; }
    .btn-danger:active, .btn-danger.active {
        background-color: #e7515a;
        border-top: 1px solid #e7515a; }
    .btn-danger:not(:disabled):not(.disabled).active, .btn-danger:not(:disabled):not(.disabled):active {
        color: #fff !important;
        background-color: #e7515a;
        border-color: #e7515a; }

    .show > .btn-danger.dropdown-toggle {
    color: #fff !important;
    background-color: #e7515a;
    border-color: #e7515a; }

    .btn-danger.disabled, .btn-danger.btn[disabled], .btn-danger:disabled {
    background-color: #e7515a;
    border-color: #e7515a;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }

    .btn-danger.active.focus, .btn-danger.active:focus, .btn-danger.active:hover {
    color: #fff !important;
    background-color: #c00;
    border-color: #c00; }

    .btn-danger.focus:active {
    color: #fff !important;
    background-color: #c00;
    border-color: #c00; }

    .btn-danger:active:focus, .btn-danger:active:hover {
    color: #fff !important;
    background-color: #c00;
    border-color: #c00; }

    .open > .dropdown-toggle.btn-danger.focus, .open > .dropdown-toggle.btn-danger:focus, .open > .dropdown-toggle.btn-danger:hover {
    color: #fff !important;
    background-color: #c00;
    border-color: #c00; }

    .btn-danger .caret {
    border-top-color: #fff; }

    .btn-group.open .btn-danger.dropdown-toggle {
    background-color: #a9302a; }

    .btn-dark {
    color: #fff !important;
    background-color: #3b3f5c;
    border-color: #3b3f5c; }
    .btn-dark:hover, .btn-dark:focus {
        color: #fff !important;
        background-color: #3b3f5c;
        box-shadow: none;
        border-color: #3b3f5c; }
    .btn-dark:active, .btn-dark.active {
        background-color: #3b3f5c;
        border-top: 1px solid #3b3f5c; }
    .btn-dark:not(:disabled):not(.disabled).active, .btn-dark:not(:disabled):not(.disabled):active {
        color: #fff !important;
        background-color: #3b3f5c;
        border-color: #3b3f5c; }

    .show > .btn-dark.dropdown-toggle {
    color: rgb(188, 32, 32) !important;
    background-color: #3b3f5c;
    border-color: #3b3f5c; }

    .btn-dark.disabled, .btn-dark.btn[disabled], .btn-dark:disabled {
    background-color: #3b3f5c;
    border-color: #3b3f5c;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }

    .btn-dark .caret {
    border-top-color: #fff; }

    .btn-group.open .btn-dark.dropdown-toggle {
    background-color: #484848; }

    .btn-success {
    color: #fff !important;
    background-color: #8dbf42;
    border-color: #8dbf42; }
    .btn-success:hover, .btn-success:focus {
        color: #fff !important;
        background-color: #8dbf42;
        box-shadow: none;
        border-color: #8dbf42; }
    .btn-success:active, .btn-success.active {
        background-color: #8dbf42;
        border-top: 1px solid #8dbf42; }
    .btn-success:not(:disabled):not(.disabled).active, .btn-success:not(:disabled):not(.disabled):active {
        color: #fff !important;
        background-color: #8dbf42;
        border-color: #8dbf42; }

    .show > .btn-success.dropdown-toggle {
    color: #fff !important;
    background-color: #8dbf42;
    border-color: #8dbf42; }

    .btn-success.disabled, .btn-success.btn[disabled], .btn-success:disabled {
    background-color: #8dbf42;
    border-color: #8dbf42;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }

    .btn-success.active.focus, .btn-success.active:focus, .btn-success.active:hover {
    color: #fff !important;
    background-color: #17c678;
    border-color: #17c678; }

    .btn-success.focus:active {
    color: #fff !important;
    background-color: #17c678;
    border-color: #17c678; }

    .btn-success:active:focus, .btn-success:active:hover {
    color: #fff !important;
    background-color: #17c678;
    border-color: #17c678; }

    .open > .dropdown-toggle.btn-success.focus, .open > .dropdown-toggle.btn-success:focus, .open > .dropdown-toggle.btn-success:hover {
    color: #fff !important;
    background-color: #17c678;
    border-color: #17c678; }

    .btn-success .caret {
    border-top-color: #fff; }

    /*-----/Button Light Colors------*/
    .btn.box-shadow-none {
    border: none; }
    .btn.box-shadow-none:hover, .btn.box-shadow-none:focus {
        border: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        background-color: transparent; }

    .box-shadow-none {
    -webkit-box-shadow: none !important;
    -moz-box-shadow: none !important;
    box-shadow: none !important; }

    .btn.box-shadow-none:not(:disabled):not(.disabled).active, .btn.box-shadow-none:not(:disabled):not(.disabled):active {
    border: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    background-color: transparent; }

    .show > .btn.box-shadow-none.dropdown-toggle {
    border: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    background-color: transparent; }

    .btn-group.open .btn-success.dropdown-toggle {
    background-color: #499249; }

    .btn-dismiss {
    color: #0e1726;
    background-color: #fff !important;
    border-color: #fff;
    padding: 3px 7px; }
    .btn-dismiss:hover, .btn-dismiss:focus {
        color: #0e1726;
        background-color: #fff; }
    .btn-dismiss:active, .btn-dismiss.active {
        background-color: #fff;
        border-top: 1px solid #fff; }

    .btn-group > .btn i {
    margin-right: 3px; }

    .btn-group > .btn:first-child:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
    -webkit-box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.16), 0 0px 0px 0 rgba(0, 0, 0, 0.12);
    -moz-box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.16), 0 0px 0px 0 rgba(0, 0, 0, 0.12);
    box-shadow: 0 0px 0px 0 rgba(0, 0, 0, 0.16), 0 0px 0px 0 rgba(0, 0, 0, 0.12); }

    .btn-group > .btn + .dropdown-toggle {
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none; }
    .btn-group > .btn + .dropdown-toggle.btn-primary {
        border-left: 1px solid #4468fd; }
    .btn-group > .btn + .dropdown-toggle.btn-success {
        border-left: 1px solid #a3c66f; }
    .btn-group > .btn + .dropdown-toggle.btn-info {
        border-left: 1px solid #49acfb; }
    .btn-group > .btn + .dropdown-toggle.btn-warning {
        border-left: 1px solid #f5b455; }
    .btn-group > .btn + .dropdown-toggle.btn-danger {
        border-left: 1px solid #f1848b; }
    .btn-group > .btn + .dropdown-toggle.btn-dark {
        border-left: 1px solid #70767a; }
    .btn-group > .btn + .dropdown-toggle.btn-secondary {
        border-left: 1px solid #8353dc; }

    .btn-group.dropleft .dropdown-toggle-split {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0; }

    .btn-group.dropleft .btn-primary:not(.dropdown-toggle-split) {
    border-left: 1px solid #4468fd; }

    .btn-group.dropleft .btn-success:not(.dropdown-toggle-split) {
    border-left: 1px solid #a3c66f; }

    .btn-group.dropleft .btn-info:not(.dropdown-toggle-split) {
    border-left: 1px solid #49acfb; }

    .btn-group.dropleft .btn-warning:not(.dropdown-toggle-split) {
    border-left: 1px solid #f5b455; }

    .btn-group.dropleft .btn-danger:not(.dropdown-toggle-split) {
    border-left: 1px solid #f1848b; }

    .btn-group.dropleft .btn-dark:not(.dropdown-toggle-split) {
    border-left: 1px solid #70767a; }

    .btn-group.dropleft .btn-secondary:not(.dropdown-toggle-split) {
    border-left: 1px solid #8353dc; }

    /*
        Btn group dropdown-toggle
    */
    .btn .badge.badge-align-right {
    position: absolute;
    top: -1px;
    right: 8px; }

    .dropup .btn .caret {
    border-bottom-color: #0e1726; }

    .btn-outline-primary:not(:disabled):not(.disabled).active, .btn-outline-primary:not(:disabled):not(.disabled):active {
    background-color: #1b55e2;
    color: #fff !important; }

    .show > .btn-outline-primary.dropdown-toggle {
    background-color: #1b55e2;
    color: #fff !important; }

    .btn-outline-success:not(:disabled):not(.disabled).active, .btn-outline-success:not(:disabled):not(.disabled):active {
    background-color: #8dbf42;
    color: #fff !important; }

    .show > .btn-outline-success.dropdown-toggle {
    background-color: #8dbf42;
    color: #fff !important; }

    .btn-outline-info:not(:disabled):not(.disabled).active, .btn-outline-info:not(:disabled):not(.disabled):active {
    background-color: #2196f3;
    color: #fff !important; }

    .show > .btn-outline-info.dropdown-toggle {
    background-color: #2196f3;
    color: #fff !important; }

    .btn-outline-danger:not(:disabled):not(.disabled).active, .btn-outline-danger:not(:disabled):not(.disabled):active {
    background-color: #e7515a;
    color: #fff !important; }

    .show > .btn-outline-danger.dropdown-toggle {
    background-color: #e7515a;
    color: #fff !important; }

    .btn-outline-warning:not(:disabled):not(.disabled).active, .btn-outline-warning:not(:disabled):not(.disabled):active {
    background-color: #e2a03f;
    color: #fff !important; }

    .show > .btn-outline-warning.dropdown-toggle {
    background-color: #e2a03f;
    color: #fff !important; }

    .btn-outline-secondary:not(:disabled):not(.disabled).active, .btn-outline-secondary:not(:disabled):not(.disabled):active {
    background-color: #5c1ac3;
    color: #fff !important; }

    .show > .btn-outline-secondary.dropdown-toggle {
    background-color: #5c1ac3;
    color: #fff !important; }

    .btn-outline-dark:not(:disabled):not(.disabled).active, .btn-outline-dark:not(:disabled):not(.disabled):active {
    background-color: #3b3f5c;
    color: #fff !important; }

    .show > .btn-outline-dark.dropdown-toggle {
    background-color: #3b3f5c;
    color: #fff !important; }

    .show > .btn-outline-primary.dropdown-toggle:after, .show > .btn-outline-success.dropdown-toggle:after, .show > .btn-outline-info.dropdown-toggle:after, .show > .btn-outline-danger.dropdown-toggle:after, .show > .btn-outline-warning.dropdown-toggle:after, .show > .btn-outline-secondary.dropdown-toggle:after, .show > .btn-outline-dark.dropdown-toggle:after, .show > .btn-outline-primary.dropdown-toggle:before, .show > .btn-outline-success.dropdown-toggle:before, .show > .btn-outline-info.dropdown-toggle:before, .show > .btn-outline-danger.dropdown-toggle:before, .show > .btn-outline-warning.dropdown-toggle:before, .show > .btn-outline-secondary.dropdown-toggle:before, .show > .btn-outline-dark.dropdown-toggle:before {
    color: #fff !important; }

    .btn-outline-primary {
    border: 1px solid #1b55e2 !important;
    color: #1b55e2 !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-info {
    border: 1px solid #2196f3 !important;
    color: #2196f3 !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-warning {
    border: 1px solid #e2a03f !important;
    color: #e2a03f !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-success {
    border: 1px solid #8dbf42 !important;
    color: #8dbf42 !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-danger {
    border: 1px solid #e7515a !important;
    color: #e7515a !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-secondary {
    border: 1px solid #5c1ac3 !important;
    color: #5c1ac3 !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-dark {
    border: 1px solid #3b3f5c !important;
    color: #3b3f5c !important;
    background-color: transparent;
    box-shadow: none; }

    .btn-outline-primary:hover, .btn-outline-info:hover, .btn-outline-warning:hover, .btn-outline-success:hover, .btn-outline-danger:hover, .btn-outline-secondary:hover, .btn-outline-dark:hover {
    box-shadow: 0px 5px 20px 0 rgba(0, 0, 0, 0.1); }

    .btn-outline-primary:hover {
    color: #fff !important;
    background-color: #1b55e2; }

    .btn-outline-info:hover {
    color: #fff !important;
    background-color: #2196f3; }

    .btn-outline-warning:hover {
    color: #fff !important;
    background-color: #e2a03f; }

    .btn-outline-success:hover {
    color: #fff !important;
    background-color: #8dbf42; }

    .btn-outline-danger:hover {
    color: #fff !important;
    background-color: #e7515a; }

    .btn-outline-secondary:hover {
    color: #fff !important;
    background-color: #5c1ac3; }

    .btn-outline-dark:hover {
    color: #fff !important;
    background-color: #3b3f5c; }

    /*      Dropdown Toggle       */
    .btn-rounded {
    -webkit-border-radius: 1.875rem !important;
    -moz-border-radius: 1.875rem !important;
    -ms-border-radius: 1.875rem !important;
    -o-border-radius: 1.875rem !important;
    border-radius: 1.875rem !important; }

    /*
        ===========================
            Data Marker ( dot )
        ===========================
    */
    .data-marker {
    padding: 2px;
    border-radius: 50%;
    font-size: 18px;
    display: inline-flex;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    align-items: center;
    justify-content: center; }

    .data-marker-success {
    background-color: #8dbf42; }

    .data-marker-warning {
    background-color: #e2a03f; }

    .data-marker-danger, .data-marker-info, .data-marker-dark {
    background-color: #e7515a; }

    .badge {
    font-weight: 600;
    line-height: 1.4;
    padding: 3px 6px;
    font-size: 12px;
    font-weight: 600;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out; }
    .badge:hover {
        transition: all 0.3s ease-out;
        -webkit-transition: all 0.3s ease-out;
        -webkit-transform: translateY(-3px);
        transform: translateY(-3px); }
    .badge.badge-enabled {
        background-color: #8dbf42;
        color: #fff; }
    .badge.badge-disable {
        background-color: #e7515a;
        color: #fff; }

    .badge-pills {
    border-radius: 30px; }

    .badge-classic {
    border-radius: 0; }

    .badge-collapsed-img img {
    width: 40px;
    height: 40px;
    border-radius: 20px;
    border: 2px solid #ffffff;
    box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.3);
    margin-left: -21px; }

    .badge-collapsed-img.badge-tooltip img {
    width: 40px;
    height: 40px;
    border-radius: 20px;
    border: 2px solid #ffffff;
    box-shadow: 0px 0px 15px 1px rgba(113, 106, 202, 0.3);
    margin-left: -21px;
    -webkit-transition: all 0.35s ease;
    transition: all 0.35s ease; }
    .badge-collapsed-img.badge-tooltip img:hover {
        -webkit-transform: translateY(-5px) scale(1.02);
        transform: translateY(-5px) scale(1.02); }

    .badge-collapsed-img.translateY-axis img {
    -webkit-transition: all 0.35s ease;
    transition: all 0.35s ease; }
    .badge-collapsed-img.translateY-axis img:hover {
        -webkit-transform: translateY(-5px) scale(1.02);
        transform: translateY(-5px) scale(1.02); }

    .badge-collapsed-img.rectangle-collapsed img {
    width: 45px;
    height: 32px; }

    .badge-collapsed-img.translateX-axis img {
    -webkit-transition: all 0.35s ease;
    transition: all 0.35s ease; }
    .badge-collapsed-img.translateX-axis img:hover {
        -webkit-transform: translateX(5px) scale(1.02);
        transform: translateX(5px) scale(1.02); }

    .badge-primary {
    color: #fff;
    background-color: #1b55e2; }

    .badge-info {
    color: #fff;
    background-color: #2196f3; }

    .badge-success {
    color: #fff;
    background-color: #8dbf42; }

    .badge-danger {
    color: #fff;
    background-color: #e7515a; }

    .badge-warning {
    color: #fff;
    background-color: #e2a03f; }

    .badge-dark {
    color: #fff;
    background-color: #3b3f5c; }

    .badge-secondary {
    background-color: #5c1ac3; }

    .outline-badge-primary {
    color: #1b55e2;
    background-color: transparent;
    border: 1px solid #1b55e2; }

    .outline-badge-info {
    color: #2196f3;
    background-color: transparent;
    border: 1px solid #2196f3; }

    .outline-badge-success {
    color: #8dbf42;
    background-color: transparent;
    border: 1px solid #8dbf42; }

    .outline-badge-danger {
    color: #e7515a;
    background-color: transparent;
    border: 1px solid #e7515a; }

    .outline-badge-warning {
    color: #e2a03f;
    background-color: transparent;
    border: 1px solid #e2a03f; }

    .outline-badge-dark {
    color: #3b3f5c;
    background-color: transparent;
    border: 1px solid #3b3f5c; }

    .outline-badge-secondary {
    color: #5c1ac3;
    background-color: transparent;
    border: 1px solid #5c1ac3; }

    .outline-badge-primary:focus, .outline-badge-primary:hover {
    background-color: #c2d5ff;
    color: #1b55e2; }

    .outline-badge-secondary:focus, .outline-badge-secondary:hover {
    color: #5c1ac3;
    background-color: #dccff7; }

    .outline-badge-success:focus, .outline-badge-success:hover {
    color: #8dbf42;
    background-color: #e6ffbf; }

    .outline-badge-danger:focus, .outline-badge-danger:hover {
    color: #e7515a;
    background-color: #ffe1e2; }

    .outline-badge-warning:focus, .outline-badge-warning:hover {
    color: #e2a03f;
    background-color: #ffeccb; }

    .outline-badge-info:focus, .outline-badge-info:hover {
    color: #2196f3;
    background-color: #bae7ff; }

    .outline-badge-dark:focus, .outline-badge-dark:hover {
    color: #3b3f5c;
    background-color: #acb0c3; }

    /*      Link     */
    .badge[class*="link-badge-"] {
    cursor: pointer; }

    .link-badge-primary {
    color: #1b55e2;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-info {
    color: #2196f3;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-success {
    color: #8dbf42;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-danger {
    color: #e7515a;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-warning {
    color: #e2a03f;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-dark {
    color: #3b3f5c;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-secondary {
    color: #5c1ac3;
    background-color: transparent;
    border: 1px solid transparent; }

    .link-badge-primary:focus, .link-badge-primary:hover {
    color: #1b55e2;
    background-color: transparent; }

    .link-badge-secondary:focus, .link-badge-secondary:hover {
    color: #6f51ea;
    background-color: transparent; }

    .link-badge-success:focus, .link-badge-success:hover {
    color: #2ea37d;
    background-color: transparent; }

    .link-badge-danger:focus, .link-badge-danger:hover {
    color: #e7515a;
    background-color: transparent; }

    .link-badge-warning:focus, .link-badge-warning:hover {
    color: #dea82a;
    background-color: transparent; }

    .link-badge-info:focus, .link-badge-info:hover {
    color: #009eda;
    background-color: transparent; }

    .link-badge-dark:focus, .link-badge-dark:hover {
    color: #454656;
    background-color: transparent; }

    /* Custom Dropdown*/
    .custom-dropdown .dropdown-toggle::after, .custom-dropdown-icon .dropdown-toggle::after, .custom-dropdown .dropdown-toggle::before, .custom-dropdown-icon .dropdown-toggle::before {
    display: none; }

    .custom-dropdown .dropdown-menu, .custom-dropdown-icon .dropdown-menu {
    min-width: 11rem;
    border-radius: 4px;
    border: none;
    border: 1px solid #e0e6ed;
    z-index: 899;
    box-shadow: rgba(113, 106, 202, 0.2) 0px 0px 15px 1px;
    top: 15px !important;
    padding: 10px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial; }

    .custom-dropdown .dropdown-item.active, .custom-dropdown .dropdown-item:active, .custom-dropdown .dropdown-item:hover {
    color: #888ea8;
    background-color: #f1f2f3; }

    .custom-dropdown-icon .dropdown-item.active, .custom-dropdown-icon .dropdown-item:active, .custom-dropdown-icon .dropdown-item:hover {
    color: #888ea8;
    background-color: #f1f2f3; }

    .custom-dropdown .dropdown-item {
    font-size: 13px;
    color: #888ea8;
    display: block;
    font-weight: 700;
    padding: 11px 8px;
    font-size: 12px; }

    .custom-dropdown-icon .dropdown-item {
    font-size: 13px;
    color: #888ea8;
    display: block;
    font-weight: 700;
    padding: 11px 8px;
    font-size: 12px; }

    .custom-dropdown-icon .dropdown-menu .dropdown-item svg {
    width: 20px;
    height: 20px;
    margin-right: 3px;
    color: #888ea8; }

    .custom-dropdown .dropdown-item.active svg, .custom-dropdown .dropdown-item:active svg, .custom-dropdown .dropdown-item:hover svg {
    color: #1b55e2; }

    .custom-dropdown-icon .dropdown-item.active svg, .custom-dropdown-icon .dropdown-item:active svg, .custom-dropdown-icon .dropdown-item:hover svg {
    color: #1b55e2; }

    .status.rounded-tooltip .tooltip-inner {
    border-radius: 20px;
    padding: 8px 20px; }

    .tooltip-inner {
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0; }

    .popover {
    z-index: 999;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    border-bottom-color: #b3b3b3; }

    input[disabled], select[disabled], textarea[disabled], input[readonly], select[readonly], textarea[readonly] {
    cursor: not-allowed;
    background-color: #f1f2f3 !important;
    color: #acb0c3; }

    .help-block, .help-inline {
    color: #555555; }

    .controls {
    position: relative; }

    .search-form-control {
    border-radius: .25rem; }

    /*  Table   */
    .table-bordered {
    border: 1px solid #f1f2f3; }

    .table-striped tbody tr:nth-of-type(odd) {
    background-color: #f1f2f3 !important; }

    .table > tbody > tr > td {
    vertical-align: middle;
    color: #515365;
    font-size: 13px;
    letter-spacing: 1px; }

    .table > thead > tr > th {
    color: white;
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase; }

    .table > tbody > tr > td .usr-img-frame {
    background-color: #ebedf2;
    padding: 2px;
    width: 35px;
    height: 35px; }
    .table > tbody > tr > td .usr-img-frame img {
        width: 35px;
        margin: 0; }

    .table > tbody > tr > td .admin-name {
    font-weight: 700;
    color: #515365; }

    .table > tbody > tr > td .progress {
    width: 135px;
    height: 6px;
    margin: auto 0; }

    .table > tbody > tr > td svg.icon {
    width: 21px; }

    .table > tbody > tr > td .t-dot {
    background-color: #000;
    height: 11px;
    width: 11px;
    border-radius: 50%;
    cursor: pointer;
    margin: 0 auto; }

    .table > tbody > tr > td svg.t-icon {
    padding: 5px;
    border-radius: 50%;
    font-size: 11px;
    vertical-align: sub;
    cursor: pointer; }
    .table > tbody > tr > td svg.t-icon.t-hover-icon:hover {
        background-color: #e7515a;
        color: #fff; }

    .table-bordered td, .table-bordered th {
    border: 1px solid #ebedf2; }

    .table thead th {
    vertical-align: bottom;
    border-bottom: none; }

    .table-hover:not(.table-dark) tbody tr:hover {
    background-color: #f1f2f3 !important; }

    .table-controls > li > a svg {
    color: #25d5e4; }

    .table tr td .custom-dropdown.t-custom-dropdown a.dropdown-toggle, .table tr td .custom-dropdown-icon.t-custom-dropdown a.dropdown-toggle {
    border-radius: 5px;
    border: 1px solid #d3d3d3; }

    .table-controls > li > a svg {
    color: #ffffff;
    width: 21px; }

    /*  Table Dark      */
    .table.table-dark > thead > tr > th {
    color: #d3d3d3; }

    .table.table-dark > tbody > tr > td {
    color: #ffffff; }

    .table-dark {
    background-color: #060818; }
    .table-dark.table-hover tbody tr {
        background-color: #060818; }
    .table-dark td, .table-dark th, .table-dark thead th {
        border-color: #191e3a !important; }
    .table-dark.table-hover tbody tr:hover {
        background-color: rgba(25, 30, 58, 0.631373); }

    .table.table-dark > tbody > tr > td i.t-icon {
    padding: 5px;
    border-radius: 50%;
    font-size: 14px;
    vertical-align: sub;
    cursor: pointer;
    color: #0e1726 !important; }

    table .badge-success, table .badge-primary, table .badge-warning, table .badge-danger, table .badge-info, table .badge-secondary, table .badge-dark {
    box-shadow: 0px 5px 20px 0 rgba(0, 0, 0, 0.2);
    will-change: opacity, transform;
    transition: all 0.3s ease-out;
    -webkit-transition: all 0.3s ease-out; }

    .table > tfoot > tr > th {
    color: #3b3f5c; }

    .table-vertical-align tr, .table-vertical-align th, .table-vertical-align td {
    vertical-align: middle !important; }

    .statbox .widget-content:before, .statbox .widget-content:after {
    display: table;
    content: "";
    line-height: 0;
    clear: both; }

    .nav-tabs > li > a {
    -webkit-border-radius: 0 !important;
    -moz-border-radius: 0 !important;
    border-radius: 0 !important; }

    .btn-toolbar {
    margin-left: 0px; }

    @media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
    .input-group > .form-control {
        flex: 1 1 auto;
        width: 1%; } }

    .spin {
    -webkit-animation: spin 2s infinite linear;
    animation: spin 2s infinite linear; }

    @keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg); }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg); } }

    @-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg); }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg); } }

    .toast-primary {
    background: #1b55e2; }

    .toast-header {
    background: #1b55e2;
    color: #fff;
    border-bottom: 1px solid rgba(33, 150, 243, 0.341176); }
    .toast-header .meta-time {
        color: #f1f2f3; }
    .toast-header .close {
        color: #f1f2f3;
        opacity: 1;
        text-shadow: none; }

    .toast-body {
    padding: 16px 12px;
    color: #fff; }

    /*  
        ==========================
            Background Colors  
        ==========================
    */
    /*  
        Default  
    */
    .bg-primary {
    background-color: #1b55e2 !important;
    border-color: #1b55e2;
    color: #fff; }

    .bg-success {
    background-color: #8dbf42 !important;
    border-color: #8dbf42;
    color: #fff; }

    .bg-info {
    background-color: #2196f3 !important;
    border-color: #2196f3;
    color: #fff; }

    .bg-warning {
    background-color: #e2a03f !important;
    border-color: #e2a03f;
    color: #fff; }

    .bg-danger {
    background-color: #e7515a !important;
    border-color: #e7515a;
    color: #fff; }

    .bg-secondary {
    background-color: #5c1ac3 !important;
    border-color: #5c1ac3;
    color: #fff; }

    .bg-dark {
    background-color: #fff;
    border-color: #3b3f5c;
    color: #fff; }

    /*  
        Light Background  
    */
    .bg-light-primary {
    background-color: #c2d5ff !important;
    border-color: #c2d5ff;
    color: #2196f3; }

    .bg-light-success {
    background-color: #e6ffbf !important;
    border-color: #e6ffbf;
    color: #8dbf42; }

    .bg-light-info {
    background-color: #bae7ff !important;
    border-color: #bae7ff;
    color: #2196f3; }

    .bg-light-warning {
    background-color: #ffeccb !important;
    border-color: #ffeccb;
    color: #e2a03f; }

    .bg-light-danger {
    background-color: #ffe1e2 !important;
    border-color: #ffe1e2;
    color: #e7515a; }

    .bg-light-secondary {
    background-color: #dccff7 !important;
    border-color: #dccff7;
    color: #5c1ac3; }

    .bg-light-dark {
    background-color: #acb0c3;
    border-color: #acb0c3;
    color: #fff; }

    /*  
        Progress Bar
    */
    .progress {
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    background-color: #ebedf2;
    margin-bottom: 1.25rem;
    height: 16px;
    box-shadow: 1px 3px 20px 3px #f1f2f3; }
    .progress.progress-bar-stack .progress-bar:last-child {
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px; }
    .progress .progress-bar {
        font-size: 10px;
        font-weight: 700;
        box-shadow: 0 2px 4px rgba(0, 69, 255, 0.15), 0 8px 16px rgba(0, 69, 255, 0.2);
        font-size: 12px;
        letter-spacing: 1px;
        font-weight: 100; }
    .progress:not(.progress-bar-stack) .progress-bar {
        border-radius: 16px; }

    .progress-sm {
    height: 4px; }

    .progress-md {
    height: 10px; }

    .progress-lg {
    height: 20px; }

    .progress-xl {
    height: 25px; }

    .progress-striped .progress-bar {
    background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
    background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-image: -o-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent); }

    .progress .progress-title {
    display: flex;
    justify-content: space-between;
    padding: 15px; }
    .progress .progress-title span {
        align-self: center; }

    .progress .progress-bar.bg-gradient-primary {
    background-color: #1b55e2;
    background: linear-gradient(to right, #0081ff 0%, #0045ff 100%); }

    .progress .progress-bar.bg-gradient-info {
    background-color: #1b55e2;
    background-image: linear-gradient(to right, #04befe 0%, #4481eb 100%); }

    .progress .progress-bar.bg-gradient-success {
    background-color: #1b55e2;
    background-image: linear-gradient(to right, #3cba92 0%, #0ba360 100%); }

    .progress .progress-bar.bg-gradient-warning {
    background-color: #1b55e2;
    background-image: linear-gradient(to right, #f09819 0%, #ff5858 100%); }

    .progress .progress-bar.bg-gradient-secondary {
    background-color: #1b55e2;
    background-image: linear-gradient(to right, #7579ff 0%, #b224ef 100%); }

    .progress .progress-bar.bg-gradient-danger {
    background-color: #1b55e2;
    background-image: linear-gradient(to right, #d09693 0%, #c71d6f 100%); }

    .progress .progress-bar.bg-gradient-dark {
    background-color: #1b55e2;
    background-image: linear-gradient(to right, #2b5876 0%, #4e4376 100%); }

    .br-0 {
    border-radius: 0 !important; }

    .br-4 {
    border-radius: 4px !important; }

    .br-6 {
    border-radius: 6px !important; }

    .br-30 {
    border-radius: 30px !important; }

    .br-50 {
    border-radius: 50px !important; }

    .br-left-30 {
    border-top-left-radius: 30px !important;
    border-bottom-left-radius: 30px !important; }

    .br-right-30 {
    border-top-right-radius: 30px !important;
    border-bottom-right-radius: 30px !important; }

    .bx-top-6 {
    border-top-right-radius: 6px !important;
    border-top-left-radius: 6px !important; }

    .bx-bottom-6 {
    border-bottom-right-radius: 6px !important;
    border-bottom-left-radius: 6px !important; }

    /*      Badge Custom      */
    .badge.counter {
    position: absolute;
    z-index: 2;
    right: 0;
    top: -10px;
    font-weight: 600;
    width: 19px;
    height: 19px;
    border-radius: 50%;
    padding: 2px 0px;
    font-size: 12px; }

    .badge-chip {
    display: inline-block;
    padding: 0 25px;
    font-size: 16px;
    line-height: 42px;
    border-radius: 25px; }
    .badge-chip img {
        float: left;
        margin: 0px 10px 0px -26px;
        height: 44px;
        width: 44px;
        border-radius: 50%; }
    .badge-chip .closebtn {
        color: #f1f2f3;
        font-weight: bold;
        float: right;
        font-size: 20px;
        cursor: pointer; }
        .badge-chip .closebtn:hover {
        color: #fff; }

    /*-------text-colors------*/
    .text-primary {
    color: #1b55e2 !important; }

    .text-success {
    color: #8dbf42 !important; }

    .text-info {
    color: #2196f3 !important; }

    .text-danger {
    color: #e7515a !important; }

    .text-warning {
    color: #e2a03f !important; }

    .text-secondary {
    color: #5c1ac3 !important; }

    .text-dark {
    color: #3b3f5c !important; }

    .text-muted {
    color: #888ea8 !important; }

    .text-white {
    color: #fff !important; }

    .text-black {
    color: #000 !important; }

    /*-----border main------*/
    .border {
    border: 1px solid !important; }

    .border-bottom {
    border-bottom: 1px solid !important; }

    .border-top {
    border-top: 1px solid !important; }

    .border-right {
    border-right: 1px solid !important; }

    .border-left {
    border-left: 1px solid !important; }

    .border-primary {
    border-color: #1b55e2 !important; }

    .border-info {
    border-color: #2196f3 !important; }

    .border-warning {
    border-color: #e2a03f !important; }

    .border-success {
    border-color: #8dbf42 !important; }

    .border-danger {
    border-color: #e7515a !important; }

    .border-secondary {
    border-color: #5c1ac3 !important; }

    .border-dark {
    border-color: #3b3f5c !important; }

    /*-----border style------*/
    .border-dotted {
    border-style: dotted !important; }

    .border-dashed {
    border-style: dashed !important; }

    .border-solid {
    border-style: solid !important; }

    .border-double {
    border-style: double !important; }

    /*-----border width------*/
    .border-width-1px {
    border-width: 1px !important; }

    .border-width-2px {
    border-width: 2px !important; }

    .border-width-3px {
    border-width: 3px !important; }

    .border-width-4px {
    border-width: 4px !important; }

    .border-width-5px {
    border-width: 5px !important; }

    .border-width-6px {
    border-width: 6px !important; }

    /*-----transform-position------*/
    .position-absolute {
    position: absolute; }

    .position-static {
    position: static; }

    .position-fixed {
    position: fixed; }

    .position-inherit {
    position: inherit; }

    .position-initial {
    position: initial; }

    .position-relative {
    position: relative; }

</style>