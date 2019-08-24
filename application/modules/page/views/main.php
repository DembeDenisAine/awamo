
<?php  
	//--header or Top files ------------------->
	include_once('includes/top-files.php'); 
?>


<!----------------body conntent ----------------------->
<div class="left-side-wrapper">

	 <section class="form-content">
		<?php  

			//----------------form -------------->
			include_once('includes/form-left.php'); 
		?>
	 </section>

</div>

<div class="right-side-wrapper">

 
	<section class="table-content-header">
      <h1> Results </h1>
    </section>

    <section class="table-content">
		<?php
			//----------------table -------------->
			include_once('includes/table-right.php'); 
		?>
	</section>
</div>

<!----------------/END: body conntent ----------------->


<?php 
	//--------footer or bottom files--------------->
	 include_once('includes/bottom-files.php');   
?>