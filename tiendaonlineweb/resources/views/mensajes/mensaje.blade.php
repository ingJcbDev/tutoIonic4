@extends('layouts.app')

@section('htmlheader_title')
    Mensajeria
@endsection

@section('contentheader_title', 'Mensajes')


@section('main-content')
        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Bandeja de entrada</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped" id="example1">
                                <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Telefono</th>
                                    <th>Email</th>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Fecha</th>
                                    <th>Accion</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($contactos as $contacto)
                                    @php
                                    switch ($contacto->status){
                                        case 'pedin':
                                            $text = 'text-yellow';
                                        break;
                                        case 'cancel':
                                            $text = 'text-muted';
                                        break;
                                        case 'complete':
                                            $text = 'text-light-blue';
                                        break;
                                        case 'complete':
                                            $text = 'text-success';
                                        break;
                                    }

                                    @endphp
                                <tr class="{{ $text }}">
                                    {{--<td class="mailbox-name"><a href="{{ url('admin/mensajes/'.$contacto->id) }}" data-toggle="tooltip" title="Informacion">{{$contacto->id_cliente }} {{ $contacto->apellido}}</a></td>--}}
                                    {{--<td class="mailbox-subject">{{ str_limit($contacto->descripcion, 25) }}</td>--}}
                                    {{--<td>--}}
                                        {{--@php--}}
                                            {{--$publicaciones = App\Tbl_publicaciones::find($contacto->publicacion->id);--}}
                                        {{--@endphp--}}
                                        {{--@foreach($publicaciones->publicacionImagen as $img)--}}
                                            {{--<img src="../{{ $img->ruta }}" class="img-responsive" style="background-size: cover" width="70px">--}}
                                            {{--@break--}}
                                        {{--@endforeach--}}
                                        {{--{{ $contacto->publicacion->titulo }} ${{ $contacto->publicacion->precio }}--}}

                                    {{--</td>--}}
                                    {{--<td>{{ $contacto->email }}</td>--}}
                                    {{--<td>{{ $contacto->telefono }}</td>--}}
                                    <td class="mailbox-date">{{ $contacto->name }}</td>
                                    <td class="mailbox-date">{{ $contacto->telefono }}</td>
                                    <td class="mailbox-date">{{ $contacto->email }}</td>
                                    <td class="mailbox-date">{{ $contacto->titulo }}</td>
                                    <td class="mailbox-date">{{ $contacto->precio }}</td>
                                    <td class="mailbox-date">{{ $contacto->fecha }}</td>
                                    <td class="mailbox-attachment">
                                        <div class="btn-group">
                                            <a type="button" class="btn btn-default btn-sm" href="{{ url('admin/usuarios/'.$contacto->id.'/edit') }}" data-toggle="tooltip" title="Informacion"><i class="fa fa-user"></i></a>
                                            <a type="button" class="btn btn-default btn-sm" href="{{ url('admin/publicaciones/'.$contacto->id_producto.'/edit') }}" data-toggle="tooltip" title="Informacion"><i class="fa fa-shopping-cart"></i></a>
                                            {{--<a type="button" class="btn btn-default btn-sm" href="{{ url('admin/mensajes/'.$contacto->id.'/borrar') }}" data-toggle="tooltip" title="Borrar"><i class="fa fa-trash-o"></i></a>--}}
                                            <a type="button" class="btn btn-default btn-sm" href="{{ url('admin/mensajes/'.$contacto->id) }}" data-toggle="tooltip" title="Responder"><i class="fa fa-check"></i></a>
                                        </div>
                                    </td>


                                </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Mensaje</th>
                                    <th>Producto</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Accion</th>
                                    <th>Tiempo</th>
                                </tr>
                                </tfoot>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">

                    </div>
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->

        </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable({
                aaSorting: [[6, 'desc']],
                "language": {
                    "url": "http://agrofans.com/plugins/datatables/lang/Spanish.json"
                }
            });
        });
    </script>
@endsection
