<?php

namespace App\Exports;

use App\Models\Articulo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ArticulosExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View{
        return view('admin.inventario_cocina.excel_articulos',[
            'articulos' => Articulo::all()
        ]);
    }
}
