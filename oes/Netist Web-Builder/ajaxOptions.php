<?php include_once 'dbconfig.php';?>
				<h1>Create Question </h1><br>
					<div class="form-group">
						<label>Question</label>
						<input id="txt_question" name="txt_question" class="form-control" placeholder="Enter text">
					</div>
					<?php
						if(isset($_POST["qtypeid"]) && !empty($_POST["qtypeid"])){
							//Get all course data
							$query = executeQuery("SELECT * FROM questiontype WHERE qtypeid = ".$_POST['qtypeid']." and isactive=1  ORDER BY qtype ASC");
						   
							//Display level list
							if($query->num_rows > 0){
								$crrOptions="";
								if($row = $query->fetch_assoc()){ 
							
								if($row['img'] == "on")
								{
									?>
										<script>
											function readURL(input){
												if(input.files && input.files[0]){
													var reader = new FileReader();
													reader.onload=function(e){
														$('#imgPreview').attr('src',e.target.result);
														
													}
													
													reader.readAsDataURL(input.files[0]);
												}
											}
										</script>
										<div class="form-group">
											
											<label class="col-sm-8">
												Select Question Image
												<br><br>
												<input type="file" id="file_img" name="file_img" onchange="readURL(this);" />
											</label>
											<br>
											<label class="col-sm-4 thumbnail">
												<img src="" alt="" id="imgPreview" name="imgPreview" width="100%"/>
											</label>
										</div>
									<?php
								}

								$i=1;
								$no_of_options=$row['no_of_options'];
								while($no_of_options >= $i)
								{
									echo"<div class='form-group'>
											<label>Option".$i."</label>
											<input id='txt_option_".$i."' name='txt_option_".$i."' class='form-control' placeholder='Enter Option'>
										</div>";
									$crrOptions= $crrOptions."<option>option".$i."</option>";
									$i++;
								}					
							}
					?>
					
					<div class="form-group">
						<label>Correct Answer</label>
						<select id="txt_correct_answer" name="txt_correct_answer" class="form-control">
							<?php
							echo $crrOptions;
							?>
						</select>
					</div>
			
			<?php
        
    }
	else
		echo '<option value="">Level not available</option>';
}
?>