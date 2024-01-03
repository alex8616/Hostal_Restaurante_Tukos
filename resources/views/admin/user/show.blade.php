@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
<br><br><hr>
<div class="worko-tabs">
  
    <input class="state" type="radio" title="tab-one" name="tabs-state" id="tab-one" checked />
    <input class="state" type="radio" title="tab-two" name="tabs-state" id="tab-two" />
    <input class="state" type="radio" title="tab-three" name="tabs-state" id="tab-three" />
    <input class="state" type="radio" title="tab-four" name="tabs-state" id="tab-four" />

    <div class="tabs flex-tabs">
        <label for="tab-one" id="tab-one-label" class="tab">Sobre El Usuario</label>
        <label for="tab-two" id="tab-two-label" class="tab">Historial De Ventas</label>

        <div id="tab-one-panel" class="panel active">
            <div class="border-bottom text-center pb-4">
                <h3>{{ ucwords($user->name) }}</h3>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <h4>Información del usuario</h4>
                </div>
            </div>
            <div class="profile-feed">
                <div class="d-flex align-items-start profile-feed-item">

                    <div class="form-group col-md-6">
                        <strong><i class="fab fa-product-hunt mr-1"></i> Nombre</strong>
                        <p class="text-muted">
                            {{ ucwords($user->name) }}
                        </p>
                        <hr>
                        <strong><i class="fas fa-user-tag mr-1"></i> Roles</strong>
                        <p class="text-muted">
                            @forelse ($user->roles as $role)
                                @can('roles.show')
                                    <a href="{{ route('admin.roles.show', $role) }}"
                                        class="bg-primary text-white p-1 mt-2 rounded mt-3 ">{{ $role->name }}</a>
                                @endcan
                            @empty <span>
                                    <h4 class="text-danger">El usuario no tiene rol</h4>
                                </span>
                            @endforelse
                        </p>
                        <hr>
                    </div>

                    <div class="form-group col-md-6">
                        <strong>
                            <i class="fas fa-envelope mr-1"></i>
                            Correo electrónico</strong>
                        <p class="text-muted">
                            {{ $user->email }}
                        </p>
                        <hr>
                    </div>
                </div>
            </div>  
        </div>
        <div id="tab-two-panel" class="panel">
            <div class="profile-feed">
                <div class="d-flex align-items-start profile-feed-item">
                <div class="main-wrapper">
                    <main role="main">
                        <div class="table-card">
                        <div class="container">
                            <center><h1 class="table-title">HISTORIAL &amp; VENTAS</h1></center>
                            <div class="table-scroll">
                            <div class="table-wrapper">
                                <table class="sticky-table">
                                <colgroup>
                                    <col class="table-col1">
                                    <col class="table-col2">
                                    <col class="table-col3">
                                    <col class="table-col4">
                                    <col class="table-col5">
                                    <col class="table-col6">
                                </colgroup>
                                <thead class="table-head" title="Click to sort">
                                    <tr class="table-row">
                                    <th class="col-head" scope="col">Id</th>
                                    <th class="col-head" scope="col">Fecha</th>
                                    <th class="col-head" scope="col">Total</th>
                                    <th class="col-head" scope="col">Estado</th>
                                    <th class="col-head" scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="table-body">
                                    @foreach ($user->comandas as $venta)
                                        <tr class="table-row">
                                            <th scope="row" class="cell">
                                                {{ $venta->id }}
                                            </th>
                                            <td class="cell">{{ $venta->fecha_venta }}</td>
                                            <td class="cell">Bs. {{ number_format($venta->total, 2) }}</td>
                                            @if ($venta->estado == 'VALIDO')
                                                <td class="cell" style="font-size: 14px;">
                                                    <a href="{{ route('cambio.estado.comanda', $venta) }}"
                                                        style="color: black;">
                                                        <span style="background-color: #FF5454;">Pendiente</span> 
                                                    </a>
                                                </td>
                                            @else
                                                <td class="cell" style="font-size: 14px;">
                                                    <a href="{{ route('cambio.estado.comanda', $venta) }}"
                                                        style="color: black;">
                                                        <span style="background-color: #ABFF32;">Confirmado</span>
                                                    </a>
                                                </td>
                                            @endif
                                            <td sstyle="width: 180px;" class="cell">
                                                <center>
                                                  <ul class="wrapper" style="height: 50px; display: inline-flex;">
                                                      <li class="icon facebook" style="padding:4%">
                                                          <span class="tooltip" style="font-size: 10px;">IMPRIMIR</span>
                                                          <a href="{{ route('admin.comanda.pdf', $venta) }}" target="_blank" style="all: unset;">
                                                            <span><i class="fa-solid fa-print"></i></span>
                                                          </a>
                                                      </li>
                                                      <li class="icon spetie" style="padding:4%">
                                                      <span class="tooltip" style="font-size: 10px;">MOSTRAR</span>
                                                          <a href="{{ route('admin.comanda.show', $venta) }}" style="all: unset;">
                                                              <span><i class="fa-brands fa-readme"></i></span>
                                                          </a>
                                                      </li>
                                                  </ul>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </table>
                            </div> <!-- /.table-scroll -->
                            </div> <!-- /.table-wrapoer -->
                        </div> <!-- /.table-card -->
                        </div> <!-- /.container -->
                    </main>
                </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

