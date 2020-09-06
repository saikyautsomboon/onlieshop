@extends('Backend.backendtemplate')
    
@section('content')
	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Voucherno :{{$order->voucherno}}</h1>
            <h1 class="h3 mb-0 text-gray-800">OrderDate :{{$order->orderdate}}</h1>
            
          </div>

          <!-- Content Row -->
       <div class="container">
            <div class="row">
                <table class="table table-bordered">
                    <thead class="thead-dark justify-content-center text-center">
                        <th>No</th>
                        <th>Voucher Id</th>
                        <th>Price</th> 
                        <th>Qty</th>     
                        <th>SubTotal</th>
                    </thead>
                    <tbody>

                        @php 
                        $i=1;
                        $total=0;
                        @endphp

                        @foreach ($order->items as $item) {{-- itemsက itemcontroller ကနေပို့လာတဲ့name --}}
                        @php
                            $subtotal =$item->price*$item->pivot->qty;
                            $total +=$subtotal;
                        @endphp

                            <tr>
                                <td>{{$i++}}</td>
                                
                                <td>{{$item->name}}</td>
                                <td>
                                   {{$item->price}} MMK             
                                </td>
                                <td>{{$item->pivot->qty}}</td>
                                <td>
                                   {{$subtotal}}
                                </td>
                            </tr>

                        @endforeach
                        <tr class="bg-dark text-white">
                            <td colspan="4">Total:</td>
                            <td>{{$total}}</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- /.container-fluid -->
	</div>
@endsection