
@extends('layouts.admin')

@section('title', 'Usuarios ')
@section('content-header', 'Usuarios ')

@section('content-actions')
   <a href="{{route('usuarios.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> <i class="fas fa-user"></i> Registar Nuevo Usuario </a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
       
        <div class="card-body">
            <i class="nav-icon fa fa-users fa-3x"></i>
            <div class="row">
                <!-- <div class="col-md-3"></div> -->
                <div class="col-md-12">
                    <form action="{{route('usuarios.index')}}">
                        <div class="row">
                            <div class="col-md-3">
                             <input type="input" name="nombre" class="form-control" value="{{request('nombre')}}" placeholder="Ingrese el nombre a buscar" />
                            </div>
                            <div class="col-md-3">
                                 <input type="input" name="apellido" class="form-control" value="{{request('apellido')}}"  placeholder="Ingrese el apellido a buscar"/>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Buscar </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><i class="nav-icon fa fa-user"></i></th>
                 
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Entidad</th>
                    <th>Telefono</th>
                    <th>rol</th>
                    <th>email</th>
                   
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                   
                @foreach ($users as $user)
                @php
                $class= "";;
               
                @endphp
                @if($user->rol =="PENDIENTE")
                @php
                $class= "alert alert-danger";;
               
                @endphp
                   
                @endif
                    <tr class="{{$class}}">
                        <td>{{$user->id}}</td>
                        
                        <td>{{$user->first_name}}</td>
                        <td>{{$user->last_name}}</td>
                        <td>{{$user->entity->nombre}}</td>
                        <td>{{$user->telefono}}</td>
                        <td>{{$user->rol}}</td>
                        <td>{{$user->email}}</td>
                       
                        <td>

                            @if($user->rol =="PENDIENTE")
                            <a class="btn btn-success" onclick="return confirm('Desea activar este usuario?')" href="{{route('usuarios.show', $user)}}"><i class="fas fa-thumbs-up"></i></a>
                            @endif

                            
                            <a href="{{ route('usuarios.edit', $user) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('usuarios.destroy', $user)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $users->render() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Esta Seguro?',
                    text: "Esta completamente seguro de eliminar al usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, Borrar!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).remove();
                            })
                        })
                    }
                })
            })


            $(document).on('click', '.btn-active', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Esta Seguro?',
                    text: "Esta completamente seguro de activar al usuario?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, activar!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'GET', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).removeClass("alert alert-danger"); 
                                $(this).addClass("alert alert-success"); ;
                            })
                        })
                    }
                })
            })




        })
    </script>
@endsection
