public function getDataByMonth($selectedDate){
    $month = date('m',strtotime($selectedDate));
    $year = date('Y',strtotime($selectedDate));
    $reservasPorHabitacion = HospedajeHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'hospedaje_habitacions.habitacion_id')
                                ->select(DB::raw('count(hospedaje_habitacions.id) as reservas, habitacions.id as habID'))
                                ->whereMonth('hospedaje_habitacions.ingreso_hospedaje', $month)
                                ->whereYear('hospedaje_habitacions.ingreso_hospedaje', $year)
                                ->groupBy('habitacions.id')
                                ->get();
    return $reservasPorHabitacion;
}


<script>
    // Inicializar gráfico con los datos iniciales
    var reservasPorHabitacion = <?php echo json_encode($reservasPorHabitacion); ?>;
    var ctx = document.getElementById("myChart").getContext("2d");
    let labels = []
    let data = []
    let backgroundColor = []
    reservasPorHabitacion.forEach(r => {
        labels.push(r.habID)
        data.push(r.reservas)
        backgroundColor.push(randomColor())
    });
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hospedajes por Habitación',
                data: data,
                backgroundColor: backgroundColor,
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        min: 0
                    }
                },
                y: {
                    ticks: {
                        min: 0
                    }
                }
            }
        }
    });

    // Evento de selección de mes
    $('#input-month').on('change', function() {
        let month = $(this).val();
        $.ajax({
            url: '/getDataByMonth/' + month,
            success: function(response) {
                // Actualizar los datos del gráfico con los datos recibidos de la respuesta del servidor
                let labels = []
                let data = []
                let backgroundColor = []
                response.forEach(r => {
                    labels.push(r.habID)
                    data.push(r.reservas)
                    backgroundColor.push(randomColor())
                });
                myChart.data.labels = labels;
                myChart.data.datasets[0].data = data;
                myChart.data.datasets[0].backgroundColor = backgroundColor;
                myChart.update();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    function randomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>



openssl_get_cert_locations

public function getDataByMonth($selectedDate){
        $month = date('m',strtotime($selectedDate));
        $year = date('Y',strtotime($selectedDate));
        $reservasPorHabitacion = HospedajeHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'hospedaje_habitacions.habitacion_id')
                                    ->select(DB::raw('count(hospedaje_habitacions.id) as reservas, habitacions.id as habID'))
                                    ->whereMonth('hospedaje_habitacions.ingreso_hospedaje', $month)
                                    ->whereYear('hospedaje_habitacions.ingreso_hospedaje', $year)
                                    ->groupBy('habitacions.id')
                                    ->get();
        $hospedajesPorHabitacion = ReservaHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'reserva_habitacions.habitacion_id')
                                ->select(DB::raw('count(reserva_habitacions.id) as hospedajes, habitacions.id as habIDhos'))
                                ->whereMonth('reserva_habitacions.ingreso_reserva', $month)
                                ->whereYear('reserva_habitacions.ingreso_reserva', $year)
                                ->groupBy('habitacions.id')
                                ->get();                                    
        //return $reservasPorHabitacion;
        return response()->json(['hospedajesPorHabitacion' => $hospedajesPorHabitacion,    'reservasPorHabitacion' => $reservasPorHabitacion]);
    }

    <script>

    // Inicializar gráfico con los datos iniciales
    var hospedajesPorHabitacion = <?php echo json_encode($hospedajesPorHabitacion); ?>;
    var reservasPorHabitacion = <?php echo json_encode($reservasPorHabitacion); ?>;
    var ctx = document.getElementById("myChart").getContext("2d");

    let labels = []
    let dataHospedaje = []
    let dataReservas = []
    let backgroundColor = []
    hospedajesPorHabitacion.forEach(r => {
        labels.push(r.NombreHab)
        dataHospedaje.push(r.hospedajes)
    });
    reservasPorHabitacion.forEach(r => {
        dataReservas.push(r.reservas)
        backgroundColor.push(randomColor())
    });

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Hospedajes por Habitación',
                    data: dataHospedaje,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Reservas por Habitación',
                    data: dataReservas,
                    backgroundColor: backgroundColor,
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        min: 0
                    }
                },
                y: {
                    ticks: {
                        min: 0
                    }
                }
            }
        }
    });
    // Evento de selección de mes
    $('#input-month').on('change', function() {
        let month = $(this).val();
        $.ajax({
            url: '/getDataByMonth/' + month,
            success: function(response) {
                let labelsHospedaje = []
                let dataHospedaje = []
                let backgroundColorHospedaje = []
                response.datosHospedaje.forEach(r => {
                    labelsHospedaje.push(r.habID)
                    dataHospedaje.push(r.hospedajes)
                    backgroundColorHospedaje.push(randomColor())
                });

                let labelsReserva = []
                let dataReserva = []
                let backgroundColorReserva = []
                response.datosReserva.forEach(r => {
                    labelsReserva.push(r.habID)
                    dataReserva.push(r.reservas)
                    backgroundColorReserva.push(randomColor())
                });

                // Crear dos datasets utilizando los datos obtenidos
                var dataset1 = {
                    label: 'Hospedajes por Habitación',
                    data: dataHospedaje,
                    labels: labelsHospedaje,
                    backgroundColor: backgroundColorHospedaje
                };
                var dataset2 = {
                    label: 'Reservas por Habitación',
                    data: dataReserva,
                    labels: labelsReserva,
                    backgroundColor: backgroundColorReserva
                };
                var data = {
                    datasets: [dataset1, dataset2],
                };

                myChart.data = data;
                myChart.update();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

    function randomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>

funciona correctamente
<script>
    // Inicializar gráfico con los datos iniciales
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
        type: 'bar',
        options: {
            scales: {
                x: {
                    ticks: {
                        min: 0
                    }
                },
                y: {
                    ticks: {
                        min: 0
                    }
                }
            }
        }
    });

    // Evento de selección de mes
    $('#input-month').on('change', function() {
        let month = $(this).val();
        $.ajax({
            url: '/getDataByMonth/' + month,
            success: function(response) {
                let labelsHospedaje = []
                let dataHospedaje = []
                let backgroundColorHospedaje = []
                response.hospedajesPorHabitacion.forEach(r => {
                    labelsHospedaje.push(r.habIDhos)
                    dataHospedaje.push(r.hospedajes)
                    backgroundColorHospedaje.push("#0066cc") // color fijo para hospedajes
                });

                let labelsReserva = []
                let dataReserva = []
                let backgroundColorReserva = []
                response.reservasPorHabitacion.forEach(r => {
                    labelsReserva.push(r.habID)
                    dataReserva.push(r.reservas)
                    backgroundColorReserva.push("#ff9900") // color fijo para reservas
                });

                // Crear dos datasets utilizando los datos obtenidos
                var dataset1 = {
                    label: 'Hospedajes por Habitación',
                    data: dataHospedaje,
                    labels:labelsHospedaje,
                    backgroundColor: backgroundColorHospedaje,
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                };
                var dataset2 = {
                    label: 'Reservas por Habitación',
                    data: dataReserva,
                    labels: labelsReserva,
                    backgroundColor: backgroundColorReserva,
                    borderWidth: 1
                };
                var data = {
                    labels: labelsHospedaje.concat(labelsReserva),
                    datasets: [dataset1, dataset2],
                };

                myChart.data = data;
                myChart.update();
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    });

</script>
public function getDataByMonth($selectedDate){
        $month = date('m',strtotime($selectedDate));
        $year = date('Y',strtotime($selectedDate));
        $reservasPorHabitacion = HospedajeHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'hospedaje_habitacions.habitacion_id')
                                    ->select(DB::raw('count(hospedaje_habitacions.id) as reservas, habitacions.id as habID'))
                                    ->whereMonth('hospedaje_habitacions.ingreso_hospedaje', $month)
                                    ->whereYear('hospedaje_habitacions.ingreso_hospedaje', $year)
                                    ->groupBy('habitacions.id')
                                    ->get();
        $hospedajesPorHabitacion = ReservaHabitacion::leftJoin('habitacions', 'habitacions.id', '=', 'reserva_habitacions.habitacion_id')
                                ->select(DB::raw('count(reserva_habitacions.id) as hospedajes, habitacions.id as habIDhos'))
                                ->whereMonth('reserva_habitacions.ingreso_reserva', $month)
                                ->whereYear('reserva_habitacions.ingreso_reserva', $year)
                                ->groupBy('habitacions.id')
                                ->get();                                    
        //return $reservasPorHabitacion;
        return response()->json(['hospedajesPorHabitacion' => $hospedajesPorHabitacion,    'reservasPorHabitacion' => $reservasPorHabitacion]);
    }