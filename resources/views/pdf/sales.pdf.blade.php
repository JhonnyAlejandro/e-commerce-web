@extends('mobile')

@section('content')
    <table>
        <thead>
            <th>Código</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estado</th>
            <th>Venta total</th>
            <th>Fecha de creación</th>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->firstName }}</td>
                    <td>{{ $item->lastName }}</td>
                    <td>{{ $item->statusName }}</td>
                    <td>{{ $item->total_sale }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
