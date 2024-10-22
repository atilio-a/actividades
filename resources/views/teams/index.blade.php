@extends('layouts.admin')

@section('title', ' Personas')
@section('content-header', ' Personas')
@section('content-actions')
    <form method="GET" action="{{ route('teams.index') }}" class="form-inline">
        <input type="text" name="search" class="form-control w-75" placeholder="Buscar..."  value="{{ request()->get('search') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    <br>
    <a href="{{ route('teams.create') }}" class="btn btn-success"><i class="fas fa-plus"></i> Registar nueva persona</a>
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
                        <td>Apellido</td>
                        <td>Telefono</td>
                        <td>Mail</td>
                        <td>Entidad</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($teams as $team)
                        <tr>
                            <td>{{ $team->nombre }}</td>
                            <td>{{ $team->apellido }}</td>
                            <td>{{ $team->telefono }}</td>
                            <td>{{ $team->mail }}</td>
                            <td>{{ $team->entity->nombre }}</td>
                            <td>
                                <a href="{{ route('teams.show', $team) }}" class="btn btn-success" title="Ver Datos"><i
                                        class="fas fa-eye"></i></a>
                                <a href="{{ route('teams.edit', $team) }}" class="btn btn-primary"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-danger btn-delete" data-url="{{ route('teams.destroy', $team) }}"><i
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
            $(document).ready(function() {
                $(document).on('click', '.btn-delete', function() {
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
                        text: "Realmente quiere eliminar esta persona?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Si, borrala!',
                        cancelButtonText: 'No',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            $.post($this.data('url'), {
                                _method: 'DELETE',
                                _token: '{{ csrf_token() }}'
                            }, function(res) {
                                $this.closest('tr').fadeOut(500, function() {
                                    $(this).remove();
                                })
                            })
                        }
                    })
                })
            })
        </script>
    @endsection
