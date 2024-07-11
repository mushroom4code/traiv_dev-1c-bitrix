<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Проверка");

if ( $USER->IsAuthorized() )
{
    if ($USER->GetID() == '3092' || $USER->GetID() == '7174' || $USER->GetID() == '2938') {
    
            $file = "/checkitem/checkitem.php";
        
    ?>
    <div class="p-5">
<form enctype="multipart/form-data" method="post" action=<?php echo $file;?> id='file_form'>
<div class="content"><div class="container">

<label for="exampleFileUpload" class="button">Загрузить файл</label>
<input type="file" id="exampleFileUpload" name="file_price" class="show-for-sr">
<input type="submit" value="Загрузить">
      </div>
    </div>

</form>
</div>

<script>
$(document).ready(function(){

	var myfile="";
	$('#exampleFileUpload').change(function() {
		
		 myfile= $( this ).val();
		   var ext = myfile.split('.').pop();
		   if(ext=="xlsx"){
			//   $('#file_form').submit();
			   //window.reload();
			   
		   } else{
			   alert('Файл не в формате xlsx!');
		   }
	});
	
});
</script>
<?php 
}
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>