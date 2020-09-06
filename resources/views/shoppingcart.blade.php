@extends('master1')
@section('content')
		<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Your Shopping Cart </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container mt-5">
		
		<!-- Shopping Cart Div -->
		<div class="row mt-5 shoppingcart_div">
			<div class="col-12">
				<a href="/" class="btn mainfullbtncolor btn-secondary float-right px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>
		</div>

		<div class="row mt-5 shoppingcart_div">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th colspan="3"> Product </th>
							<th colspan="3"> Qty </th>
							<th> Price </th>
							<th> Total </th>

						</tr>
					</thead>
					<tbody id="shoppingcart_table">
						
					</tbody>
					
				</table>
			</div>
		</div>

		<!-- No Shopping Cart Div -->
		<div class="row mt-5 noneshoppingcart_div text-center">
			
			<div class="col-12">
				<h5 class="text-center"> There are no items in this cart </h5>
			</div>

			<div class="col-12 mt-5 ">
				<a href="/" class="btn btn-secondary mainfullbtncolor px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>

			</div>
			<div class="col-md-12 mt-5">
				@role('Customer')
					<a href="#" class="btn btn-info float-right buy_now" type="submit">		CheckOut</a>
					<textarea class="notes" placeholder="Your Notes Here!"></textarea>
				@else
					<a href="{{route('loginpage')}}" class="btn btn-info float-right buy_now">Login CheckOut</a>
					
				@endrole
			</div>

		</div>
		

	</div>
	

@endsection