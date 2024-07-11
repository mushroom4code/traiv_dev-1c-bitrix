<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подразделение в Москве");
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
    	<h1><span>Подразделение в Москве</span></h1>
    </div>
</div>

                <div class="row g-0 position-relative" id="about-row-image">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
		<div class="about-title-back-black">
			<span class="big-title">О Московском подразделении</span>
			<span class="small-title">Наши клиенты - наша главная ценность. Наш клиентский сервис не просто служба поддержки. Мы заботимся о вас на каждом этапе вашего пути в сотрудничестве с Трайв. Нам важно как ваши дела)</span>

		</div>



	</div>
	
</div>


<div class="row g-0 position-relative mt-5 d-none">
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row g-0 position-relative h-100">

     <div class="col-12 col-xl-4 col-lg-4 col-md-4 pr-xl-5 pr-lg-5 pr-md-5 text-left h-lg-100">
     <div class="card h-100 border-none pt-5">
  <img src="<?=SITE_TEMPLATE_PATH?>/clients/ivanova.jpg" class="about-image"/>
  <div class="card-body text-center">
  <h5 class="card-title pt-0">Анастасия Иванова</h5>
    <p class="card-text">Руководитель клиентского отдела</p>
  </div>
</div>
</div>

<div class="col-12 col-xl-8 col-lg-8 col-md-8 text-left h-lg-100">

        <div class="text-black" style="border-radius: 15px;border:0px green solid;">
          <div class="card-body p-0 p-md-5 p-lg-5 p-xl-5">
<br>
<br><br>
<br>
            <i class="fa fa-quote-left fa-2x mb-4"></i>

            <p class="lead service_quote">Коллеги, здравствуйте!
<br>

Мне приятно работать в такой сильной и амбициозной компании. Где нет предела к развитию и самореализации, есть творческий подход к любой сложной задаче. Где каждый может найти себе дело по душе. Главное верить в то, что ты делаешь и в свою команду.
</p>
          </div>
        </div>

</div>
    
</div>
	</div>
	
</div>	


    <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="about_title">Ключевые Приоритеты</div>
        	<hr>
        </div>
    </div>

<div class="row is-services mt-5 position-relative g-0">
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
                        
                        
                        <div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="about_title">Команда Московского подразделения</div>
        	<hr>
        </div>
    </div>
    
    <div class="row g-0 position-relative mt-5">
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row g-0 position-relative h-100">
<?php 
$arr_list_user = [
    ["name"=>"Цепков Дмитрий","photo"=>"IMG_1948_tcepkov.JPG","text"=>""],
    ["name"=>"Пронькин Анатолий","photo"=>"IMG_1950_pronkin.JPG","text"=>""],
    //["name"=>"Хорищенко Дмитрий","photo"=>"IMG_1949_horishenko.JPG","text"=>""],
    ["name"=>"Бугрова Анастасия","photo"=>"IMG_1947_bugrova.JPG","text"=>""],
    ["name"=>"Шустов Павел","photo"=>"IMG_1984_shustov.JPG","text"=>""],
    ["name"=>"Болихов Александр","photo"=>"IMG_1985_bolihov.JPG","text"=>""],
    ["name"=>"Колобродова Валерия","photo"=>"IMG_1986_kolobrodova.JPG","text"=>""],
    
    
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
        	<div class="about_title">Вакансии Московского офиса</div>
        	<hr>
        </div>
    </div>
    
    <div class="container h-100">

<div class="row is-services mb-20 p-3 p-md-5 p-xl-5 p-lg-5 p-sm-5 position-relative g-0 import-page-back">
                            <div class="col-md-12 text-left pb-5 is-service-item-area">
                            <div class="row align-items-center h-100">
                            <?php 
                            
                            $arr_exp = array(
                                ['name'=>'Менеджер по продажам В2В','dol'=>'от 100 000 ₽ до вычета налогов','link'=>'https://spb.hh.ru/vacancy/94807660?hhtmFrom=vacancy_search_list'],
                                ['name'=>'Ассистент отдела продаж','dol'=>'от 65 000 ₽ до вычета налогов','link'=>'https://spb.hh.ru/vacancy/93965843?hhtmFrom=vacancy_search_list'],
                                ['name'=>'Руководитель группы продаж','dol'=>'от 150 000 до 500 000 ₽','link'=>'https://spb.hh.ru/vacancy/93477599?hhtmFrom=vacancy_search_list'],
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
                            		<div class="btn-group-blue"><a href="<?php echo $val['link'];?>" target="_blank" class="btn-blue"><span>Подробнее</span></a></div>
                            	</div>
                                
                                <?php 
                            }
                            
                            ?>
                            	
                            </div>
                            </div>


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
                                ['name'=>'Цепков Дмитрий','dol'=>'Руководитель отдела','email'=>'tsepkov@traiv.ru','p'=>'m'],
                                ['name'=>'Пронькин Анатолий','dol'=>'Менеджер','email'=>'pronkin@traiv.ru','p'=>'w'],
                                //['name'=>'Хорищенко Дмитрий','dol'=>'Менеджер','email'=>'horishenko@traiv.ru','p'=>'w'],
                                ['name'=>'Бугрова Анастасия','dol'=>'Менеджер','email'=>'bugrova@traiv.ru','p'=>'m'],
                                ['name'=>'Шустов Павел','dol'=>'Менеджер','email'=>'shustov@traiv.ru','p'=>'m'],
                                ['name'=>'Болихов Александр','dol'=>'Менеджер','email'=>'bolihov@traiv.ru','p'=>'m'],
                                ['name'=>'Колобродова Валерия','dol'=>'Менеджер','email'=>'kolobrodova@traiv.ru','p'=>'m'],
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
                            		<span class="copy-email"><?php echo $val['email'];?></span>
                            	</div>
                                
                                <?php 
                            }
                            
                            ?>
                            	
                            </div>
                            </div>


                        </div>
                        
                        	<div id="map_mos" class="mt-5">
	
	    	<div class="map_office_area">
    	
    	</div>
	
	</div>
                        
                        </div>
	
	</div>
</section>

<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/clients.css");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>