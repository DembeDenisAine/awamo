  
 <!-- =============== FORM ======================= -->

  <form  id="form_data">
      <span id="msg"></span>
      <h2>Numbers</h2>
      <div class="form-group">
        <label for="Number_One">Number One</label>
        <input type="text" name="num1" id="num1" class="form-control" placeholder="Enter number one" required>
      </div>

      <div class="form-group">
        <label for="Number_Two">Number Two</label>
        <input type="text" name="num2" id="num2" class="form-control" placeholder="Enter number two" required>
      </div>

      <div class="form-group">
        <label for="Operation">Operation</label>
        <select type="text" class="form-control" name="operand" id="operand" required>
          <option value="+">Add</option>
          <option value="-">Subtract</option>
          <option value="/">Devide</option>
          <option value="*">Multiply</option>
        </select>
      </div>
    
     <button class="form-control" type="submit"> Post </button> 
  </form>


<!-- ===============/end: FORM ======================= -->
<script type="text/javascript">

    $('#form_data').submit(function(e){


        //prevent the any defaults -of a page from reloading
        e.preventDefault();

        //handle submition. Ensuring that both feilds are entered with numbers
         if($('#num1').val()==''){

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

            console.log("ANSWER "+res.result);

            var newrow='<tr class="greyrow"><td>'+res.num1+'</td><td>'+res.num2+'</td><td>'+res.answer+'</td><td></td> <td></td><td class="delete  delete_row"><i class="fa fa-remove"></i></td></tr>';

            $('.mydata_table').append(newrow);
            
        }

    });//ajax


    }); 

</script>