<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "HR-блок");
$APPLICATION->SetPageProperty("title", "HR-блок");
$APPLICATION->SetTitle("HR-блок");
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
<h1 class=""><span>HR</span></h1>
</div>
</div>

<?php 

$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(8)->fetch();

$entity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
$entity_data_class = $entity->getDataClass();

$data = $entity_data_class::getList(array(
    "select" => array("*")
));

if (intval($data->getSelectedRowsCount()) > 0){
    while($arData = $data->Fetch()){
        $hr_item1_title = $arData['UF_HR1_TITLE'];
        $hr_item1_note = $arData['UF_HR1_NOTE'];
    }
}

?>

<div class="row g-0 position-relative" id="hr-row-image1">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 p-xl-5 p-lg-5 p-md-5 text-center">
		<div class="hr-title-back-black">
			<span class="big-title"><?
			$hr_item1_title;
			$hr_item1_title_arr = explode(" ", $hr_item1_title);
			$hr_item1_title_arr_res = [$hr_item1_title_arr[0],$hr_item1_title_arr[1]." ".$hr_item1_title_arr[2],$hr_item1_title_arr[3]];
			//print_r($hr_item1_title_arr_res);
			?>
			<div class="row">
			<?php 
			foreach($hr_item1_title_arr_res as $key=>$val){
			    //echo $key;
			    if ($key == 0){
			        ?>
			        <div class="col-12 col-xl-10 col-lg-10 col-md-10 offset-md-2 offset-xl-2 offset-lg-2 text-left">
			        <?php 
			    }
			    else if ($key == 1){
			        ?>
			        <div class="col-12 col-xl-9 col-lg-9 col-md-9 offset-md-3 offset-xl-3 offset-lg-3 text-left">
			        <?php 
			    }
			    else if ($key == 2){
			        ?>
			        <div class="col-12 col-xl-9 col-lg-9 col-md-9 offset-md-3 offset-xl-3 offset-lg-3 text-left text-lg-center text-md-center text-xl-center">
			        <?php 
			    }
			    echo $val;
			    ?>
			    </div>
			    <?php 
			}
			?>
			</div>
			</span>

<div class="row mt-xl-4 mt-lg-4 mt-md-4">
    <div class="col-12 col-xl-5 col-lg-5 col-md-5 offset-md-1 offset-xl-1 offset-lg-1 text-left">
        <span class="small-title"><?=$hr_item1_note;?></span>
    </div>
    
    <div class="col-12 col-xl-6 col-lg-6 col-md-6 mt-3 mt-lg-1 mt-xl-1 mt-md-1 text-center text-lg-left text-md-left text-xl-left">
        <img src="<?=SITE_TEMPLATE_PATH?>/images/logo_new_tk6.png" class="logotype_img"/>
    </div>

</div>
		</div>
	</div>
</div>

<!-- /////////////// -->

<div class="row g-0 position-relative pt-5 pt-xl-0 pt-lg-0 pt-md-0">
	<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left">
		 <span class="hr-big-title pb-2">Мы ценим</span>
	</div>
	
	<div class="col-12 col-xl-6 col-lg-6 col-md-6 p-xl-5 p-lg-5 p-md-5 text-left">
	
<ul class="hr-title-cloud-item-area">

	<?php 
	$arr_list = ["Честность",
	    "Осознанность",
	    "Открытость к изменениям",
	    "Способность самостоятельно принимать решения",
	    "Стремление постоянно искать возможности для роста и развития"];
	
	foreach($arr_list as $key=>$val){
	    ?>
	        <li>
    	<span class="hr-title-cloud-item"><i class="fa fa-check-square-o"></i><?=$val;?></span>
    </li>
	    <?php 
	}
	
    ?>
    </ul>
	</div>
	
</div>	

<!-- /////////////// -->

