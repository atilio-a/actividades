@extends('layouts.admin')

@section('title', ' Actividades')
@section('content-header', ' Actividades')
@section('content-actions')
<br>
    <form method="GET" action="{{ route('actions.index') }}" class="form-inline">
        <input type="text" name="search" class="form-control w-75" placeholder="Buscar..." value="{{ request()->get('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <br>
    <a href="{{ route('actions.create') }}" class="btn btn-success ml-2"><i class="fas fa-plus"></i> Registrar nueva Actividad</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection

@section('content')
<div class="card">
    <div class="card-body">
    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
            <tr>
                <td>Actividades</td>
                <td>Descripcion</td>
                <td>Fecha</td>
                <td>Entidad</td>
                <td>Localidad</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($actions as $accion)
            <tr>
                <td>{{$accion->nombre}}</td>
                <td>{{ \Illuminate\Support\Str::limit($accion->descripcion, 150, ' (...)') }}</td>

                <td>{{$accion->fecha}}</td>
                <td>{{$accion->entidad->nombre}}</td>
                <td>{{$accion->localidad->nombre}}</td>
                <td>
                        <a href="{{ route('actions.show', $accion) }}" class="btn btn-success" title="Ver Datos"><i
                                 class="fas fa-eye"></i></a>
                        <a href="{{ route('actions.edit', $accion) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('actions.destroy', $accion)}}"><i
                                class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
                title: 'Seguro?',
                text: "Realmente quiere eliminar esta Actividades?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, borrala!',
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
    })
</script>
@endsection
           