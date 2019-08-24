$('...').submit(function(e){

        //prevent the any defaults -of a page from reloading
        e.preventDefault();

        //handle submition. Ensuring that both feilds are entered with numbers
         if($('#num1').val()=='' || $('#num2').val()==''){

            alert("Please Enter  Numbers in Both Fields");
            return false;
        }


     var formData=$(this).serialize();
     console.log(formData);

     var url =$(this).attr('action');

     $.ajax({
        url: url,
        method:'post',
        data:formData,
        success: function(result){

            console.log(result);

            var res=JSON.parse(result);

            console.log("ANSWER "+res.result);

            var newrow='<tr class=""><td>'+res.num1+'</td><td>'+res.num2+'</td><td>'+res.answer+'</td><td></td> <td></td><td class="delete btn"><i class="fa fa-remove"></i></td></tr>';

            $('.mydata_table').append(newrow);
            
        }

    });//ajax

});
