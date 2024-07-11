<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("test");

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '2743' || $USER->GetID() == '3443' ) {
    
        if ($USER->GetID() == '3092'){
            $file = "/filex/test_filex1.php";
        }
        else {
            $file = "/filex/test_filex1.php";
        }
        
    ?>
<form enctype="multipart/form-data" method="post" action=<?php echo $file;?> id='file_form'>
<div class="content"><div class="container">

<label for="exampleFileUpload" class="button">Загрузить файл</label>
<input type="file" id="exampleFileUpload" name="file_price" class="show-for-sr">
<input type="submit" value="Загрузить">
      </div>
    </div>

</form>
     <?php 
    }
}
?>

<script>
$(document).ready(function(){

	var myfile="";
	$('#exampleFileUpload').change(function() {
		
		 myfile= $( this ).val();
		   var ext = myfile.split('.').pop();
		   if(ext=="xls"){
			//   $('#file_form').submit();
			   //window.reload();
			   
		   } else{
			   alert('Файл не в формате xls!');
		   }
	});
	
});
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>