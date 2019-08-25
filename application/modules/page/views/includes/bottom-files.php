		
		</div>
		<!-- ./wrapper -->

		<script type="text/javascript">
  			
		    $('#form_data').submit(function(e){


		        //prevent the any defaults -of a page from reloading
		        e.preventDefault();

		        //handle submition. Ensuring that both feilds are entered with numbers
		         if($('#num1').val()=='' || $('#num2').val()==''){

		            alert("Please Enter  Numbers in Both Fields");
		            return false;
		        }

		     	var formData=$(this).serialize();
		     	console.log(formData);

		              //POST url
		     	var url ="<?php echo base_url();?>api/get_post_data";

			     $.ajax({
			        url: url,
			        method:'post',
			        data:formData,
			        success: function(result){

			            console.log(result);

			            var res=JSON.parse(result);

			            console.log("ANSWER: "+res.result);

			            	//table row - with results data
			            var newrow='<tr class="'+res.row_color+'"><td>'+res.num1+'</td><td>'+res.num2+'</td><td>'+res.response+'</td><td>'+res.expected+'</td> <td>'+res.passed+'</td><td class="delete  delete_row"><i class="fa fa-remove"></i></td></tr>';

			            	//append the table row to the table
			            $('.mydata_table').append(newrow);
			            
			        }

			    });//ajax


		    }); 


			  //handle click event on the delete icon/buttion
			  $(document).on("click",'.delete_row',function(){

			   $(this).closest('tr').remove(); 
			  });
			  
		</script>
	</body>
</html>
