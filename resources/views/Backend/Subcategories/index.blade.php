@extends('Backend.backendtemplate')


@section('content')
	<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Subcategory List</h1>
            <div class="text-right">
            	<a href="{{route('subcategories.create')}}"  class="btn btn-success">
            		Add New SubCategory
            	</a>
            </div>
          </div>

          <!-- Content Row -->
        <div class="container">
         	<div class="row">
         		<table class="table table-bordered">
         			<thead class="thead-dark justify-content-center text-center">
         				<th>No</th>	
         				<th>Category Name</th>
                        <th>SubcategoryName</th>
         				<th>Action</th>
         			</thead>
         			<tbody>

         				@php 
         				$i=1;
         				@endphp

         				@foreach ($subcategories as $subcategory) {{-- itemsက itemcontroller ကနေပို့လာတဲ့name --}}
         					<tr>
         						<td>{{$i++}}</td>
                                <th>{{$subcategory->category->name}}</th>
         						<td>{{$subcategory->name}}</td>
         						<td>
         							
         							<a href="{{route('subcategories.edit',$subcategory->id)}}" class="btn btn-info">Edit</a>
         							<form action="{{route('subcategories.destroy',$subcategory->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')     
                                        <button class="btn btn-danger">Delete</button>               
                                    </form>
         						</td>
         					</tr>

         				@endforeach
         				
         			</tbody>
         		</table>

         	</div>
        </div>
        <!-- /.container-fluid -->
	</div>
@endsection