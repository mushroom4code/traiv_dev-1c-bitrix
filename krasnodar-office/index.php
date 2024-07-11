<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подразделение в Краснодаре");
?>

<section id="content">
	<div class="container">
	
			 <?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb",
	"traiv",
	Array(
		"COMPONENT_TEMPLATE" => "traiv",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"PATH" => "",
		"SITE_ID" => "s1",
		"START_FROM" => "0"
	)
);?>

<div class="row">
    <div class="col-12 col-xl-12 col-lg-12 col-md-12">
    	<h1><span>Подразделение в Краснодаре</span></h1>
    </div>
</div>

                <div class="row g-0 position-relative" id="about-row-image">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
		<div class="about-title-back-black">
			<span class="big-title">О подразделении в городе Краснодар</span>
			<span class="small-title">Наши клиенты - наша главная ценность. Наш клиентский сервис не просто служба поддержки. Мы заботимся о вас на каждом этапе вашего пути в сотрудничестве с Трайв. Нам важно как ваши дела)</span>

		</div>



	</div>
	
</div>





    <div class="row mt-5 d-none">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="about_title">Ключевые Приоритеты</div>
        	<hr>
        </div>
    </div>

<div class="row is-services mt-5 position-relative g-0 d-none">
<div class="is-about-back"></div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-about-area">
                                <div class="clients-area-item">
                                    <h4 class="title">Единство</h4>
                                    <p>Создание команды профессионалов с общей миссией.</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-about-area">
                                <div class="clients-area-item">
                                    <h4 class="title">Развитие</h4>
                                    <p>Стремление к росту и углублению экспертизы.</p>
                                </div>
                            </div>

                            <!--service item-->
                            <div class="col-lg-4 col-sm-6 is-service-about-area">
                                <div class="clients-area-item">
                                    <h4 class="title">Эффективность</h4>
                                    <p>Автоматизация и улучшение обслуживания.</p>
                                </div>
                            </div>

                        </div>
                        
                        
                        <div class="row mt-5 d-none">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="about_title">Команда Московского подразделения</div>
        	<hr>
        </div>
    </div>
    
    <div class="row g-0 position-relative mt-5 d-none">
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row g-0 position-relative h-100">
<?php 
$arr_list_user = [
    ["name"=>"Кондаков Сергей","photo"=>"IMG_1948_tcepkov.JPG","text"=>""],
    //["name"=>"Пронькин Анатолий","photo"=>"IMG_1950_pronkin.JPG","text"=>""],
    //["name"=>"Хорищенко Дмитрий","photo"=>"IMG_1949_horishenko.JPG","text"=>""],
    //["name"=>"Бугрова Анастасия","photo"=>"IMG_1947_bugrova.JPG","text"=>""],
    //["name"=>"Шустов Павел","photo"=>"IMG_1984_shustov.JPG","text"=>""],
    //["name"=>"Болихов Александр","photo"=>"IMG_1985_bolihov.JPG","text"=>""],
    //["name"=>"Колобродова Валерия","photo"=>"IMG_1986_kolobrodova.JPG","text"=>""],
    
    
];
$i = 170;
foreach($arr_list_user as $key=>$val){

     ?>
     <div class="col-12 col-xl-4 col-lg-4 col-md-4 pl-xl-5 pl-lg-5 pl-md-5 pr-xl-5 pr-lg-5 pr-md-5 pt-3 text-left h-lg-100">
     <div class="card h-100">
  <img src="<?=SITE_TEMPLATE_PATH?>/clients/<?php echo $val['photo']?>" class="about-image"/>
  <div class="card-body">
  <h5 class="card-title"><?=$val['name'];?></h5>
    <p class="card-text d-none"><?=$val['text'];?></p>
  </div>
</div>
</div>
     
     <?php
     $i++;
	}
?>
</div>
	</div>
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 mt-5 pt-xl-0 pt-lg-0 text-center">
	<div class="btn-group-blue"><a href="#w-form" class="btn-blue"><span>ХОЧУ В КОМАНДУ</span></a></div>
	</div>
	
</div>	

                        <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="about_title">Контакты сотрудников</div>
        	<hr>
        </div>
    </div>

<div class="container h-100">

<div class="row is-services mb-20 p-3 p-md-5 p-xl-5 p-lg-5 p-sm-5 position-relative g-0 import-page-back">
                            <div class="col-md-12 text-left pb-5 is-service-item-area">
                            <div class="row align-items-center h-100">
                            <?php 
                            
                            $arr_exp = array(
                                ['name'=>'Кондаков Сергей','dol'=>'Руководитель отдела','email'=>'kondakov@traiv.ru','p'=>'m'],
                                //['name'=>'Пронькин Анатолий','dol'=>'Менеджер','email'=>'pronkin@traiv.ru','p'=>'w'],
                                //['name'=>'Хорищенко Дмитрий','dol'=>'Менеджер','email'=>'horishenko@traiv.ru','p'=>'w'],
                                //['name'=>'Бугрова Анастасия','dol'=>'Менеджер','email'=>'bugrova@traiv.ru','p'=>'m'],
                                //['name'=>'Шустов Павел','dol'=>'Менеджер','email'=>'shustov@traiv.ru','p'=>'m'],
                                //['name'=>'Болихов Александр','dol'=>'Менеджер','email'=>'bolihov@traiv.ru','p'=>'m'],
                                //['name'=>'Колобродова Валерия','dol'=>'Менеджер','email'=>'kolobrodova@traiv.ru','p'=>'m'],
                            );
                            
                            foreach ($arr_exp as $key=>$val) {
                                ?>
                                
                                <div class="col-12 col-xl-2 col-lg-2 col-md-2 pt-5 text-center text-md-left text-lg-left text-xl-left text-sm-left">
                                <!-- 
                                <?php 
                                if ($val['p'] == 'm'){
                                ?>
                            		<img src="<?=SITE_TEMPLATE_PATH?>/import-page/exp1.jpg" class="img responsive exp-img" />
                            		<?php 
                                } else {
                                    ?>
                                    <img src="<?=SITE_TEMPLATE_PATH?>/import-page/exp2.jpg" class="img responsive" />
                                    <?php 
                                }
                            		?>
                            		-->
                            	</div>
                            	<div class="col-12 col-xl-6 col-lg-6 col-md-6 text-center text-md-left text-lg-left text-xl-left text-sm-left pt-5">
                            		<div class="exp-title"><?php echo $val['name'];?></div>
                            		<div class="exp-note">
                            		<p><?php echo $val['dol'];?></p>
                            		</div>
                            	</div>
                            	
                            	<div class="col-12 col-xl-4 col-lg-4 col-md-4 pt-2 pt-sm-5 pt-lg-5 pt-xl-5 pt-md-5 text-center text-md-left text-lg-left text-xl-left text-sm-left">
                            		<!-- <div class="btn-group-blue"><a href="mailto:<?php echo $val['email'];?>" class="btn-blue"><span>Связаться с сотрудником</span></a></div>-->
                            		<div class="copy-email" style="line-height:40px;">8 (800) 333-91-16 доб. 189</div>
                            		<span class="copy-email"><?php echo $val['email'];?></span>
                            	</div>
                                
                                <?php 
                            }
                            
                            ?>
                            	
                            </div>
                            </div>


                        </div>
                        
                        	<div id="map_krasnodar" class="mt-5">
	
	</div>
                        
                        </div>
	
	</div>
</section>

<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/clients.css");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>