<div class="modal fade bd-example-modal-sm" id="Actualizar{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">AUMENTAR STOCK</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" style="height: 100%;">
                <div>
                <form method="POST" action="{{ route('updatestock', $producto->id) }}">
                @method('PUT')
                @csrf
                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="Nombre_categoria" style="text-align: right;">Añadir Mas STOCK a <strong style="color: black">{{$producto->Nombre_producto}}</strong>:</label>
                            <input type="number" name="stock" id="stock" class="form-control">
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="">Image</label>
                            <img id="captcha-image" src="{{ route('mathCaptchaImage') }}" alt="captcha">
                        </div>
                        <div class="col-md-6">
                            <label for="">Resultado</label>
                            <input class="form-control" type="text" name="math_captcha" id="math_captcha">
                        </div>
                    </div><br>
                        <span style="color: red; font-size: 10px;">*NOTA: es necesario resolver el captcha*</span><br><br>  
                        <button id="submit-button" type="submit" class="btn btn-primary" disabled>Guardar Cambios</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div> 

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            var submitButtons = $(this).find('[id="submit-button"]');
            var mathCaptchaInputs = $(this).find('[id="math_captcha"]');
            mathCaptchaInputs.on('input', function() {
                var userInput = mathCaptchaInputs.val();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('validateMathCaptcha') }}',
                    data: {
                        math_captcha: userInput,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        if(result.valid) {
                            submitButtons.prop('disabled', false);
                        } else {
                            submitButtons.prop('disabled', true);
                        }
                    }
                });
            });
        });
    });
</script>
