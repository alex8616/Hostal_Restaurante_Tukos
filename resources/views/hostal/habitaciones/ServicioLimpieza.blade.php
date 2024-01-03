<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="modelServicioLimpieza" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
<br><br>
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                    <div class="card-profile">
                    <div class="card-profile_visual"></div>
                    <form action="{{ route('hostal.habitacion.ServicioLimpieza') }}" method="POST">
                    @csrf
                    <div class="card-profile_user-infos">
                        <span class="infos_name">REGISTRAR LIMPIEZA</span>
                        <span class="infos_nick"><?php  ?></span>    
                            <input class="typeahead form-control" id="hospedaje_habitacion_id" type="text" 
                                    name="hospedaje_habitacion_id" value="{{$hospedajes->id}}" hidden>
                            <input type="text" id="user_id" name="user_id" value="{{Auth::user()->id}}" hidden>
                            <input type="text" id="servicio_hostals_id" name="servicio_hostals_id" value="3" hidden>
                            <input type="text" id="FechaRegistro_servicio" name="FechaRegistro_servicio" value="<?php echo date("Y-m-d H:i:s") ?>" readonly hidden>
                            <input class="typeahead form-control" type="text" id="cantidad_servicio" name="cantidad_servicio" value="1" hidden>
                            <input class="typeahead form-control" type="text" id="Precio_servicio" name="Precio_servicio" value="0" hidden>
                            <input type="text" id="Incluye_servicio" name="Incluye_servicio" value="SI" hidden>
                        </div>
                        <div id="container">
                            <button id="btn1" class="learn-more" type="submit">
                                <span class="circle" aria-hidden="true">
                                <span class="icon arrow"></span>
                                </span>
                                <span class="button-text">REGISTRAR FORMULARIO</span>
                            </button>
                        </div>
                        <style>
                            #btn1{
                                position: relative;
                                display: inline-block;
                                cursor: pointer;
                                outline: none;
                                border: 0;
                                vertical-align: middle;
                                text-decoration: none;
                                background: transparent;
                                padding: 0;
                                font-size: inherit;
                                font-family: inherit;
                            }
                            #btn1.learn-more {
                                width: 100%;
                                height: auto;
                            }
                            #btn1.learn-more .circle {
                                transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
                                position: relative;
                                display: block;
                                margin: 0;
                                width: 3rem;
                                height: 3rem;
                                background: #282936;
                                border-radius: 1.625rem;
                            }
                            #btn1.learn-more .circle .icon {
                                transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
                                position: absolute;
                                top: 0;
                                bottom: 0;
                                margin: auto;
                                background: #fff;
                            }
                            #btn1.learn-more .circle .icon.arrow {
                                transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
                                left: 0.625rem;
                                width: 1.125rem;
                                height: 0.125rem;
                                background: none;
                            }
                            #btn1.learn-more .circle .icon.arrow::before {
                                position: absolute;
                                content: '';
                                top: -0.25rem;
                                right: 0.0625rem;
                                width: 0.625rem;
                                height: 0.625rem;
                                border-top: 0.125rem solid #fff;
                                border-right: 0.125rem solid #fff;
                                transform: rotate(45deg);
                            }
                            #btn1.learn-more .button-text {
                                transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
                                position: absolute;
                                top: 0;
                                left: 0;
                                right: 0;
                                bottom: 0;
                                padding: 0.75rem 0;
                                margin: 0 0 0 1.85rem;
                                color: #282936;
                                font-weight: 700;
                                line-height: 1.6;
                                text-align: center;
                                text-transform: uppercase;
                            }
                            #btn1:hover .circle {
                                width: 100%;
                            }
                            #btn1:hover .circle .icon.arrow {
                                background: #fff;
                                transform: translate(1rem, 0);
                            }
                            #btn1:hover .button-text {
                                color: #fff;
                            }
                        </style>
                    </form>
                   </div>
                </div>
            </div>