<link href="{{asset('css/header.css')}}" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
<link href="{{asset('css/caja/registrar.css')}}" rel="stylesheet" type="text/css"/>
<link href="{{asset('css/modal.css')}}" rel="stylesheet" type="text/css"/> 
<style>
h1 {
  font-size: 2em;
  margin: 0.67em 0;
}

/* A better looking default horizontal rule. */

hr {
  box-sizing: content-box;
  display: block;
  font-size: 2em;
  height: 1px;
  overflow: visible;
}

/* Add default styling for <main> so that it works in IE9-11 */

main {
  display: block;
  width: 100%;
}

/*
 * Remove text-shadow for a better selection highlight:
 * @link https://twitter.com/miketaylr/status/12228805301
 * Vendor-prefixed and regular ::selection selectors cannot be combined:
 * @link https://stackoverflow.com/a/16982510/7133471
 */

::-moz-selection {
  background: #b3d4fc;
  color: #000;
  text-shadow: none;
}

::selection {
  background: #b3d4fc;
  color: #000;
  text-shadow: none;
}

/* Render tables with collapsed cell borders and centered vertical alignment */

table {
  border-collapse: collapse;
  font-variant-numeric: tabular-nums;
  vertical-align: middle;
}

/*
 * This <div> element's style exists solely for the purposes of this demonstration.
 * It simply horizontally and vertically centers the elements on the page and most
 * likely will not be copied into a production implementation.
 */

.main-wrapper {
  -webkit-box-align: center;
  -ms-box-align: center;
  -moz-box-align: center;
  -ms-flex-align: center;
  -webkit-align-items: center;
  align-items: center;
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -moz-box-pack: center;
  -ms-box-pack: center;
  -ms-flex-pack: center;
  -webkit-justify-content: center;
  justify-content: center;
  width: 100%;
}

/* Table Styles */

/*
 * An optional color pallete:
 * #00447C - Brand blue
 * #266090 - 15% tinting on brand blue
 * #4d7ca3 - 30% tinting on brand blue
 * #80a2be - 50% tinting on brand blue
 * #003057 - 30% shading on brand blue
 * #002849 - 45% shading on brand blue
 * #000333 - 50% darker brand blue
 * #6495ed - Pastel blue
 * #fff - White
 * #f1f2f2 - Off-white
 * #d3d3d3 - Light gray shading for even rows
 * #bcbec0 - Gray
 * #687685 - Silver
 * #333 - Off-black
 * #000 - Black
 */

/*
 * The outer containing <div> with the white background. This is a completely
 * optional stylistic choice for the page.
 */


/* A container for all the inner elements of the card (the white container for the table) */

.container {
  margin: 0 auto;
  width: 100%;
}

/*
 * The outer containing <div> for the table elements. The scrollbar effects are
 * applied to this element.
 */

.table-scroll {
  margin: 0 auto; /* Center element with no top or bottom margins */
  overflow: auto; /* Turn on the scrollbars if the table is larger than this element */
  scrollbar-arrow-color: #fff; /* IE 6+ scroll styles */
  scrollbar-face-color: #00447c;
  scrollbar-shadow-color: #333;
  scrollbar-highlight-color: #000;
  scrollbar-darkshadow-color: #000;
  scrollbar-track-color: #80a2be; /* Last IE 6+ scroll styles */
  scrollbar-color: #00447c #80a2be; /* Firefox 64+ */
  scrollbar-width: thin; /* Firefox 64+ */
  width: 100%;
}

