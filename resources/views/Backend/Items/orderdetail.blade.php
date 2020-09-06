@extends('Backend.backendtemplate')


@section('content')
	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Item Detail</h1>
            <div class="text-right">
            	<a href="{{route('items.index')}}"  class="btn btn-success">
            		Back
            	</a>
            </div>
          </div>

          <!-- Content Row -->
        <div class="container">
         	<div class="row">
         		<table class="table" border="0" >
         			<tr>
                        <td rowspan="7">
                            <img src="{{asset($item->photo)}}" style="width: 400px; height: 500px" class="img-fluid">
                        </td>
                        <td>Item Name : {{$item->name}} </td>
                    </tr>
                    <tr>
                        <td> Item Price : {{$item->price}}</td>
                        
                    </tr>
                    <tr>
                        <td> Item CodeNo : {{$item->codeno}}</td>      
                    </tr>
                    <tr>
                        <td>Item Discount : {{$item->discount}}</td>
                    </tr>
                    <tr>
                        <td>Item Description : {{$item->description}}</td>
                    </tr>
                    <tr>
                        <td>SubCategory Name : {{$item->subcategory->name}}</td>
                    </tr>
                    <tr>
                        <td>Brand Name : {{$item->brand->name}}</td>
                    </tr>
         		</table>

         	</div>
        </div>
        <!-- /.container-fluid -->
	</div>
@endsection