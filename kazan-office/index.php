<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подразделение в Казани");
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
    	<h1><span>Подразделение в Казани</span></h1>
    </div>
</div>


        <div class="row g-0 position-relative">
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row g-0 position-relative h-100">

     <div class="col-12 col-xl-5 col-lg-5 col-md-5 pr-xl-5 pr-lg-5 pr-md-5 text-left h-lg-100">
     <div class="card h-100 border-none">
  <img src="<?=SITE_TEMPLATE_PATH?>/clients/kazan-office.jpg" class="about-image"/>
  
</div>
</div>

<div class="col-12 col-xl-7 col-lg-7 col-md-7 text-left h-lg-100">

        <div class="text-black" style="border-radius: 15px;border:0px green solid;">
          <div class="card-body p-0 p-md-5 p-lg-5 p-xl-5">
<br>
            <!-- <i class="fa fa-quote-left fa-2x mb-4"></i>-->

            <p class="lead service_quote">
<br>

Наши клиенты - наша главная ценность. Мы заботимся о вас на каждом этапе вашего пути с Трайв.
</p>
          </div>
        </div>

</div>
    
</div>
	</div>
	
</div>	


                <div class="row g-0 position-relative d-none" id="about-row-image">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
		<div class="about-title-back-black">
			<span class="big-title d-none">О Казанском подразделении</span>
			<span class="small-title">Наши клиенты - наша главная ценность. Наш клиентский сервис не просто служба поддержки. Мы заботимся о вас на каждом этапе вашего пути с Трайв.</span>

		</div>



	</div>
	
</div>

                        
<div class="row mt-5">
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-left">
        	<div class="about_title">Команда казанского подразделения</div>
        	<hr>
        </div>
    </div>
    
    <div class="row g-0 position-relative mt-5">
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row g-0 position-relative h-100">
<?php 
$arr_list_user = [
    ["name"=>"Линар","photo"=>"linart.jpg","text"=>"
<div class='card-body p-0 '><i class='fa fa-quote-left fa-2x mt-4'></i><p class='lead hr_service_quote'>От имени команды менеджеров по продажам, мы глубоко ценим доверие и выбор каждого нашего клиента. Всегда стремимся превзойти ваши ожидания, предлагая только лучшие продукты и услуги, адаптированные под индивидуальные потребности. Ваш успех и удовлетворение от сотрудничества с нами – это то, к чему мы стремимся каждый день.</p></div>

"],
    ["name"=>"Ильнар","photo"=>"fanzilt.jpg","text"=>"

<div class='card-body p-0 '><i class='fa fa-quote-left fa-2x mt-4'></i><p class='lead hr_service_quote'>Горжусь возможностью предложить нашим клиентам высококачественную продукцию, которая отвечает всем стандартам отрасли. Наша компания постоянно работает над инновациями и улучшением производственных процессов, чтобы предоставлять вам наилучшие решения. Мы ценим каждого нашего клиента и стремимся к тому, чтобы наше сотрудничество способствовало вашему бизнесу, обеспечивая вас продукцией, которая поможет реализовать самые амбициозные проекты.</p></div>

"],
    ["name"=>"Фанзиль","photo"=>"ilnart1.jpg","text"=>"

<div class='card-body p-0 '><i class='fa fa-quote-left fa-2x mt-4'></i><p class='lead hr_service_quote'>Мы стремимся создать непревзойденное впечатление для каждого, кто выбирает наши услуги и продукты. Мы верим в силу персонализированного подхода и внимания к деталям, что позволяет нам строить долгосрочные отношения и понимание потребностей наших клиентов.</p></div>
"]
    
];
$i = 170;
foreach($arr_list_user as $key=>$val){

     ?>
     <div class="col-12 col-xl-4 col-lg-4 col-md-4 pl-xl-5 pl-lg-5 pl-md-5 pr-xl-5 pr-lg-5 pr-md-5 text-left h-lg-100">
     <div class="card h-100">
  <img src="<?=SITE_TEMPLATE_PATH?>/clients/<?php echo $val['photo']?>" class="about-image"/>
  <div class="card-body">
  <h5 class="card-title"><?=$val['name'];?></h5>
    <p class="card-text"><?=$val['text'];?></p>
  </div>
</div>
</div>
     
     <?php
     $i++;
	}
?>
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
        <div class="col-12 col-xl-12 col-lg-12 col-md-12 text-center">
<iframe width="560" height="315" src="https://www.youtube.com/embed/1NHmDx3A7Ow?si=8bC1u_xB5fjI6jAV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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
                                ['name'=>'Вафин Линар','dol'=>'Руководитель подразделения','email'=>'vafin@traiv.ru','p'=>'m'],
                                ['name'=>'Бадриев Ильнар','dol'=>'Менеджер по продажам','email'=>'badriev@traiv.ru','p'=>'w'],
                                ['name'=>'Гильмутдинов Фанзиль','dol'=>'Менеджер по продажам','email'=>'gilmutdinov@traiv.ru','p'=>'m'],
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
                        
	<div id="map_kazan" class="mt-5">
	
	</div>
                        
                        </div>
	
	</div>
</section>

<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/clients.css");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>