/* Scrollbar effects for webkit browsers (Chrome, Safari, Opera 11+, Chromium-based Edge) */

.table-scroll::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

.table-scroll::-webkit-scrollbar-track {
  background: padding-box #80a2be;
  border-radius: 4px;
}

.table-scroll::-webkit-scrollbar-thumb {
  background: padding-box #00447c;
  border-radius: 4px;
}

.table-scroll::-webkit-scrollbar-thumb:hover {
  background: padding-box #6495ed;
}

.table-scroll::-webkit-scrollbar-thumb:active {
  background: padding-box #002849;
  box-shadow: inset 0 0 3px rgba(192, 192, 192, 0.5);
}

.table-title,
.table-head {
  font-family: Lato, Oxygen, "Open Sans", Montserrat, "PT Sans", Verdana, Arial,
    sans-serif;
}

.table-title {
  color: #00447c;
  display: inline-block;
  font-size: 2em;
  font-weight: 700;
  margin: 0 0 0 0.525em; /* Sets all margins to 0 except for the left margin */
  overflow: hidden;
  text-overflow: ellipsis;
  text-transform: uppercase;
  white-space: nowrap;
  word-wrap: normal;
}

/*
 * The first wrapping container <div> for the table. This class' height will set
 * the height for the visible part of the table
 */

.table-wrapper {
  height: 30em; /* Fallback for browsers w/o vh support */
  height: 66.9vh;
  margin: 0 auto;
  min-height: 7em; /* Minimum height has the table header and footer and 1 row visible */
  width: 100%;
}

/*
 * Set table element's outer border, center text by default,
 * 100% width of parent container, No top or bottom margin, and automatic left
 * and right margins, which centers the table in its container.
 */

.sticky-table {
  border: 2px solid #bcbec0;
  margin: 0 auto;
  text-align: center;
  width: 100%;
}

/* Prohibit highlighting text in the header or footer */

.table-head,
.table-foot {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Clear the float effect applied by the sorting visual indication */

.table-head:before,
.table-head:after {
  content: "";
  display: table;
}

.table-head:after {
  clear: both;
}

/* Ensure the default cursor on table body <tbody> and footer <tfoot> */

.table-body,
.table-foot {
  cursor: default;
}

/*
 * Background shading on all even numbered table rows <tr> that are descendants
 * of the table body <tbody>
 */

.table-body .table-row:nth-child(even) {
  background: #d3d3d3;
}

/* Hover effect on all table rows <tr> that are descendants of table body <tbody> */

.table-body .table-row:hover {
  background: #6495ed;
}

/*
 * Hover effect on all table rows <tr> that are descendants of the table
 * footer <tfoot>
 */
.table-foot .table-row:hover {
  background: #687685;
}

/*
 * Set the default padding for all the table's cells, 8px in every direction.
 * .col-head are the <th> elements in the <thead> section, .cell are the <td>
 * elements in the <tbody> sectiion, .col-foot are the <td> elements in the
 * <tfoot> section of the HTML
 */

.cell,
.col-foot {
  padding: 8px;
  padding: 0.5rem;
}

/*
 * Set the style of the table's column header cells <th>.
 * The position: sticky and position: -webkit-sticky must be added to a
 * all the th elements themselves, like in the class below. It does NOT work
 * if you attempt to apply it to a <thead> element instead.
 */

.col-head {
  background: #00447c;
  border-color: #bcbec0;
  border-style: solid;
  border-width: 0 0 3px; /* 0px on the top, 0px on sides, and 3px below */
  color: #f1f2f2;
  font-size: 1.25em;
  letter-spacing: 0.075em;
  padding: 0.4em 0.8em;
  position: -webkit-sticky;
  position: sticky;
  top: -0.5px; /* Fixes issue w/ sticky where sometimes text from table shows above header */
  /* Transition timing for hover/active effects */
  -webkit-transition: background-color 0.4s ease-out;
  -moz-transition: background-color 0.4s ease-out;
  transition: background-color 0.4s ease-out;
  white-space: nowrap;
  z-index: 999; /* Ensure the sticky-headers will be on top of everything as user scrolls */
}

.col-head:hover {
  background: #266090;
}
.col-head:active {
  background: #003057;
}

/* Every cell <td> in the table body <tbody> has this class applied */

.cell {
  border-bottom: 1px solid #bcbec0;
}

/* Set the styling for the cells in the table footer */

.col-foot {
  background: #94a5b7;
  border-top: 2px solid #bcbec0;
  bottom: -1px; /* Fixes issue w/ sticky where sometimes text from table shows below footer */
  color: #ffe;
  position: -webkit-sticky;
  position: sticky;
  z-index: 999; /* Ensures the footer stays on top of everything else */
}

/* Set the hover effect for cells in the table footer */

.col-foot:hover {
  color: #00447c;
  font-weight: 700;
}

/* Style the first column of the table */

.col-head:first-child,
.cell:first-child,
.col-foot:first-child {
  padding-left: 16px; /* Fallback for browsers not supporting rem units */
  padding-left: 1rem;
  text-align: left;
}

/* Style the last column of the table */

.col-head:last-child,
.cell:last-child,
.col-foot:last-child {
  padding-right: 16px; /* Fallback for browsers not supporting rem units */
  padding-right: 1rem;
  text-align: right;
}

/* Set a border for every cell with a sibling before it */

.col-head + .col-head,
.cell + .cell,
.col-foot + .col-foot {
  border-left: 1px solid #bcbec0;
}

/*
 * Styles for table sorting feature - These class names must remain unchanged
 * as they are applied to the HTML via the sorttable.js JavaScript.
 */

.table-sort-header {
  cursor: pointer;
}

.table-sort-header::-moz-selection {
  background: 0 0;
}
.table-sort-header::selection {
  background: 0 0;
}

/*
 * Last columns sort indicator shows up on left instead of right for right
 * text-alignment. If the final column isn't right-aligned the selectors
 * can be simplified. (sort-header:after)
 */
.table-sort-header:not(:last-child):after,
.table-sort-header:last-child:before {
  border-color: #fff transparent;
  border-style: solid;
  border-width: 0 0.3em 0.3em;
  content: "";
  margin-top: 0.55em;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=70)"; /* Opacity fallback for IE8- */
  opacity: 0.7;
  position: absolute;
  visibility: hidden;
}

