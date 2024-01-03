<div class="modal fade bd-example-modal-lg" id="modalnovedades" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">REGISTRAR LIBRO DE NOVEDADES</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
                <form action="{{ route('admin.novedades.StoreNovedadProblema') }}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-row">
                        <input class="typeahead form-control" name="caja_id" id="caja_id" type="text" value="{{$caja->id}}" hidden>
                        <input type="text" name="user_id" value="{{ Auth::id() }}" hidden>
                        <div class="col-md-6">
                            <label for=""><strong style="color: black">CONTROLES</strong></label>
                            <button onclick="seleccionarTodo(event)">Seleccionar todo</button>
                            <div class="form-row">                                        
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_1">Control 1</label>
                                        <input type="checkbox" id="control_1" name="controles[]" value="1" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_4">Control 4</label>
                                        <input type="checkbox" id="control_4" name="controles[]" value="4" style="margin-left: 15px;">
                                    </div>                                    
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_7">Control 7</label>
                                        <input type="checkbox" id="control_7" name="controles[]" value="7" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_10">Control 10</label>
                                        <input type="checkbox" id="control_10" name="controles[]" value="10" style="margin-left: 8px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_13">Control 13</label>
                                        <input type="checkbox" id="control_13" name="controles[]" value="13" style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_2">Control 2</label>
                                        <input type="checkbox" id="control_2" name="controles[]" value="2"  style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_5">Opción 5</label>
                                        <input type="checkbox" id="control_5" name="controles[]" value="5" style="margin-left: 15px;">
                                    </div>                                    
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_8">Control 8</label>
                                        <input type="checkbox" id="control_8" name="controles[]" value="8"  style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_11">Control 11</label>
                                        <input type="checkbox" id="control_11" name="controles[]" value="11" style="margin-left: 8px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_14">Control 14</label>
                                        <input type="checkbox" id="control_14" name="controles[]" value="14"  style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_3">Control 3</label>
                                        <input type="checkbox" id="control_3" name="controles[]" value="3"  style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_6">Control 6</label>
                                        <input type="checkbox" id="control_6" name="controles[]" value="6" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_9">Control 9</label>
                                        <input type="checkbox" id="control_9" name="controles[]" value="9"  style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_12">Control 12</label>
                                        <input type="checkbox" id="control_12" name="controles[]" value="12" style="margin-left: 8px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_15">Control 15</label>
                                        <input type="checkbox" id="control_15" name="controles[]" value="15"  style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">                                                                        
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_16">Control 16</label>
                                        <input type="checkbox" id="control_16" name="controles[]" value="16" style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="control_17">Control 17</label>
                                        <input type="checkbox" id="control_17" name="controles[]" value="17" style="margin-left: 8px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for=""><strong style="color: black">LLAVES</strong></label>
                            <button onclick="seleccionarTodoLlave(event)">Seleccionar todo</button>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_1">Llave 1</label>
                                        <input type="checkbox" id="llave_1" name="llaves[]" value="1" style="margin-left: 15px;" >
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_4">Llave 4</label>
                                        <input type="checkbox" id="llave_4" name="llaves[]" value="4" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_7">Llave 7</label>
                                        <input type="checkbox" id="llave_7" name="llaves[]" value="7" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_10">Llave 10</label>
                                        <input type="checkbox" id="llave_10" name="llaves[]" value="10" style="margin-left: 8px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_13">Llave 13</label>
                                        <input type="checkbox" id="llave_13" name="llaves[]" value="13" style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_2">Llave 2</label>
                                        <input type="checkbox" id="llave_2" name="llaves[]" value="2" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_5">Llave 5</label>
                                        <input type="checkbox" id="llave_5" name="llaves[]" value="5" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_8">Llave 8</label>
                                        <input type="checkbox" id="llave_8" name="llaves[]" value="8" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_11">Llave 11</label>
                                        <input type="checkbox" id="llave_11" name="llaves[]" value="11" style="margin-left: 8px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_14">Llave 14</label>
                                        <input type="checkbox" id="llave_14" name="llaves[]" value="14" style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_3">Llave 3</label>
                                        <input type="checkbox" id="llave_3" name="llaves[]" value="3" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_6">Llave 6</label>
                                        <input type="checkbox" id="llave_6" name="llaves[]" value="6" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_9">Llave 9</label>
                                        <input type="checkbox" id="llave_9" name="llaves[]" value="9" style="margin-left: 15px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_12">Llave 12</label>
                                        <input type="checkbox" id="llave_12" name="llaves[]" value="12" style="margin-left: 8px;">
                                    </div>
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_15">Llave 15</label>
                                        <input type="checkbox" id="llave_15" name="llaves[]" value="15" style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_16">Llave 16</label>
                                        <input type="checkbox" id="llave_16" name="llaves[]" value="16" style="margin-left: 8px;">
                                    </div>
                                </div>
                                <div class="col-md-4">                                    
                                    <div class="form-group" style="padding: 0; margin-top: -6px">
                                        <label for="llave_17">Llave 17</label>
                                        <input type="checkbox" id="llave_17" name="llaves[]" value="17" style="margin-left: 8px;">
                                    </div>
                                </div>                                                                                                                                                                                                        
                            </div> 
                        </div>
                    </div>
                    <hr>

                    <div class="form-row">
                        <div class="col-md-3">
                            <label for=""><strong style="color: black;">DATA DISPLAY</strong></label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="decrementarValor()" style="background: #B0DAFF;"><strong style="font-size: 25px; color:white">-</strong></button>
                                </div>
                                <input type="number" id="input-numero" name="datadisplay" id="datadisplay" value="2" min="0" max="10" style="border: 1px solid black; padding: 15px; margin-top: 5px; margin-bottom: 5px; text-align: center;">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="incrementarValor()"style="background: #F45050;"><strong style="font-size: 25px; color:white">+</strong></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanque_1">TANQUE 1</label>
                                        <input type="range" min="0" max="100" step="1" value="0" name="tanque_1" id="tanque_1" oninput="actualizarPorcentaje('tanque_1', 'porcentaje-valor-1')" required>
                                        <span id="porcentaje-valor-1"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanque_2">TANQUE 2</label>
                                        <input type="range" min="0" max="100" step="1" value="0" name="tanque_2" id="tanque_2" oninput="actualizarPorcentaje('tanque_2', 'porcentaje-valor-2')" required>
                                        <span id="porcentaje-valor-2"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tanque_3">TANQUE 3</label>
                                        <input type="range" min="0" max="100" step="1" value="0" name="tanque_3" id="tanque_3" oninput="actualizarPorcentaje('tanque_3', 'porcentaje-valor-3')" required>
                                        <span id="porcentaje-valor-3"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12">
                            <label for="editor"><strong style="color: black">DETALLE</strong></label>
                            <textarea id="editor" name="editor"></textarea>
                        </div>                        
                    </div>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" id="submitBtn" class="btn btn-success">Registrar</button>                
                </form>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<style>
    #container {
        width: 1000px;
        margin: 20px auto;
    }
    .ck-editor__editable[role="textbox"] {
        /* editing area */
        min-height: 200px;
    }
    .ck-content .image {
        /* block images */
        max-width: 80%;
        margin: 20px auto;
    }
    .col-md-2 {
        display: inline-block;
        vertical-align: top;
    }
    .input-group-prepend,
    .input-group-append {
        display: flex;
    }

    .btn {
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
    }
