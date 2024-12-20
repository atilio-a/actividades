@extends('layouts.admin')

@section('title', ' Listado de Ingresos')
@section('content-header', ' Ingresos')
@section('content-actions')
    <a href="{{route('cart.index')}}" class="btn btn-success">+NUEVO de Ingreso</a>
    <input  class="btn btn-primary  col-lg-3 col-3" type="button" onclick="printDiv('areaImprimir')" value="Imprimir Listado" />  <i  class="btn-danger fa-file-pdf-o "></i>
              
   <i class='fas fa-file-pdf' style='font-size:48px;color:red'></i>
@endsection

@section('content')


<script language="Javascript">


    function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var document_html = window.open('_blank');

                document_html.document.write( '<link rel=\"stylesheet\" href=\"https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css\" type=\"text/css\"/>' );

               
                document_html.document.write( '<link rel=\"stylesheet\" href=\"../css/app.css\" type=\"text/css\"/>' );

                 document_html.document.write( '<link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css\" type=\"text/css\"/>' );
                 document_html.document.write( '<link rel=\"stylesheet\" href=\"https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css\" type=\"text/css\"/>' );
               
                 document_html.document.write( printContents );
              
                 setTimeout(function () {
                       document_html.print();
                   }, 500)
    }
        </script>
   

  <!-- id="seleccion"  para imprimir
                 -->
 <div id="areaImprimir">      
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 justify-content">{{ __('Listado de Creditos') }}</h1>
       
    </div>
<div class="card"><!-- Log on to marco farfan 3888-15568587 for more projects -->
    <div class="card-body">
        <div class="row">
            <!-- <div class="col-md-3"></div> -->
            <div class="col-md-12">
                <form action="{{route('orders.index')}}">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" class="form-control" value="{{request('start_date')}}" />
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" class="form-control" value="{{request('end_date')}}" />
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-filter"></i> Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Recibi</th>
                    <th>Estado</th>
                    <th>Remanente.</th>
                    <th>Creado</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->getCustomerName()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedTotal()}}</td>
                    <td>{{ config('settings.currency_symbol') }} {{$order->formattedReceivedAmount()}}</td>
                    <td>
                        @if($order->receivedAmount() == 0)
                            <span class="badge badge-danger">No Pagado</span>
                        @elseif($order->receivedAmount() < $order->total())
                            <span class="badge badge-warning">Parcial</span>
                        @elseif($order->receivedAmount() == $order->total())
                            <span class="badge badge-success">Pagado</span>
                        @elseif($order->receivedAmount() > $order->total())
                            <span class="badge badge-info">Cambio</span>
                        @endif
                    </td>
                    <td>{{config('settings.currency_symbol')}} {{number_format($order->total() - $order->receivedAmount(), 2)}}</td>
                    <td>{{$order->created_at}}</td>
                    <td> 
                        <a href="{{ route('orders.show', $order) }}" class="btn btn-success"><i
                            class="fas fa-eye"></i></a>
                        <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary"><i
                        class="fas fa-edit"></i></a>

                        <a href="{{ route('orders.secciones', $order) }}" class="btn btn-secondary"><i
                            class="fa fa-braille"></i></a>
                    </td>

                </tr>
                @endforeach
            </tbody>
            <tfoot><!-- marcofarfan +54 9 3888 56-8587 for more projects -->
                <tr>
                    <th></th>
                    <th></th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($total, 2) }}</th>
                    <th>{{ config('settings.currency_symbol') }} {{ number_format($receivedAmount, 2) }}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
        {{ $orders->render() }}
    </div>
</div>
</div>
<!-- fin impresion -->

<!--  marcofarfan +54 9 3888 56-8587 for more projects -->
@endsection