/*
 * Sets all headers except for the last column to have the sorting indicator
 * triangle floating to the right of the header's text (for left and center aligned text)
 */
.table-sort-header:not(:last-child):after {
  float: right;
  right: 2%;
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  transform: rotate(-90deg);
}

/*
 * Sets the last column's headers to have the sorting indicator
 * triangle floating to the left of the header's text (for right aligned text)
 */

.table-sort-header:last-child:before {
  float: left;
  left: 2%;
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}

.table-sort-header:hover:after,
.table-sort-header:hover:before {
  visibility: visible;
}

.table-sort-asc:after,
.table-sort-asc:hover:after,
.table-sort-desc:after,
.table-sort-asc:before,
.table-sort-asc:hover:before,
.table-sort-desc:before {
  border-width: 0 0.3em 0.3em;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(enabled=false)"; /* Opacity fallback for IE8- */
  opacity: 1;
  -webkit-transform: rotate(0);
  -moz-transform: rotate(0);
  -ms-transform: rotate(0);
  transform: rotate(0);
}

.table-sort-desc:not(:last-child):after,
.table-sort-desc:last-child:before {
  border-width: 0.3em 0.3em 0;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(enabled=false)"; /* Opacity fallback for IE8- */
  opacity: 1;
  -webkit-transform: rotate(0);
  -moz-transform: rotate(0);
  -ms-transform: rotate(0);
  transform: rotate(0);
}

/* MEDIA QUERIES (for smaller screen sizes) */

@media only screen and (max-width: 60em) {
  .main-wrapper {
    font-size: 80%;
  }
}

@media only screen and (max-width: 52.5em) {
  .main-wrapper {
    font-size: 65%;
  }
}

@media only screen and (max-width: 45em) {
  .main-wrapper {
    font-size: 50%;
  }

  .cell {
    font-size: 112.5%;
  }
}

/* PRINT ONLY STYLES */