</style>
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
<script>
    CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
        toolbar: {
            items: [
                'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
            ],
            shouldNotGroupWhenFull: true
        },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Welcome to CKEditor 5!',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [ 10, 12, 14, 'default', 18, 20, 22 ],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
        mention: {
            feeds: [
                {
                    marker: '@',
                    feed: [
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                        '@sugar', '@sweet', '@topping', '@wafer'
                    ],
                    minimumCharacters: 1
                }
            ]
        },
        // The "super-build" contains more premium features that require additional configuration, disable them below.
        // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
        removePlugins: [
            // These two are commercial, but you can try them out without registering to a trial.
            // 'ExportPdf',
            // 'ExportWord',
            'CKBox',
            'CKFinder',
            'EasyImage',
            // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
            // Storing images as Base64 is usually a very bad idea.
            // Replace it on production website with other solutions:
            // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
            // 'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
        ]
    });
</script>
<script>
  function capturarContenido() {
    const contenido = document.querySelector('#editor').innerHTML;
    document.querySelector('#editor_contenido').value = contenido;
  }
</script>
<script>
  let seleccionado = false;

  function seleccionarTodo(event) {
    event.preventDefault();
    var checkboxes = document.querySelectorAll('input[type="checkbox"][name="controles[]"]');
    checkboxes.forEach(function(checkbox) {
      checkbox.checked = seleccionado;
    });
    seleccionado = !seleccionado;
  }
</script>
<script>
    let seleccionadollave = false;

    function seleccionarTodoLlave(event) {
        event.preventDefault(); 
        var checkboxes = document.querySelectorAll('input[type="checkbox"][name="llaves[]"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = seleccionadollave;
        });
        seleccionadollave = !seleccionadollave;
    }
</script>
<script>
    function actualizarPorcentaje(idTanque, idPorcentaje) {
        var range = document.getElementById(idTanque);
        var spanPorcentaje = document.getElementById(idPorcentaje);
        var porcentaje = range.value + '%';
        spanPorcentaje.innerHTML = porcentaje;
    }
</script>
<script>
    function incrementarValor() {
        var inputNumero = document.getElementById('input-numero');
        var valor = parseInt(inputNumero.value);
        var max = parseInt(inputNumero.getAttribute('max'));
        if (valor < max) {
            inputNumero.value = valor + 1;
        }
    }

    function decrementarValor() {
        var inputNumero = document.getElementById('input-numero');
        var valor = parseInt(inputNumero.value);
        var min = parseInt(inputNumero.getAttribute('min'));
        if (valor > min) {
            inputNumero.value = valor - 1;
        }
    }
</script>