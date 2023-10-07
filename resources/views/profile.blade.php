@extends('layouts.app')

@section('content')
    <div class="container mt-5 ">
        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="card w-50 bg-secondary">

                    <div class="card-body bg-secondary m-0 p-0">
                        <div class="card bg-black ">
                            <h5 class="card-title mt-2  text-center text-light ">Edita tu Perfil</h5>
                        </div>
                        
                        <div class="row justify-content-center">
                            
                            <div class="col-8 mb-3 mt-3">
                                <label class="block mb-2 text-sm font-medium text-white" for="channel">Canal</label>
                                <input type="text" class="form-control" aria-label="Default"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                            <div class="col-8 mb-3">
                                <label class="block mb-2 text-sm font-medium text-white" for="channel">Nombre
                                    Completo</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="row " style="margin-right:10px">
                                <div class="col-2 offset-2 mb-3" >
                                    <label class="block mb-2 text-sm font-medium text-white" for="channel">Telefono</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open </option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    
                                </div>
                                <div class="col-4">
                                    <label class="block mb-2 text-sm font-medium text-white" for="channel">s</label>
                                    <input type="text" class="form-control" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                           
                            <div class="col-8 mb-3 ">
                                <label class="block mb-2 text-sm font-medium text-white" for="channel">Canal</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>Open this select menu</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-6 mt-2 mb-4" style="display: block;margin-right:105px">
                                <button type="button" class="btn btn-primary" >Guardar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>







        </div>
    </div>
@endsection
