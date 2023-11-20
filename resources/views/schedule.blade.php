@extends('layouts.app')

@section('content')
    <div class="container bg-primary">
        <div class="row">
            @if (session()->has('user') && session('status') == 0)
                @include('link')
            @else
                @include('status')
                <div class="col-md-12 pt-1 w-100">
                    <div class="card bg-secondary">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col">
                                    <div class="card banner">
                                        <div class="card-body banner">
                                            <h3 class="text-light text-center">Habilitación de Agendas</h3>
                                        </div>
                                    </div>
                                    <div class="card bg-dark text-light mt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="text-lg font-bold mx-2">Platino: 14:00</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-lg font-bold text-left mx-2">Oro: 15:00</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-lg font-bold mx-2">Plata: 16:00</div>
                                            </div>
                                            <div class="col-12">
                                                <div class="text-lg font-bold mx-2">Bronce: 17:00</div>
                                            </div>

                                        </div>
                                    </div>
                                    @if (false)
                                        <div class="card bg-dark text-light mt-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="text-lg font-bold text-left mt-2 mb-2 mx-2">Aún no están
                                                        habilitadas las reservas para tu rango</div>
                                                </div>


                                            </div>
                                        </div>
                                    @else
                                        <div class="card bg-dark text-light mt-2">
                                            <div class="row">
                                                <div class="container col-12">
                                                    <div class="text-lg font-bold text-left mt-2 mb-2 mx-2">
                                                        <h4 class="text-light text-center">Selecciona Día y Hora
                                                        </h4>
                                                    </div>
                                                </div>
                                                @foreach ($days as $day)
                                                    <div class="col-3 mx-4 mb-4">
                                                        <input class="form-control form-control-lg bg-warning text-center"
                                                            type="text" placeholder="{{ $day }}" disabled>
                                                        <div class="col">
                                                            <div mbsc-page class="demo-multiple-select">
                                                                <div style="height:100%">
                                                                    <label>
                                                                        {{-- Lunes --}}
                                                                        <input mbsc-input
                                                                            id="{{ 'demo-multiple-select-input-' . $day }}"
                                                                            placeholder="Seleccione horario"
                                                                            data-dropdown="true" data-input-style="outline"
                                                                            data-label-style="stacked" data-tags="true"
                                                                            class="calendar" />
                                                                    </label>
                                                                    <select id="{{ 'demo-multiple-select-' . $day }}"
                                                                        multiple>
                                                                        
                                                                        @foreach ($times as $key => $time)
                                                                            <option value="{{ $time }}">
                                                                                {{ $time }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-12 mx-4">
                                                    <button class="btn btn-primary" type="submit" onclick="btnClick()">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('layouts.footer')
@endsection
@push('schedule')
    <script>
        lunes = [];
        martes = [];
        miercoles = [];
        jueves = [];
        viernes = [];
        sabado = [];
        week = [];
        mobiscroll.setOptions({
            locale: mobiscroll
            .localeEs, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
            theme: 'ios', // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light' // More info about themeVariant: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-themeVariant
        });

        mobiscroll.select('#demo-multiple-select-lunes', {
            selectMultiple: true,
            invalid: ['value'],
            Animation: 'slide-down',
            inputElement: document.getElementById(
                'demo-multiple-select-input-lunes') // More info about inputElement: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-inputElement

                ,
            onChange: function(ev, inst) {
                lunes = ev.value;
            },
        });

        mobiscroll.select('#demo-multiple-select-martes', {
            selectMultiple: true,
            invalid: ['value'],
            Animation: 'slide-down',
            inputElement: document.getElementById(
                'demo-multiple-select-input-martes') // More info about inputElement: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-inputElement

                ,
            onChange: function(ev, inst) {
                martes = ev.value;
            },
        });

        mobiscroll.select('#demo-multiple-select-miercoles', {
            selectMultiple: true,
            invalid: ['value'],
            Animation: 'slide-down',
            inputElement: document.getElementById(
                'demo-multiple-select-input-miercoles') // More info about inputElement: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-inputElement

                ,
            onChange: function(ev, inst) {
                miercoles = ev.value;
            },
        });

        mobiscroll.select('#demo-multiple-select-jueves', {
            selectMultiple: true,
            invalid: ['value'],
            Animation: 'slide-down',
            inputElement: document.getElementById(
                'demo-multiple-select-input-jueves') // More info about inputElement: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-inputElement

                ,
            onChange: function(ev, inst) {
                jueves = ev.value;
            },
        });

        mobiscroll.select('#demo-multiple-select-viernes', {
            selectMultiple: true,
            invalid: ['value'],
            Animation: 'slide-down',
            inputElement: document.getElementById(
                'demo-multiple-select-input-viernes') // More info about inputElement: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-inputElement

                ,
            onChange: function(ev, inst) {
                viernes = ev.value;
            },
        });

        mobiscroll.select('#demo-multiple-select-sabado', {
            selectMultiple: true,
            invalid: ['value'],
            Animation: 'slide-down',
            inputElement: document.getElementById(
                'demo-multiple-select-input-sabado') // More info about inputElement: https://docs.mobiscroll.com/5-27-3/javascript/select#opt-inputElement

                ,
            onChange: function(ev, inst) {
                sabado = ev.value;
            },
        });
        function btnClick(){
            week = [];
            if(lunes.length > 0){

                week.push({day:1, horarios:lunes});
            }
            if(martes.length > 0){
                week.push({day:2, horarios:martes});
            }
            if(miercoles.length > 0){
                week.push({day:3, horarios:miercoles});
            }
            if(jueves.length > 0){
                week.push({day:4, horarios:jueves});
            }
            if(viernes.length > 0){
                week.push({day:5, horarios:viernes});
            }
            if(sabado.length > 0){
                week.push({day:6, horarios:sabado});
            }
           
            
            // console.log(lunes);
            // console.log(martes);
            // console.log(miercoles);
            // console.log(jueves);
            // console.log(viernes);
            console.log(week);
            if(week.length > 0){
                $.ajax({
                    url: 'schedule/update',
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        days : week,

                    },
                    success:function(response){
                       
                        if(response.status === 'ok'){
                            // $("#edit-dialog").modal("hide");
                            // table.draw();
                            console.log('okkkk');
                            console.log(response);
                        }else {
                            
                            alert(response.message);

                        }
                        // $(".loading").hide();
                    },
                    error :function( data ) {

                    }
                });
            }
            else{
               alert('Debe agregar horas');
            }

            
        }
        
    </script>
@endpush
