@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])
@section('content')
<br><br><hr>
<center>
<div class="table-responsive">
    <table style="width: 90%; background: white">
        @foreach($novedades as $novedade)
        <?php
            $controles_array = explode(',', $novedade->controles);
            $resultadoscontroles = array();
            for ($i = 1; $i <= 17; $i++) {
                if (in_array(strval($i), $controles_array)) {
                    $resultadoscontroles[$i] = "SI";
                } else {
                    $resultadoscontroles[$i] = "NO";
                }
            }
            
            $llaves_array = explode(',', $novedade->llaves);
            $resultadosllaves = array();
            for ($i = 1; $i <= 17; $i++) {
                if (in_array(strval($i), $llaves_array)) {
                    $resultadosllaves[$i] = "SI";
                } else {
                    $resultadosllaves[$i] = "NO";
                }
            }
        ?>
        <tr style="margin: 10px;">
            <td style="width: 400px; vertical-align: top;border: 1px solid black; padding: 10px;">
                @foreach ($users as $user)
                @if($user->id == $novedade->user_id)
                    <strong>REGISTRADO POR:</strong><br><br>
                    {{ $user->name }}<br><br>
                    {{ $user->email }}<br><br>
                    {{ $novedade->Fecha_registro }}<br><br>
                @endif
                @endforeach
            </td>
            <td style="width: 1000px; vertical-align: top;border: 1px solid black; padding: 10px;">
                <div style="background-color: gris;"><center><strong>NOVEDADES</strong></center></div>
                {!! $novedade->detalle !!}
            </td>
            <td style="width: 300px; vertical-align: top;border: 1px solid black; padding: 10px;">
                <strong>CONTROLES:</strong>
                <table class="tablenew">
                    <tr>
                        @foreach($resultadoscontroles as  $numero => $control)
                            @if($control == 'NO')
                                <td style="text-align: center; background: #E76161">{{ $numero }}</td>
                            @else
                                <td style="text-align: center; background: #B6E388">{{ $numero }}</td>
                            @endif
                        @endforeach
                    </tr>
                </table>
                <strong>LLAVES:</strong>
                <table class="tablenew">
                    <tr>
                        @foreach($resultadosllaves as  $numero => $control)
                            @if($control == 'NO')
                                <td style="text-align: center; background: #E76161">{{ $numero }}</td>
                            @else
                                <td style="text-align: center; background: #B6E388">{{ $numero }}</td>
                            @endif                            
                        @endforeach
                    </tr>
                </table>
                <table style="margin: auto;">
                    <tr>
                        <td style="text-align: center; padding: 10px;">
                            <strong>TANQUE 1</strong>
                            <p>{{ $novedade->tanque_1}}</p>       
                        </td>
                        <td style="text-align: center; padding: 10px;">
                            <strong>TANQUE 2</strong>
                            <p>{{ $novedade->tanque_2}}</p>             
                        </td>
                        <td style="text-align: center; padding: 10px;">
                            <strong>TANQUE 3</strong>
                            <p>{{ $novedade->tanque_3}}</p>
                        </td>
                    </tr>
                </table>
            </td>                
        </tr>
        @endforeach
    </table><br>
    <div class="container" style="width: 100%;">
        {{ $novedades->links() }}
    </div>
</div>
</center>
@endsection
<style>
    .tablenew {
        border-collapse: collapse;
        width: 100%;
    }
    
    .tablenew tr td {
        border: 1px solid white;
        padding: 5px;
        margin: 0;
        text-align: center;
        width: 30px;
        height: 30px;
    }
    *,*:after,*:before{
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
}
body{
	font-family: arial;
	font-size: 16px;
	margin: 0;
	background: #122325;
	display: flex;
	align-items: center;
	justify-content: space-around;
	height: 100vh;
}

svg{
	width: 200px;
	height: 200px;
	
	transform: rotate(-90deg);
	overflow: initial;
}

circle{
	stroke-width:20px;
	fill:none;	
}
circle:nth-child(1){ stroke: #fff }
circle:nth-child(2){
	stroke: #f00; 
	position: relative;
	z-index: 1;

	
	
}
.circle_box:nth-child(1) circle:nth-child(2){
	stroke-dashoffset:calc(100 * 6);
	stroke-dasharray:calc(100 * 6);
	stroke-dashoffset:calc((100 * 6) - ((100 * 6) * 80) / 100); 
	stroke-position: inside;
}
.circle_box:nth-child(2) circle:nth-child(2){
	stroke-dashoffset:calc(100 * 6);
	stroke-dasharray:calc(100 * 6);
	stroke-dashoffset:calc((100 * 6) - ((100 * 6) * 60) / 100);
	stroke: #0f0;  
}
.circle_box:nth-child(3) circle:nth-child(2){
	stroke-dashoffset:calc(100 * 6);
	stroke-dasharray:calc(100 * 6);
	stroke-dashoffset:calc((100 * 6) - ((100 * 6) * 50) / 100);
	stroke: #00f;  
}
.circle_box{
	font-size: 36px;
	color: #fff;
	text-align: center;
}
.circle_box div{
	position: relative;
}
.circle_box span{
	position: absolute;
	left: 50%;
	top:50%;
	transform: translate(-50%,-50%);
	color: #fff;
	font-size: 40px;
}
</style>
@notifyCss

@push('js')
 
@notifyJs
@endpush