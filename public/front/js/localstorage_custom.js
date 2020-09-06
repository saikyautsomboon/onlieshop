$(document).ready(function () {
	 update_cart_count();
	 show_cart();

   $.ajaxSetup({
    headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
   });
	$('.addtocartBtn').click(function () {

		var id=$(this).data('id');

        var photo=$(this).data('photo');
        var name=$(this).data('name');
        var price=$(this).data('price');

          var product={
            id:id,
            name:name,
           	price:price,
            photo:photo,
           quantity:1
          };
         add_to_cart(product);
          update_cart_count();
	})
	function add_to_cart(product) {
		var mycart=localStorage.getItem('mycart');
		if(!mycart){
              mycart='{"item_list":[]}';//json string,,,name and array
          }
          var mycart_obj=JSON.parse(mycart);

          var has_id=false;
          $.each(mycart_obj.item_list,function (i,v) {
          	if(v.id==product.id){
          		has_id=true;
          		v.quantity++;
          	}
          })

          if(!has_id){
          	mycart_obj.item_list.push(product);
            }//push product into mycart_obj
            console.log(mycart_obj);
            //convert mycart to JSON string and store in localstorage
            localStorage.setItem('mycart',JSON.stringify(mycart_obj))
    }
        function update_cart_count() {
        	var mycart=localStorage.getItem('mycart');
        	if(mycart){
              //json string to obj
              var mycart_obj=JSON.parse(mycart);
              // check product_list_array
              if(mycart_obj.item_list.length){
              	var total=0;
              	$.each(mycart_obj.item_list,function (i,v) {
              		total+=v.quantity;

              	})
              	$(".cartNoti").html(total);
              }
          }
      	}
     function show_cart() {
            var mycart=localStorage.getItem('mycart');
           
            
            if(mycart){

              var mycart_obj=JSON.parse(mycart);
              if(mycart_obj.item_list.length){

                var data='';
                
                var total=0;
                $.each(mycart_obj.item_list,function (i,v) {

                if(v){   
                  var price=v.price;
                  var photo=v.photo;
                  var quantity=v.quantity;
                  var subtotal=quantity*price;
                  total+=subtotal;
                 
                  data+=`<tr>
                  		<td>
                  			<button class="btn btn-outline-danger remove btn-sm" style="border-radius: 50%" data-id=$id>
                  			<i class="icofont-close-line"></i>

                  		</td>
                          <td colspan="3"><img src='${photo}' width=120 height=100></td>
                          
                          <td colspan="3">
                          <i class="btn fa fa-plus-circle fa-2x" aria-hidden="true" style='color:green' data-id=${v.id} ></i>
                              <span class='badge badge-secondary ' style='font-size:24px'>${quantity} </span>
                            <i class="btn fa fa-minus-circle fa-2x" aria-hidden="true" style='color:red' data-id=${v.id}></i>
                          </td>
                          <td>${price}</td>
                          <td>${subtotal}</td>
                          
                        </tr>`;    
                    }
                })
                data+=`<tr><td colspan=8> Total</td>
                            <td colspan=2>${total}</td>
                            </tr>`;
                $("#shoppingcart_table").html(data);
                $("#alltotal").html(total);
              }
              else{
                $("#shoppingcart_table").html('');
              }

           }
          }
          

          $("#shoppingcart_table").on("click",".fa-plus-circle",function () {
            var id=$(this).data('id');
            // alert(id);
            var mycart=localStorage.getItem('mycart');
            var mycart_obj=JSON.parse(mycart);
            $.each(mycart_obj.item_list,function (i,v) {
              if(v.id==id){
                v.quantity++;
              }
            })
            localStorage.setItem('mycart',JSON.stringify(mycart_obj));
            show_cart();
            update_cart_count();
          })
          $("#shoppingcart_table").on("click",".fa-minus-circle",function () {
            var id=$(this).data('id');
             //alert(id);
            var mycart=localStorage.getItem('mycart');
             var mycart_obj=JSON.parse(mycart);

            $.each(mycart_obj.item_list,function (i,v) {
              if(v){
              	
                if(v.id==id){
                  if(v.quantity==1){
                    var ans=confirm('Are your sure to Delete:');

                    if(ans){
                      mycart_obj.item_list.splice(i,1);
                    }
                  }
                  else{
                    v.quantity--;
                   }
                 }
                
              }
            })
            localStorage.setItem('mycart',JSON.stringify(mycart_obj));
            show_cart();
            update_cart_count();
          })
          
          $("#shoppingcart_table").on("click",".remove",function () {
            	var id=$(this).data('id');
            	var mycart=localStorage.getItem('mycart');
            	var mycart_obj=JSON.parse(mycart);
            	
            	if(mycart_obj){
            		mycart_obj.item_list.splice(id,1);
            	}

            	localStorage.setItem('mycart',JSON.stringify(mycart_obj));
            	show_cart();
            	update_cart_count();
            })

          $('.buy_now').on('click',function(){
              var notes = $('.notes').val();

              var shopstring  = localStorage.getItem("mycart");
              var shopArr=JSON.parse(shopstring);
              var shop_data=shopArr.item_list;

              if (shopstring){
                //ajax stepup
                $.post('/orders',{shop_data:shop_data,notes:notes},function(response){
              if(response)
              {

                alert(response);
                localStorage.clear();
                show_cart();
                update_cart_count();
                locaton.href="/";
              }
              })
            }
          })
})