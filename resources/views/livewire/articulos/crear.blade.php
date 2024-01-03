<div wire:ignore.self class="modal fade relative md:absolute fixed w-full h-100 inset-0 justify-center items-center animated fadeIn faster" style="background: rgba(0,0,0,.7);" id="addArticuloModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content py-4 text-left px-6">
                <div class="flex justify-between items-center pb-3">
					<p class="text-2xl font-bold">REGISTRAR ARTICULO</p>
					<div class="modal-close cursor-pointer z-50">
						<svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
							viewBox="0 0 18 18">
							<path
								d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
							</path>
						</svg>
					</div>
				</div>
                <hr>
            <div class="modal-body">
                <div wire:ignore>
                    <img class="mb-2" id="imgPreview">
                </div>
                <form enctype="multipart/form-data" >
                    <div class="form-group row">
                        <div class="col-12">
                            <label for="Nombre_articulo" >Nombre Articulo</label>
                            <input type="text" id="Nombre_articulo" required class="form-control" wire:model="Nombre_articulo" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();">
                            @error('Nombre_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                    </div>
                    </div>

                    <div class="form-group row" wire:ignore>
                        <div class="col-12">
                        <label for="Descripcion_articulo" >Descripcion Articulo</label>
                            <textarea type="text" id="editor" class="form-control" wire:model="Descripcion_articulo" cols="25" rows="6" autofocus onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>
                            @error('Descripcion_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="form-group row">
                        <div class="col-12">
                        <label for="Cantidad_articulo">Cantidad Articulo</label>
                            <input type="number" id="Cantidad_articulo" required class="form-control" wire:model="Cantidad_articulo" max=1000 min=1>
                            @error('Cantidad_articulo')
                                <span class="text-danger" style="font-size: 11.5px;">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <center>
                    <div >
                            <button wire:click.prevent="guardar()" wire:loading.attr="disabled" type="button" class="focus:outline-none px-4 bg-teal-500 p-2 ml-3 rounded-lg text-white hover:bg-teal-400">Registrar</button>

                            <button data-dismiss="modal" type="button" class="focus:outline-none modal-close px-4 bg-gray-400 p-2 rounded-lg text-black hover:bg-gray-300">Cancelar</button>
                    </div>
                    </center>
                </form>
            </div>
        </div>
    </div> 
</div>