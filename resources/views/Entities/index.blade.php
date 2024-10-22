@extends('layouts.admin')

@section('title', ' Entidades')
@section('content-header', ' Entidades')
@section('content-actions')
    <a href="{{route('entities.create')}}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nueva Entidad</a>
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
                <td>Nombre</td>
                <td>Descripcion</td>
                <td>Depende</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach($entities as $entity)
            <tr>
                <td>{{$entity->nombre}}</td>
                <td>{{$entity->descripcion}}</td>
                <td>{{ optional($entity->entidad_padre)->nombre ?? '' }}</td>

                <td>
                        <a href="{{ route('entities.show', $entity) }}" class="btn btn-success" title="Ver Datos"><i
                                 class="fas fa-eye"></i></a>
                        <a href="{{ route('entities.edit', $entity) }}" class="btn btn-primary"><i
                                class="fas fa-edit"></i></a>
                        <button class="btn btn-danger btn-delete" data-url="{{route('entities.destroy', $entity)}}"><i
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
                text: "Realmente quiere eliminar esta entidad?",
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
           