@media print {
  * {
    color: #000;
    box-shadow: none !important;
    text-shadow: none !important;
  }

  html,
  body {
    background: none;
    color: #000;
    -webkit-print-color-adjust: exact;
    color-adjust: exact;
    font-size: 12pt; /* Print is the only time to use pt units */
    height: 98.5%;
    margin: 0;
    padding: 0;
    width: 100%;
  }

  table {
    -webkit-box-decoration-break: clone;
    box-decoration-break: clone;
    max-height: 100%;
    max-width: 100%;
    page-break-inside: auto;
  }

  /* Prevent the page from breaking in the middle of a table row */
  tr,
  td {
    page-break-inside: avoid;
  }

  /* Prevent the page from breaking right after a heading */
  header,
  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    page-break-after: avoid;
  }

  th,
  tfoot td {
    position: static !important;
  }

  nav,
  footer,
  button,
  input,
  select,
  .no-print {
    /* Apply this class to anything you don't want displayed on print */
    display: none !important;
  }

  .main-wrapper,
  .table-card,
  .container,
  .table-wrap-outer,
  .table-wrap {
    display: block;
    height: 100%;
    margin: 0;
    padding: 0;
    width: 100%;
  }

  .table-title {
    font-family: Georgia, Cambria, Garamond, "Times New Roman", Times, serif;
  }

  /*
     * Lighten the background color and change from white text on the column
     * headers for better printing if user prints in black and white
    */

  .col-head {
    background: #80a2be;
    color: #000;
  }

  @page {
    margin: 1.5cm;
    size: auto;
  }
}





    @import "bourbon";
/* Android 2.3 :checked fix */
 @keyframes fake {
	 from {
		 opacity: 1;
	}
	 to {
		 opacity: 1;
	}
}
 body {
	 animation: fake 1s infinite;
}
 .worko-tabs {
	 margin: auto;
	 width: 90%;
}
 .worko-tabs .state {
	 position: absolute;
	 left: -10000px;
}
 .worko-tabs .flex-tabs {
	 display: flex;
	 justify-content: space-between;
	 flex-wrap: wrap;
}
 .worko-tabs .flex-tabs .tab {
	 flex-grow: 1;
	 max-height: 40px;
}
 .worko-tabs .flex-tabs .panel {
	 background-color: #fff;
	 padding: 20px;
	 min-height: 300px;
	 display: none;
	 width: 100%;
	 flex-basis: auto;
}
 .worko-tabs .tab {
	 display: inline-block;
	 padding: 10px;
	 vertical-align: top;
	 background-color: #eee;
	 cursor: hand;
	 cursor: pointer;
	 border-left: 10px solid #ccc;
}
 .worko-tabs .tab:hover {
	 background-color: #fff;
}
 #tab-one:checked ~ .tabs #tab-one-label, #tab-two:checked ~ .tabs #tab-two-label, #tab-three:checked ~ .tabs #tab-three-label, #tab-four:checked ~ .tabs #tab-four-label {
	 background-color: #fff;
	 cursor: default;
	 border-left-color: #69be28;
}
 #tab-one:checked ~ .tabs #tab-one-panel, #tab-two:checked ~ .tabs #tab-two-panel, #tab-three:checked ~ .tabs #tab-three-panel, #tab-four:checked ~ .tabs #tab-four-panel {
	 display: block;
}
 @media (max-width: 600px) {
	 .flex-tabs {
		 flex-direction: column;
	}
	 .flex-tabs .tab {
		 background: #fff;
		 border-bottom: 1px solid #ccc;
	}
	 .flex-tabs .tab:last-of-type {
		 border-bottom: none;
	}
	 .flex-tabs #tab-one-label {
		 order: 1;
	}
	 .flex-tabs #tab-two-label {
		 order: 3;
	}
	 .flex-tabs #tab-three-label {
		 order: 5;
	}
	 .flex-tabs #tab-four-label {
		 order: 7;
	}
	 .flex-tabs #tab-one-panel {
		 order: 2;
	}
	 .flex-tabs #tab-two-panel {
		 order: 4;
	}
	 .flex-tabs #tab-three-panel {
		 order: 6;
	}
	 .flex-tabs #tab-four-panel {
		 order: 8;
	}
	 #tab-one:checked ~ .tabs #tab-one-label, #tab-two:checked ~ .tabs #tab-two-label, #tab-three:checked ~ .tabs #tab-three-label, #tab-four:checked ~ .tabs #tab-four-label {
		 border-bottom: none;
	}
	 #tab-one:checked ~ .tabs #tab-one-panel, #tab-two:checked ~ .tabs #tab-two-panel, #tab-three:checked ~ .tabs #tab-three-panel, #tab-four:checked ~ .tabs #tab-four-panel {
		 border-bottom: 1px solid #ccc;
	}
}
 
</style>
@notifyCss

@push('js')

@notifyJs
@endpush