<style>
    .modal-dialog{
            height:70%;
        }
        .modal-content{
            height:50%
        }
        .modal-body{
            width: 100%;
            height: 50%;
            }
    :root {
        font-size: 16px;
    }
    * {
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .container {
        max-width: 350px;
        width: 100%;
        height: 50%;
        position:relative;
        margin: auto;
    }
    .card-profile {
        float: left;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 500px;
        background: #fff;
        border-radius: 10px;
        z-index: 1;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .card-profile_visual {
        height: 90%;
        overflow: hidden;
        position: relative;
        background: linear-gradient(to bottom, #3b3c3f, #263d85, #172551);
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
    .card-profile_visual:before, .card-profile_visual:after {
        display: block;
        content: '';
        width: 100%;
        height: 100%;
        position: absolute;
        z-index: 0;
        background: url("{{ asset('img/limpieza.jpeg') }}") no-repeat center center/cover;
        opacity: 0.5;
        mix-blend-mode: lighten;
    }
    .card-profile_visual:before {
        filter: grayscale(100%);
    }
    .card-profile_user-infos {
        position: absolute;
        z-index: 3;
        left: 0;
        right: 0;
        margin: auto;
        top: calc(68% - 100px);
        color: #fff;
        text-align: center;
    }
    .card-profile_user-infos a {
        width: 64px;
        height: 64px;
        position: absolute;
        left: 0;
        right: 0;
        margin: auto;
        background-color: #f96b4c;
        background-image: linear-gradient(#f96b4c, #f23182);
        display: block;
        clear: both;
        margin: auto;
        top: calc(500% + 66px);
        box-shadow: 0 2px 0 #d42d78, 0 3px 10px rgba(243, 49, 128, 0.15), 0 0px 10px rgba(243, 49, 128, 0.15), 0 0px 4px rgba(0, 0, 0, 0.35), 0 5px 20px rgba(243, 49, 128, 0.25), 0 15px 40px rgba(243, 49, 128, 0.75), inset 0 0 15px rgba(255, 255, 255, 0.05);
    }
    .card-profile_user-infos a:after {
        content: '';
        font-style: normal;
        position: absolute;
        width: 100%;
        height: 100%;
        display: block;
        background-image: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/64/icon-add-f.svg");
        background-repeat: no-repeat;
        background-size: 30%;
        background-position: center center;
        left: 0;
        top: 0;
    }
    .card-profile_user-infos .infos_name, .card-profile_user-infos .infos_nick {
        display: block;
        background-color: #3b3c3f;
        clear: both;
        padding: 0.6em 0;
        padding-top: 10px;
        position: absolute;
        width: 100%;
        text-align: center;
        font-size: 25px;
        top: 0px;
        font-weight: 800;
    }
    .card-profile_user-infos .infos_nick {
        top: 32px;
        font-size: 14px;
        font-weight: 300;
    }
    .card-profile_user-stats {
        background: #fff;
        float: left;
        width: 100%;
        height: calc(100% - 68% + 2px);
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
    .card-profile_user-stats .stats-holder {
        position: absolute;
        width: 100%;
        top: calc(70% + 4em);
        display: flex;
    }
    .card-profile_user-stats .user-stats {
        flex: 1;
        text-align: center;
    }
    .card-profile_user-stats .user-stats strong {
        display: block;
        float: left;
        clear: both;
        width: 100%;
        color: #b3b1b2;
        font-size: 14px;
        font-weight: 500;
        letter-spacing: -0.2px;
    }
    .card-profile_user-stats .user-stats span {
        font-size: 26px;
        color: #5e5e5e;
        padding: 0.18em 0;
        display: inline-block;
    }
    
</style>
        </div>
    </div>
</div>
<script>
document.getElementById("btn1").addEventListener("click", function(){
  document.getElementById("btn1").style.display = "none";
});
</script>