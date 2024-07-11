<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог стандартного крепежа");
?>
<section id="content">
		<div class="container">
		
		
		
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "traiv", Array(
                "COMPONENT_TEMPLATE" => ".default",
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "zf",
            ),
                false
            ); ?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Каталог стандартного крепежа</span></h1>
    </div>
</div>

<div class="row mb-3">
	<div class="col-6 col-xl-2 col-lg-2 col-md-2 text-center text-sm-left">
		<div class="btn-group-blue">
			<a href="<?=SITE_TEMPLATE_PATH?>/images/catalogue_traiv.pdf" class="btn-i" download target="_blank">
				<span><i class="fa fa-download"></i> Сохранить файл</span>
			</a>
		</div>
	</div>
</div>
	                
<object><embed src="<?=SITE_TEMPLATE_PATH?>/images/catalogue_traiv.pdf" width="100%" height="900" /></object>

		</div>
	</section>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>