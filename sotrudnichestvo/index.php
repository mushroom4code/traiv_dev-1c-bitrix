<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Статьи. Международное сотрудничество");
$APPLICATION->SetPageProperty("title", "Отраслевые решения");
$APPLICATION->SetTitle("Отраслевые решения");
?>	<section id="content">
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
    	<h1><span>Международное сотрудничество</span></h1>
    </div>
</div>	

<p>
Сегодня как торгово-производственная компания мы работаем не только с партнерами на территории РФ, но и по всему СНГ. Технические и технологические компетенции уже сегодня позволяют нам работать на международном рынке. Компания «Трайв» имеет многолетний опыт плодотворного сотрудничества с Казахстаном, Белоруссией, Узбекистаном. Мы  открыты к сотрудничеству с европейскими и азиатскими партнерами, поэтому для вашего удобства подготовили информацию о продукции и услугах на английском, немецком, казахском и китайском языках, а также страницу для партнеров из Беларуси.

</p>

            <div class="row friends-list mt-4">

        
	<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/england/"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/images/flags/flag_eng1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/england/">English</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        <div class="btn-group-blue mt-3">
                        	<a href="/england/" class="btn-blue">
                            	<span><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
		<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/germany/"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/images/flags/flag_de1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/germany/">Deutsch</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        
                        <div class="btn-group-blue mt-3">
                        	<a href="/germany/" class="btn-blue">
                            	<span><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>
		</div>
	
				<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/kazakhstan/"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/images/flags/flag_kaz1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/kazakhstan/">Қазақша</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        
                        <div class="btn-group-blue mt-3">
                        	<a href="/kazakhstan/" class="btn-blue">
                            	<span><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
			<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/china/"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/images/flags/flag_china1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/china/">中文</a></h3>
                    <div class="posts-i-ttl-note text-center">
                       
                        <div class="btn-group-blue mt-3">
                        	<a href="/china/" class="btn-blue">
                            	<span><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>
	
				<div class="col-12 col-xl-4 col-lg-4 col-md-4 posts-i">
		<a class="posts-i-img" href="/belarus/"><span style="background: url(<?=SITE_TEMPLATE_PATH?>/images/flags/flag_bel1.jpg)"></span></a>
		
<div class="posts-i-info">
                    <h3 class="posts-i-ttl"><a href="/belarus/">Беларусь</a></h3>
                    <div class="posts-i-ttl-note text-center">
                        
                        <div class="btn-group-blue mt-3">
                        	<a href="/belarus/" class="btn-blue">
                            	<span><i class="fa fa-eye" aria-hidden="true"></i></span>
                            </a>
                        </div>
                    </div>
                </div>

	</div>



    </div>


		</div>
	</section><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>