<div class="row g-0 position-relative">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 p-xl-5 p-lg-5 p-md-5 text-left">
		 <span class="hr-big-title">Для нас «продвижение по карьерной лестнице» — не просто ещё один красивый пункт в вакансии</span>
		 <span class="hr-title hr-blue pt-3">Вот лишь несколько наших историй успеха:</span>
	</div>
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 pt-xl-0 pt-lg-0 text-left">
<div class="row g-0 position-relative h-100">
<?php 
$arr_list_user = [
    ["name"=>"Игорь Мерко","photo"=>"igor1.jpg","text"=>"Пришёл в «Трайв» в 2015 году на позицию помощника менеджера.
Сейчас работает директором по продажам.
<div class='card-body p-0 '><i class='fa fa-quote-left fa-2x mt-4'></i><p class='lead hr_service_quote'>У нас по-хорошему «домашняя» компания, где нет лишней бюрократии, все общаются на одном уровне и нет строгого разделения по грейдам. Любой сотрудник может прийти с вопросами к генеральному директору и наоборот</p></div>

"],
    ["name"=>"Константин Синюков","photo"=>"coco-cotiay2.jpg","text"=>"
Пришёл в “Трайв” после университета на стажировку.
Сейчас работает ассистентом отдела и готовится занять позицию Project Manager.
<div class='card-body p-0 '><i class='fa fa-quote-left fa-2x mt-4'></i><p class='lead hr_service_quote'>Больше всего в «Трайве» мне нравится, что тебе помогают раскрыть потенциал. Компания развивает сотрудников и развивается сама</p></div>

"],
    ["name"=>"Татьяна Фрундина","photo"=>"tfrundina13.jpg","text"=>"
Пришла в «Трайв» в 2020 году на позицию менеджера по управлению цепочками поставок.
Сейчас работает директором Supply Chain.
<div class='card-body p-0 '><i class='fa fa-quote-left fa-2x mt-4'></i><p class='lead hr_service_quote'>Мне нравится, что в «Трайве» не боятся амбициозных задач, готовы к изменениям и новым идеям. Нет ощущения рутины. Несмотря на возраст (16 лет) компания остаётся молодой, полной сил и задора</p></div>
"]
    
];
$i = 170;
foreach($arr_list_user as $key=>$val){

     ?>
     <div class="col-12 col-xl-4 col-lg-4 col-md-4 pl-xl-5 pl-lg-5 pl-md-5 pr-xl-5 pr-lg-5 pr-md-5 text-left h-lg-100">
     <div class="card h-100">
  <!-- <img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/<?= $i; ?>.webp" class="card-img-top" alt="Sunset Over the Sea"/>-->
  <img src="<?=SITE_TEMPLATE_PATH?>/hr/<?php echo $val['photo']?>" class="hr-image"/>
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

<div class="row g-0 position-relative">
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 pt-sm-3 p-xl-5 p-lg-5 p-md-5 text-left">
	
<span class="dpl-newmdb-docs-alert">
        
      <div class="alert alert-warning d-xl-flex d-lg-flex d-md-flex justify-content-between" role="alert" data-mdb-color="danger">
          <a href="#how"  class="mb-0 anchor_name">
          <i class="fa fa-diamond pr-3">
            </i>Как все устроено
          </a>
          <strong>
            <a href="#how" class="text-reset text-center d-block pt-2 pt-xl-0 pt-lg-0 pt-md-0">Живем, работаем, дружим - вам понравится <i class="fa fa-level-down pl-1">
            </i></a>
          </strong>
        </div>
</span>

<span class="dpl-newmdb-docs-alert">
        
      <div class="alert alert-success d-xl-flex d-lg-flex d-md-flex justify-content-between" role="alert" data-mdb-color="danger">
          <a href="#vac" class="mb-0 anchor_name"><i class="fa fa-user-plus pr-3">
            </i>Как попасть в “Трайв”
          </a>
          <strong>
            <a href="#vac" class="text-reset text-center d-block pt-2 pt-xl-0 pt-lg-0 pt-md-0">Не так сложно, как вы могли предположить<i class="fa fa-level-down pl-1"></i></a>
          </strong>
        </div>
</span>

<span class="dpl-newmdb-docs-alert">
        
      <div class="alert alert-info d-xl-flex d-lg-flex d-md-flex justify-content-between" role="alert" data-mdb-color="danger">
          <a href="#vac" class="mb-0 anchor_name"><i class="fa fa-briefcase pr-3">
            </i>Актуальные вакансии
          </a>
          <strong>
            <a href="#vac" class="text-reset text-center d-block pt-2 pt-xl-0 pt-lg-0 pt-md-0">От IT до работы на производстве<i class="fa fa-level-down pl-1"></i></a>
          </strong>
        </div>
</span>
        
        </div>
        </div>

<!-- ///////// -->

<div class="row g-0 position-relative">
<a name="how"></a>
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-5 p-xl-5 p-lg-5 p-md-5 text-left">
		 <span class="hr-big-title">Как все устроено!</span>
	</div>
	
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 pt-3 p-xl-5 p-lg-5 p-md-5 text-left">
	
	<!-- ***** -->
	<div class="row align-items-center text-lg-left text-center mb-5">
				<div class="col-12 col-lg-6 order-lg-2 mb-lg-0 mb-4">
					<div class="content">
						<div class="img-c">
							<img src="<?=SITE_TEMPLATE_PATH?>/hr/ludi2.jpg" class="img-fluid rounded"/>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-6 order-lg-1">
					<div class="t-c">
						<h2 class="mb-3">Люди и атмосфера</h2>
						<p class="mb-3 hr-p">В «Трайве» работают разные, но одинаково неравнодушные и увлечённые общим делом люди. Мы открыто обсуждаем идеи и планы, помогаем друг другу и постоянно учимся </p>
					</div>
				</div>
			</div>
			
			
			<div class="row align-items-center text-lg-left text-center mb-5">
				
				<div class="col-lg-6 order-2 order-lg-2">
					<div class="t-c">
						<h2 class="mb-3">Забота и комфорт</h2>
						<p class="mb-3 hr-p">У нас официальное трудоустройство, белая зарплата и бонусы. А ещё мы знаем, как важно переключать внимание и отдыхать, поэтому отпуск всегда по расписанию </p>
					</div>
				</div>
				
				<div class="col-lg-6 order-1 order-lg-1 mb-lg-0 mb-4">
					<!-- <div class="content">
						<div class="img-c">
							<img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/176.webp" class="img-fluid rounded" alt="img">
						</div>
					</div>-->
					
					<div class="t-c">
						<h2 class="mb-3">Технологии в помощь</h2>
						<p class="mb-3 hr-p">Чтобы избавить вас от рутины и освободить время для действительно интересных и творческих задач, мы активно внедряем современные технологии. Например, недавно у нас появилась система, которая самостоятельно расшифровывает запросы клиентов </p>
					</div>
					
				</div>
				
			</div>
			
			<!-- /***** -->
			
			
				<!-- ***** -->
	<div class="row align-items-center text-lg-left text-center mb-5">
				<div class="col-lg-6 order-lg-2 mb-lg-0 mb-4">
				<div class="t-c">
						<h2 class="mb-3">Привычка все делать хорошо</h2>
						<p class="mb-3 hr-p">В «Трайве» принято говорить «мы», когда речь идет об успехах, и говорить «я», когда речь идет об ошибках и неудачах. Мы не ругаем за ошибки. Мы просто их не повторяем.
 </p>
					</div>
					<!-- <div class="content">
						<div class="img-c">
							<img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/177.webp" class="img-fluid rounded" alt="img">
						</div>
					</div>-->
				</div>
				<div class="col-lg-6 order-lg-1">
				
				<div class="t-c">
						<h2 class="mb-3">Разнообразие мнений</h2>
						<p class="mb-3 hr-p">Мы принимаем решения на основе фактов и объективных аргументов, а не авторитетности сотрудников. Каждый может открыто оспаривать то или иное решение, приводя логичные доводы </p>
					</div>
				
				</div>
			</div>
			
			
			<div class="row align-items-center text-lg-left text-center mb-5 d-none">
				
				<div class="col-lg-6 order-2 order-lg-2">
					<div class="t-c">
						<h2 class="mb-3">Привычка все делать хорошо</h2>
						<p class="mb-3 hr-p">В «Трайве» принято говорить «мы», когда речь идет об успехах, и говорить «я», когда речь идет об ошибках и неудачах. Мы не ругаем за ошибки. Мы просто их не повторяем.
 </p>
					</div>
				</div>
				
				<div class="col-lg-6 order-1 order-lg-1 mb-lg-0 mb-4">
					<div class="content">
						<div class="img-c">
							<img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/178.webp" class="img-fluid rounded" alt="img">
						</div>
					</div>
				</div>
				
			</div>
			
			<!-- /***** -->
			
							<!-- ***** -->
	<div class="row align-items-center text-lg-left text-center mb-5 d-none">
				<div class="col-lg-6 order-lg-2 mb-lg-0 mb-4">
					<div class="content">
						<div class="img-c">
							<img src="https://mdbcdn.b-cdn.net/img/new/standard/nature/179.webp" class="img-fluid rounded" alt="img">
						</div>
					</div>
				</div>
				<div class="col-lg-6 order-lg-1">
					<div class="t-c">
						<h2 class="mb-3">Разнообразие мнений</h2>
						<p class="mb-3 hr-p">Мы принимаем решения на основе фактов и объективных аргументов, а не авторитетности сотрудников. Каждый может открыто оспаривать то или иное решение, приводя логичные доводы </p>
					</div>
				</div>
			</div>
			
			
			<div class="row align-items-center text-lg-left text-center mb-5">
				
				<div class="col-lg-6 order-2 order-lg-2">
					<div class="t-c">
						<h2 class="mb-3">Непрерывное обучения</h2>
						<p class="mb-3 hr-p">Не забываем пополнять библиотеку — пользуйтесь ею в любое время. А дополнительно можете посещать профильные конференции, проходить тренинги и семинары
 </p>
					</div>
				</div>
				
				<div class="col-lg-6 order-1 order-lg-1 mb-lg-0 mb-4">
					<div class="content">
						<div class="img-c">
							<img src="<?=SITE_TEMPLATE_PATH?>/hr/edu1.jpg" class="img-fluid rounded"/>
						</div>
					</div>
				</div>
				
			</div>
			
			<!-- /***** -->
			
			
			</div>
	
</div>


<div class="row g-0 position-relative" id="hr-row-image" style="height:220px;">
<a name="vac"></a>
	<div class="col-12 col-xl-12 col-lg-12 col-md-12 p-5 text-center">
		 <span class="hr-big-title" style="position:relative;">Как попасть в «Трайв»</span>
	</div>
</div>

<div class="row d-flex justify-content-center align-items-center h-100 mt-5 mt-xl-0 mt-lg-0 mt-md-0"><div class="col-md-12 col-xl-12"><div class="text-black" style="border-radius: 15px;border:0px green solid;"><div class="card-body p-0 p-md-5 p-lg-5 p-xl-5"><i class="fa fa-quote-left fa-2x mb-4"></i><p class="lead service_quote">Интересных задач у нас обычно больше, чем свободных рук. Поэтому мы всегда рады талантливым и увлеченным специалистам. Попасть к нам можно разными путями — выбирайте, какой вам ближе </p></div></div></div></div>


<div class="row g-0 position-relative">
	
	<div class="col-12 col-xl-8 col-lg-8 col-md-8 pt-3 p-xl-5 p-lg-5 p-md-5 text-left">
	
	<!-- ***** -->
	<div class="row align-items-center text-lg-left text-center mb-5 pt-3">
				<div class="col-lg-6 order-lg-1 mb-lg-0 mb-4">
					<div class="content">
						<div class="img-c">
							<span class="hr-big-title text-center">1</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6 order-lg-2">
					<div class="t-c">
						<h2 class="mb-3">Отправьте отклик на вакансию</h2>
						<p class="mb-3 hr-p">
Выбирайте вакансию из списка и отправляйте отклик. Мы внимательно ознакомимся и дадим ответ в течение пары дней </p>
					</div>
				</div>
			</div>
			
			
			<div class="row align-items-center text-lg-left text-center mb-5">
				
				<div class="col-lg-6 order-2 order-lg-1">
					<div class="t-c">
						<h2 class="mb-3">Поделитесь резюме</h2>
						<p class="mb-3 hr-p">Если не нашли подходящую вакансию среди опубликованных, это не поводу опускать руки. Отправьте нам резюме и короткое сопроводительное письмо, на какую должность претендуете
Мы активно растём и расширяем свой штат. Возможно, интересная вам позиция откроется совсем скоро </p>
					</div>
				</div>
				
				<div class="col-lg-6 order-1 order-lg-2 mb-lg-0 mb-4">
					<div class="content">
						<div class="img-c">
							<span class="hr-big-title text-center">2</span>
						</div>
					</div>
				</div>
				
			</div>
			
			<!-- /***** -->
			
			
			</div>
			
			<div class="col-12 col-xl-4 col-lg-4 col-md-4 pt-3 p-xl-5 p-lg-5 p-md-5 text-left">    			
    			<div class="hh-script">
            	</div>
            	<script class="hh-script" src="https://api.hh.ru/widgets/vacancies/employer?employer_id=973412&locale=RU&links_color=1560b2&border_color=ffffff&title="></script>
			</div>
	
</div>

<!-- /////////////// -->

<div class="row g-0 position-relative">
	<div class="col-12 col-xl-6 col-lg-6 col-md-6 pt-3 p-xl-5 p-lg-5 p-md-5 text-left">
		 <span class="hr-big-title">О «Трайве»</span>
		 <span class="hr-title hr-blue pt-3 pb-3 pb-xl-0 pb-lg-0 pb-md-0">«Трайв» — ключевой производитель и поставщик метизных решений промышленным предприятиям в России и странах ЕАЭС</span>
	</div>
	
<div class="row">
    
        <div class="col-lg-12 col-md-12 text-md-left text-center">
    		<div class="row">
    		
    			<div class="col-lg-4 col-md-12 mt-5 mt-xl-0 mt-lg-0 mt-md-0 text-md-left text-center">
    			<div class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<i class="fa fa-list-ol"></i>
    					<div class="quicklinks-item-title">Официальное трудоустройство</div>
    					<p>Все по закону.</p>
    				</div>
    			</div>
    			</div>
    			
    			<div class="col-lg-3 col-md-12 mt-5 mt-xl-0 mt-lg-0 mt-md-0 text-md-left text-center">
    			<div class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<i class="fa fa-graduation-cap"></i>
    					<div class="quicklinks-item-title">16 лет на рынке</div>
    					<p>Мы очень опытные.</p>
    				</div>
    			</div>
    			</div>
    			
    			<div class="col-lg-5 col-md-12 mt-5 mt-xl-0 mt-lg-0 mt-md-0 text-md-left text-center">
    			<div class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<i class="fa fa-calendar"></i>
    					<div class="quicklinks-item-title">Белая зарплата</div>
    					<p>Выплаты без задержек и проволочек.</p>
    				</div>
    			</div>
    			</div>
    			
    			
    			    			<div class="col-lg-5 col-md-12 mt-5 text-md-left text-center">
    			<div class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<i class="fa fa-apple"></i>
    					<div class="quicklinks-item-title">Любая техника для работы</div>
    				</div>
    			</div>
    			</div>
    			
    			<div class="col-lg-3 col-md-12 mt-5 text-md-left text-center">
    			<div class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<i class="fa fa-grav"></i>
    					<div class="quicklinks-item-title">Развитие для каждого</div>
    				</div>
    			</div>
    			</div>
    			
    			<div class="col-lg-4 col-md-12 mt-5 text-md-left text-center">
    			<div class='quicklinks-item bordered'>
    				<div class='quicklinks-item-content'>
    					<i class="fa fa-rocket"></i>
    					<div class="quicklinks-item-title">Крутые корпоративы</div>
    					
    				<div>
    					<div class="btn-group-blue"><a href="#" onclick="$('a.fancy-img').eq(0).trigger('click'); return false;" class="btn-blue"><span>Смотреть фотографии</span></a></div>
    				</div>
    				
    				<div style="opacity:0;width:0px;height:0px;">
				<div class="row">
					<div class="col-12 col-lg-6 col-md-6 col-sm-6 mt-3 text-center">
 <a data-fancybox="gallery" class="fancy-img" href="<?=SITE_TEMPLATE_PATH?>/hr/gallery_hr11.jpg"><img src="<?=SITE_TEMPLATE_PATH?>/hr/gallery_hr11.jpg"></a>
					</div>
					<div class="col-12 col-lg-6 col-md-6 col-sm-6 mt-3 text-center">
 <a data-fancybox="gallery" class="fancy-img" href="<?=SITE_TEMPLATE_PATH?>/hr/gallery_hr2.jpg"><img src="<?=SITE_TEMPLATE_PATH?>/hr/gallery_hr2.jpg"></a>
					</div>
					<div class="col-12 col-lg-6 col-md-6 col-sm-6 mt-3 text-center">
 <a data-fancybox="gallery" class="fancy-img" href="<?=SITE_TEMPLATE_PATH?>/hr/gallery_hr3.jpg"><img src="<?=SITE_TEMPLATE_PATH?>/hr/gallery_hr3.jpg"></a>
					</div>
				</div>
			</div>
    				
    					
    				</div>
    				
    				
    				
    			</div>
    			</div>
    			
    		</div>    		
        </div>
    
    </div>
	
</div>	

<!-- ///////// -->

</section>
<?
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/hr.css");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>