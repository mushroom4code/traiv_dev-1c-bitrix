function getGridSize_pop () {
	return (window.innerWidth < 480) ? 1 :
		   (window.innerWidth < 650) ? 2 :
		   (window.innerWidth < 992) ? 3 :
		   (window.innerWidth < 1200) ? 3 : 4;
}

function getGridSize_brands () {
	return (window.innerWidth < 400) ? 1 :
		(window.innerWidth < 550) ? 2 :
		(window.innerWidth < 650) ? 3 :
		(window.innerWidth < 992) ? 4 :
		(window.innerWidth < 1200) ? 5 : 6;
}

$(document).ready(function(){
	
	if ($.cookie('fav_list')) {
        var fav_list = $.parseJSON($.cookie("fav_list"));
    } else {
        var fav_list = [];
    }
	
	if($('#kviz-area').length > 0) {
		
		var ans = [
				        {
				            name: "Шуточный квиз",
				            description: "<p>Иногда вы можете смотреть на мир несколько пессимистично. Не будьте слишком  пассивны, чтобы не «заржаветь» в своих эмоциях, ведь часто неприятные события заставляют вас переживать, мешая радоваться жизни. Однако вы можете показывать пример другим своей бесконечной добротой, мягкостью и честностью, быть незаменимым как стальные винты, которые буквально скрепляют собой мир.</p>",
				            imgsrc: "/local/templates/traiv-main/img/kviz/kvizimg.jpg",
				            res:[
				                 {
				                	 name:'yellow',
				                	 title:'Вы - латунная гайка!',
				                	 note:'<p>Вы очень жизнерадостны и оптимистичны, как цвет латуни. Любите находиться в движении и не можете усидеть на месте, поэтому ваш внутренний мир сияет всеми цветами радуги. Ваша активность проявляется во всех сферах жизни - от общения до профессиональной деятельности также, как латунь - проводит электричество.  Однако латунь - относительно мягкий материал, вы можете переоценить свои свои возможности и проявлять непостоянство в действиях и поступках.</p>',
				                		 img:'/local/templates/traiv-main/img/kviz/yellow.jpeg'
				                 },{
				                	 name:'blue',
				                	 title:'Вы - полиамидная шайба!',
				                	 note:'<p>Вы очень спокойны и уравновешены, как полиамид, который устойчив к кислотам и не пропускает электричество. Ваш внутренний мир напоминает тихую гавань, где вас никто не потревожит. Вы не проявляете сильных эмоций, но тем не менее  вы - эмпатичный человек, готовый всегда прийти на помощь в сложной ситуации.</p>',
				                	 img:'/local/templates/traiv-main/img/kviz/blue.jpg'
				                 }
				                 ,{
				                	 name:'gray',
				                	 title:'Вы - стальной винт!',
				                	 note:'<p> Иногда вы можете смотреть на мир несколько пессимистично. Не будьте слишком  пассивны, чтобы не «заржаветь» в своих эмоциях, ведь часто неприятные события заставляют вас переживать, мешая радоваться жизни. Однако вы можете показывать пример другим своей бесконечной добротой, мягкостью и честностью, быть незаменимым как стальные винты, которые буквально скрепляют собой мир.</p>',
				                	 img:'/local/templates/traiv-main/img/kviz/gray.jpg'
				                 },{
				                	 name:'black',
				                	 title:'Вы - высокопрочный болт!',
				                	 note:'<p>Вы тверды в своих намерениях и трезво смотрите на окружающую жизнь. Ваша нервная система - как железобетонная конструкция с болтами - вас сложно вывести из равновесия. Вы можете казаться холодным замкнутым человеком. Но на самом деле, вы можете быть самым верным другом, на которого можно положиться, как на высокопрочный крепеж.</p>',
				                	 img:'/local/templates/traiv-main/img/kviz/black.jpg'
				                 }
				                 ],
				            q: [
				                {
				                    name: "Вы предпочли бы быть...?",
				                    ans: [
					                          {
						                        	note: "Энергичным, но вспыльчивым",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Строгим, но справедливым",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Спокойным, но замкнутым",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Добрым, но грустным",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },/*q*/
				                {
				                    name: "Если бы вы были невидимым, куда бы пошли?",
				                    ans: [
					                          {
						                        	note: "На вечеринку, всех разыграть",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "В логово злодея, чтобы сорвать его планы",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Домой к тому, кто мне интересен",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Я и так почти невидимый, меня никто не замечает",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg3.jpg"
				                },
				                {
				                    name: "Что для вас значат мечты?",
				                    ans: [
					                          {
						                        	note: "Яркие фантазии",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Руководство к действию",
						                        	res: "black"
						                      },
					                          {
						                        	note: "То, к чему стараемся идти",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Место, чтобы укрыться от злого мира",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Что бы вы сделали во время отпуска?",
				                    ans: [
					                          {
						                        	note: "Вдоволь пообщаюсь с друзьями",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Занялся экстремальным спортом",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Займусь делами, на которые не хватало времени",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Посижу дома, отдохну от всех",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Что вы думаете о дружбе?",
				                    ans: [
					                          {
						                        	note: "Дружба - это когда вместе интересно и весело",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Настоящие друзья должны быть всегда на вашей стороне",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Дружба - это нечто согревающее и доброе, но не очень понятное",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Это полная поддержка и понимание",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Вы чувствуете себя неуверенно, если...",
				                    ans: [
					                          {
						                        	note: "Нужно заниматься монотонной работой",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Мне нужно с кем-то поговорить по душам",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Нужно принять важное решение",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Нужно выступать на публике",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Лучший подарок от Деда Мороза - это...",
				                    ans: [
					                          {
						                        	note: "Ежедневник, чтобы записывать дела и встречи",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Успокоительное. У меня много стресса",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Хорошую книгу, чтобы читать по вечерам",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Немного уверенности в себе",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Как часто вы используете жесты при общении?",
				                    ans: [
					                          {
						                        	note: "Очень часто, я экспрессивный",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Не очень часто",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Умеренно, по ситуации",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Почти не использую",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Если вам нужно остаться на день в одиночестве в своей квартире, что вы почувствуете?",
				                    ans: [
					                          {
						                        	note: "Грусть",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Отчаяние",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Ничего",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Радость",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                },

				                {
				                    name: "Вы с трудом выносите людей, которые...",
				                    ans: [
					                          {
						                        	note: "Вечно сидят на одном месте",
						                        	res: "yellow"
					                          },
					                          {
						                        	note: "Я со всеми не очень-то лажу",
						                        	res: "black"
						                      },
					                          {
						                        	note: "Не уделяют мне должного внимания",
						                        	res: "blue"
						                      },
					                          {
						                        	note: "Активны и болтливы",
						                        	res: "gray"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kvizimg2.jpg"
				                }
				            ]
				            		}
				    ];
		
		$('body').kviz({'dataJson':ans,'typeKviz':'funny'});
	}
	
	if($('#kviz-area2').length > 0) {
		
		var ans2 = [
				        {
				            name: "Серьезный квиз",
				            description: "<p>Проверьте свои знания по теме Крепежа.</p>",
				            imgsrc: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg",
				            res:[
				                 {
				                	 name:'8',
				                	 title:'Вы - профессионал!',
				                	 note:'<p>Вы - профессионал!</p>',
				                		 img:'/local/templates/traiv-main/img/kviz/yellow.jpeg'
				                 },{
				                	 name:'6',
				                	 title:'Вы - специалист!',
				                	 note:'<p>Вы - специалист!.</p>',
				                	 img:'/local/templates/traiv-main/img/kviz/blue.jpg'
				                 }
				                 ,{
				                	 name:'4',
				                	 title:'Вы - молодец!',
				                	 note:'<p>Вы - молодец.</p>',
				                	 img:'/local/templates/traiv-main/img/kviz/gray.jpg'
				                 },{
				                	 name:'2',
				                	 title:'Вы - ничего не знаете!',
				                	 note:'<p>Вы - ничего не знаете.</p>',
				                	 img:'/local/templates/traiv-main/img/kviz/black.jpg'
				                 }
				                 ],
				            q: [
				                {
				                    name: "Какой отечественной марке стали соответствует марка стали А4?",
				                    ans: [
					                          {
						                        	note: "10Х17Н13М2",
						                        	res: "correct"
					                          },
					                          {
						                        	note: "08Х18Н10",
						                        	res: "none"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }, {
				                    name: "Укажите верную маркировку материала для изготовления полиамидного крепежа?",
				                    ans: [
					                          {
						                        	note: "ПА 10-СН-22",
						                        	res: "none"
					                          },
					                          {
						                        	note: "ПА 6-СВ-30",
						                        	res: "correct"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                , {
				                    name: "Какое количество заклепок используют при строительстве самолета Airbus A320?",
				                    ans: [
					                          {
						                        	note: "7000 - 9000 шт",
						                        	res: "none"
					                          },
					                          {
						                        	note: "18000 - 20000 шт",
						                        	res: "correct"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                , {
				                    name: "Какой болт тяжелее: стальной, серебряный, медный?",
				                    ans: [
					                          {
						                        	note: "Стальной",
						                        	res: "correct"
					                          },
					                          {
						                        	note: "Серебрянный",
						                        	res: "none"
						                      },
					                          {
						                        	note: "Медный",
						                        	res: "none"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                , {
				                    name: "Из какого материала используют крепеж при строительстве космических кораблей?",
				                    ans: [
					                          {
						                        	note: "Платина",
						                        	res: "none"
					                          },
					                          {
						                        	note: "Титан",
						                        	res: "correct"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }, {
				                    name: "Укажите, для какой цели применяется метчик:",
				                    ans: [
					                          {
						                        	note: "Нарезания наружных и внутренних резьб",
						                        	res: "none"
					                          },
					                          {
						                        	note: "Нарезания наружных резьб",
						                        	res: "none"
						                      },
					                          {
						                        	note: "Нарезания наружных резьб",
						                        	res: "correct"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }, {
				                    name: "Профиль резьбы бывает:",
				                    ans: [
					                          {
						                        	note: "Плоский",
						                        	res: "none"
					                          },
					                          {
						                        	note: "Треугольный",
						                        	res: "none"
						                      },
					                          {
						                        	note: "Линейный",
						                        	res: "correct"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                
				                , {
				                    name: "Найдите правильное обозначение резьбы метрической с наружным диаметром 30 мм, с мелким шагом, левой",
				                    ans: [
					                          {
						                        	note: "М30",
						                        	res: "none"
					                          },
					                          {
						                        	note: "М30х1,5LH",
						                        	res: "none"
						                      },
					                          {
						                        	note: "М30-LH",
						                        	res: "correct"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                , {
				                    name: "К разъемным соединениям относится:",
				                    ans: [
					                          {
						                        	note: "Штифтовое",
						                        	res: "none",
						                        	imgans:"/local/templates/traiv-main/img/kviz/a1.jpg"
					                          },
					                          {
						                        	note: "Сварное",
						                        	res: "none",
						                        	imgans:"/local/templates/traiv-main/img/kviz/a2.jpg"
						                      },
					                          {
						                        	note: "Заклепочное",
						                        	res: "correct",
						                        	imgans:"/local/templates/traiv-main/img/kviz/a3.jpg"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                , {
				                    name: "К неразъемным соединениям относится:",
				                    ans: [
					                          {
						                        	note: "Шпоночное",
						                        	res: "none",
						                        	imgans:"/local/templates/traiv-main/img/kviz/a4.jpg"
					                          },
					                          {
						                        	note: "Болтовое",
						                        	res: "none",
						                        	imgans:"/local/templates/traiv-main/img/kviz/a5.jpg"
						                      },
					                          {
						                        	note: "Заклепочное",
						                        	res: "correct",
						                        	imgans:"/local/templates/traiv-main/img/kviz/a3.jpg"
						                      }
				                          ],
				                    img: "/local/templates/traiv-main/img/kviz/kviz-correct.jpg"
				                }
				                
				            ]
				            		}
				    ];
		
		$('body').kviz({'dataJson':ans2,'typeKviz':'correct'});
	}
	
	if($('.category-item').length > 0){
		var name_descr = $('.category-item').first().find('.v-aligner').text();
		if (name_descr) {
			$("#search-text-custom").attr("placeholder", "Фильтр по разделам, например: " + $.trim(name_descr));
		}
	}
	
	$("#search-text-custom").on('keyup input',function() {
		 var stc = $("#search-text-custom").val().toLowerCase();
		 
		 $(".check-data-search").each( function(){
		       var $this = $(this);
		       var value = $this.attr( "data-find" ).toLowerCase(); //convert attribute value to lowercase
		       if (value.length > 3)
		    	   {
		       
		       if (value.includes( stc ))
		    	   {
		    	   	$this.css('display','inline-block');
		    	   
		    	   }
		       else
		    	   {
		    	   	$this.css('display','none');
		    	   }
		    	   }
		       //$this.toggleClass( "hidden-data-search-custom", !value.includes( stc ) );
		    })
		 
	});
	
	  /* --------------------------------------------
    PLATFORM DETECT
  --------------------------------------------- */

	function checkMobile () {
  var mobileDetect = false;
    
    if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)) {
      mobileDetect = true;
      
    } else {
    	$('.prod-qnt-area').remove();
    };
}
	
	checkMobile();
	
	$(window).resize(function() {
    	checkMobile();
      }); 
    
	/*favorites*/
	$('.prod-favorites').on('click',function(e){
	e.preventDefault();
	
	 var element_id = parseInt($(this).attr('data-fid'));
	 var index = getArrayIndexForKey(fav_list, "element_id", element_id);

	 
	 if (element_id > 0 && index == -1)
     {
		 fav_list.push({'element_id': element_id});
		 $(this).addClass('prod-favorites-active');
		 $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
		 $('#prod-favorites-top-count').text(fav_list.length);
     }
	 else if (element_id > 0 && index >= 0) {
		 fav_list = $.grep(fav_list, function (e) {
	     	return e.element_id != element_id;
	     });
		 $(this).removeClass('prod-favorites-active');
	     $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
	     $('#prod-favorites-top-count').text(fav_list.length);
	 }

	});
	
	
	$('.prod-favorites-remove').on('click',function(e){
	e.preventDefault();
	
	 var element_id = parseInt($(this).attr('data-fid-remove'));
	 var index = getArrayIndexForKey(fav_list, "element_id", element_id);
	 
	 fav_list = $.grep(fav_list, function (e) {
	     	return e.element_id != element_id;
	     });
	     $.cookie("fav_list", JSON.stringify(fav_list), {expires: 31, path: '/'});
	     $('#prod-favorites-top-count').text(fav_list.length);
	     location.reload();
	});
	
	
	
   function getArrayIndexForKey(arr, key, val) {
        for (var i = 0; i < arr.length; i++) {
            if (arr[i][key] == val)
                return i;
        }
        return -1;
    }
	
	/*end favorites*/
	
	/*items cart function*/
	
	$('.prod-minus,.prod-minus-new').on('click',function(e){
		e.preventDefault();
		let qnt = parseInt($('.prod-qnt-input').val());
		let qnt_step = parseInt($('.prod-qnt-input').attr('step'));
		
		if (qnt != qnt_step) {
			qnt-=qnt_step;
			$('.prod-qnt-input').val(qnt);
			set_price_summ_item(qnt);
		}
	});
	
	$('.prod-plus,.prod-plus-new').on('click',function(e){
		e.preventDefault();
		let qnt = parseInt($('.prod-qnt-input').val());
		let qnt_step = parseInt($('.prod-qnt-input').attr('step'));
		
			qnt+=qnt_step;
			$('.prod-qnt-input').val(qnt);
			set_price_summ_item(qnt);
			
			
	});
	
	$('.prod-qnt-input').on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
         if ((event.which < 48 || event.which > 57)) {
             event.preventDefault();
         }
     });
	
	$('.prod-qnt-input').on('input',function(e){

		e.preventDefault();
		let qnt = parseInt($('.prod-qnt-input').val());
		let qnt_step = parseInt($('.prod-qnt-input').attr('step'));
		
		$('.prod-qnt-input').val(qnt);
		set_price_summ_item(qnt);
		
    });
	
	
	/*items cart function*/
	
	/*cross item*/
	if ($('.cross_item_tr').length > 0) {
		let cil = parseInt($('.cross_item_area').find('.cross_item_tr').length);
		let cih = parseInt($('.cross_item_area').find('.cross_item_tr').height());
		let ch = cil * cih + 30;
		
		setTimeout(function(){
			$('.cross_item_area').animate({'opacity':1,'height':ch + 'px'},300);
		}, 700);
	}
	/*end cross item*/
	
	/*scroll to fixed*/
	
	//setTimeout(function(){
	//}, 5000);
	if ($('.timeline').length > 0) {
		$('.timeline').timeline({
			  verticalStartPosition: 'right',
			  verticalTrigger: '150px'
			});
	}
	
	if ($('.cntl').length > 0) {
		$('.cntl').cntl({
			revealbefore: 200,
			anim_class: 'cntl-animate',
			onreveal: function(e){
				console.log(e);
			}
		});
	}
	
	/*if ($('.facts-i-percent').length > 0) {
		var waypoints = $('.facts-i-percent').eq(1).waypoint({
			handler: function(direction) {
				$('.facts-i-percent').each(function () {

					var bar = new ProgressBar.Circle('#' + $(this).attr('id'), {
						strokeWidth: 4,
						trailWidth: 1,
						easing: 'easeInOut',
						duration: 1400,
						text: {
							autoStyleContainer: false
						},
						from: { color: '#dddddd', width: 1 },
						to: { color: '#3a89cf', width: 4 },
						step: function(state, circle) {
							circle.path.setAttribute('stroke', state.color);
							circle.path.setAttribute('stroke-width', state.width);

							var value = Math.round(circle.value() * 100);
							if (value === 0) {
								circle.setText('');
							} else {
								circle.setText(value + '<span>%</span>');
							}

						}
					});

					bar.animate($(this).data('num'));  // Number from 0.0 to 1.0

				});

				this.disable();
			},
			offset: 'bottom-in-view'
		});
	}*/
	
	if($('.stf_filter').length > 0 && $('#kombox-filter').length > 0) {
		
		/*console.log($('.stf_filter'));
	console.log($('#kombox-filter').length);*/
		$('.stf_filter').scrollToFixed( { marginTop: $('.bottom-bar').outerHeight() + 10, zIndex:998,
			preFixed: function() { $(this).css('opacity', '1').css('position', 'absolute'); },
			postFixed: function() { $(this).css('opacity', '0');
			$('#kombox-filter').css('top', '0px').css('position','relative');
			$('.layout-overlay').css('display','none');

			}} );
		
		$('.stf_filter').on('click',function(){

				$('.layout-overlay').css('display','block');
				let top_stf_filter = $(this).offset().top - $(document).scrollTop();
				let width_stf_filter = $('.subsection').width() - 20;
				$('#kombox-filter').css('top', (top_stf_filter - 14) + 'px').css('position','fixed').css('z-index','100').css('width',width_stf_filter + 'px');

				$('.layout-overlay').on('click',function(){
					$('.layout-overlay').css('display','none');
					$('#kombox-filter').css('top', '0px').css('position','relative').css('z-index','0');
				});

			
		});
	}
	
	$('#s_din_list_link').on('click',function(e){
		e.preventDefault();
		var res_list = '';
		console.log('s_din_list_link');
		$( "input[name='standart']:not(:disabled)").each(function(e){
			res_list += $(this).val() + ', ';
		});
		$('#s_din_list_res').text('');
		$('#s_din_list_res').append('<br>' + res_list);
	});
	
	/*end scroll to fixed*/
	
	/*goup*/
    $("#goup").on("click", function (e) {
        e.preventDefault();
        $('body,html').animate({scrollTop: 0}, 400);
    });

	/*end goup*/
	
	/*prod_slider*/
	
    // Product Images Slider
    if ($('.prod-slider-car').length > 0) {
        $('.prod-slider-car').each(function () {
            $(this).bxSlider({
                pagerCustom: $(this).parents('.prod-slider-wrap').find('.prod-thumbs-car'),
                adaptiveHeight: true,
                infiniteLoop: false,
            });
            $(this).parents('.prod-slider-wrap').find('.prod-thumbs-car').bxSlider({
                slideWidth: 5000,
                slideMargin: 8,
                moveSlides: 1,
                infiniteLoop: false,
                minSlides: 5,
                maxSlides: 5,
                pager: false
            });
        });         
    }
	
    /*if ($('.prod-slider-car').length > 0) {
       
    	var slider = $('.prod-slider-car').bxSlider({
    	  	  mode: 'horizontal',
    	  	    auto: true,
    	  	  autoStart: false,
    	  	  autoControls: true,
    	  	  autoControlsCombine: true,
    	  	  hideControlOnEnd: true,
    	  	  slideMargin: 40,
    	  	  pagerCustom: '.prod-thumbs-car'
    	  	});
    }*/
    
	
	/*end_prod_slider*/
    
    function GetURLParameter(sUrl,sParam)
    {
        var sPageURL = sUrl/*window.location.search.substring(1)*/;
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++) 
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam) 
            {
                return sParameterName[1];
            }
        }
    }
	
    function strpos (haystack, needle, offset) {
    	  var i = (haystack+'').indexOf(needle, (offset || 0));
    	  return i === -1 ? false : i;
    	}
    
	/*price_summ_item*/
	function set_price_summ_item(cnt) {
		let buyLink = $('#buy').attr('data-href');
		let qnt = GetURLParameter(buyLink,'QUANTITY');
		let qntpos = strpos(buyLink,'QUANTITY');
		let buyNewLink = buyLink.substring(0,qntpos) + 'QUANTITY=' + cnt;

		if (cnt && buyNewLink) {
		
			 $('#buy').attr({
                'data-href': buyNewLink
            });
			
		}
		
		if($('.price_summ_item').length > 0) {
			var price = parseFloat($('.price_summ_item').attr("data-summ-price").replace(/ /g,''));

			var pro_all_summ_val = (price * cnt).toFixed(2);
            if (pro_all_summ_val)
            	{
            		$('.price_summ_item').empty().html('Общая стоимость: <b>' + pro_all_summ_val + '</b> руб.');
            	}
		}
	}
	
	/*end price_summ_item*/
	
	//size table link
	$('#size_table_link').on('click', function(e){
		e.preventDefault();
		//console.log('size_table_link');
		$('.prod-tabs').find('li a').removeClass('active');
		// main
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tabs').find('li a').removeClass('active');
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');
        
        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto').hide().fadeIn();
	});
	
    // product tabs
    $('.prod-tabs li').on('click', 'a', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        $(this).parents('.prod-tabs').find('li a').removeClass('active');
        $(this).addClass('active');

        // mobile
        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
        $('.prod-tab-mob[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto');
        return false;
    });

    // prosuct (mobile)
    $('.prod-tab-cont').on('click', '.prod-tab-mob', function () {
        if ($(this).hasClass('active') || $(this).attr('data-prodtab') == '')
            return false;
        $(this).parents('.prod-tab-cont').find('.prod-tab-mob').removeClass('active');
        $(this).addClass('active');

        // main
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').parents('.prod-tabs').find('li a').removeClass('active');
        $('.prod-tabs li a[data-prodtab-num=' + $(this).data('prodtab-num') + ']').addClass('active');

        $($(this).attr('data-prodtab')).parents('.prod-tab-cont').find('.prod-tab').css('height', '0px');
        $($(this).attr('data-prodtab')).css('height', 'auto').hide().fadeIn();
        return false;
    });
	
    /*prod-note-more*/
    $('.prod-note-more').on('click',function(e){
    	e.preventDefault();
    	$(this).css('display','none');
    	$('.prod-note').find('p').css('display','inline-block');
    });
    
    /*check-prod-select*/
    
    if ($('.prod-character').length > 0) {
    	var check_prod_select = $('.prod-character').attr('rel');
    	if(check_prod_select) {
    		$('.prod-select').css('padding-top','0px');
    	}
    }
    /*end check-prod-select*/
    
    if ($('.prod-nal').length > 0) {
    	if ($('.prod-nal-list-item').length == 0) {
    		$('.prod-nal').css('display','none');
    	}
    }
    
    /*slider on main page*/
    
	// Product Related
	/*if ($('.prod-related-car').length > 0) {
	    $('.prod-related-car').flexslider({
	        animation: "slide",
	        controlNav: true,
	        slideshow: false,
	        minItems:6
	    });
    }*/
    
	if ($('.prod-related-car').length > 0) {
		$(".prod-related-car").each(function () {
		    var fr_pop_this = $(this);
			var flexslider_slider = { vars:{} };
			$(this).flexslider({
		        animation: "slide",
		        controlNav: true,
		        slideshow: false,
		        touch: true,
				itemWidth: 230,
				itemMargin: 0,
		        minItems: getGridSize_pop(),
		        maxItems: getGridSize_pop(),
			    start: function(slider){
			    	flexslider_slider = slider;
			        fr_pop_this.resize();
			    }
		    });
			$(window).resize(function() {
				var gridSize = getGridSize_pop();
		    	if (typeof flexslider_slider.vars !== "undefined") {
					flexslider_slider.vars.minItems = gridSize;
					flexslider_slider.vars.maxItems = gridSize;
				}
			});
		});
	}
    

    /*end slider on main page*/
	
	/*brands main page*/
	
	if ($('.brands-list').length > 0) {
		$('.brands-list').each(function () {
			var flexslider_brands;
			$(this).flexslider({
				animation: "slide",
				controlNav: false,
				slideshow: false,
				itemWidth: 150,
				itemMargin: 20,
				minItems: getGridSize_brands(),
				maxItems: getGridSize_brands()
			});
			$(window).resize(function () {
				var gridSize = getGridSize_brands();
			});
		});
	}
	
	/*end brands main page*/
	
	/*left catalog menu */
	
	if ($('.left_catalog_main_menu').length > 0) {
		//console.log(document.getElementById('left_catalog_menu_simplebar'));
		//new SimpleBar(document.getElementById('left_catalog_menu_simplebar'));
		
		
		/*let set_width = $('.content').children('.container').width();
		$('.sub-item').css('width',set_width - 210 + 'px');
		
		$('.sub-item').on('mouseenter',function(e){
			e.preventDefault();
			$(this).prev().removeClass('item').addClass('active');
			$(this).prev().children('.spriten').removeClass('spriten').addClass('active_icon');
		})
		
		$('.sub-item').on('mouseleave',function(e){
			e.preventDefault();
			$(this).prev().removeClass('active').addClass('item');
			$(this).prev().children('.active_icon').removeClass('active_icon').addClass('spriten');
		})*/
		
		$('.header_catalog_menu_link').on('click',function(e){
			e.preventDefault();
			
			
			if ($('.left_catalog_area').css('display') === 'block'){
				$('.left_catalog_area_overlay')/*.css('display','none')*/.fadeOut('fast');
				$('.bottom-bar__inner').css('z-index','100');
				//$('.middle-bar').css('background-color','none');
				//$('.middle-bar,.traiv-menu-top-bottom').css('position','relative').css('z-index','100');
				$('.left_catalog_area,.top_mm_items')/*.css('display','none')*/.fadeOut('fast');
				$(this).children('.icofont').removeClass('icofont-close').addClass('icofont-navigation-menu');
			}
			else
				{
				$('.left_catalog_area_overlay')/*.css('display','block')*/.fadeIn('fast');
				$('.bottom-bar__inner').css('z-index','1000');
				//$('.middle-bar').css('background-color','#eee');
				//$('.middle-bar,.traiv-menu-top-bottom').css('position','relative').css('z-index','999');
				$('.left_catalog_area,.top_mm_items')/*.css('display','block')*/.fadeIn('fast');
				$(this).children('.icofont').removeClass('icofont-navigation-menu').addClass('icofont-close');
				}
		});
		
		
		$('body').on('click', function(e){
			if (e.target.className !== 'howto_buy_btn' && e.target.className !== 'howto_deliver_btn'){
            if (!$(e.target).closest('.left_catalog_area,.header_catalog_menu_link').length) {
            	$('.left_catalog_area,.top_mm_items').css('display','none');
            	$('.left_catalog_area_overlay').css('display','none');
            	$('.header_catalog_menu_link').children('.icofont').removeClass('icofont-close').addClass('icofont-navigation-menu');
            }
			}
        });
		
		
		$('.item').on('mouseenter',function(e){
			$('.sub_item_content').css('display','none');
			$('.sub_item_content_help').css('display','none');
			
			$('.item').removeClass('active');
			$('.item').children('.active_icon').removeClass('active_icon').addClass('spriten');
			
			$(this).addClass('active');
			$(this).children('.spriten').removeClass('spriten').addClass('active_icon');
			e.preventDefault();
			let rel = $(this).attr('rel');
			if (rel) {
				$('#sic-' + rel).css('display','block');
				$('#sich-' + rel).css('display','block');
			}
		});
		
		
		$('.sub_item_content_help_link').on('click',function(e){
			e.preventDefault();
			let help_pid = $(this).parents( ".sub_item_content_help" ).attr('rel');
			let help_name = $(this).attr( "data-help-name" ).toLowerCase();
			$("#sich-" + help_pid).find('.sub_item_content_help_link').removeClass('active');
			$(this).addClass('active');
			
			$("#sich-" + help_pid).find(".icofont").removeClass('icofont-check-circled').addClass('icofont-spinner-alt-4');
			$(this).children('.icofont').removeClass('icofont-spinner-alt-4').addClass('icofont-check-circled');
			
			$("#sich-" + help_pid).children('.sub_item_content_help_link_second_note').css('display','block');
			
			if (help_name === 'din' || help_name === 'iso' || help_name === 'en' || help_name === 'гост'){
				$("#sich-" + help_pid).find('.sub_item_content_help_link_second').css('display','block');
				$("#sich-" + help_pid).find('.sub_item_content_help_link_second_note').css('display','block');
			} else {
				$("#sich-" + help_pid).find('.sub_item_content_help_link_second').css('display','none');
				$("#sich-" + help_pid).find('.sub_item_content_help_link_second_note').css('display','none');
			}
			
			 $("#sic-" + help_pid).children(".catalog_item_help").each( function(){
			       var $this = $(this);
			       var value = $this.attr( "data-helps-name" ).toLowerCase(); //convert attribute value to lowercase
			       
			       if (value.includes( help_name ))
			    	   {
			    	   	$this.css('display','block').addClass('catalog_item_help_change');
			    	   }
			       else
			    	   {
			    	   	$this.css('display','none').removeClass('catalog_item_help_change');
			    	   }
			    })
			
			    var check_column_help = $("#sic-" + help_pid).children(".catalog_item_help_change").length;
			 
			 /*if (check_column_help < 4) {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','unset')
			    	.css('-webkit-column-count','unset')
			    	.css('column-count','unset');
			    }
			    else {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','4')
			    	.css('-webkit-column-count','4')
			    	.css('column-count','4');
			    }*/
			 
		});
		
		
		$('.sub_item_content_help_link_second').on('click',function(e){
			e.preventDefault();
			let help_pid = $(this).parents( ".sub_item_content_help" ).attr('rel');
			let help_name = $(this).attr( "data-help-name" ).toLowerCase();
			let check_active = $(this).attr( "rel" );
			
			//console.log('check_active' + check_active);
			
			if (check_active !== '1') {
			
			$("#sich-" + help_pid).find(".sub_item_content_help_link_second").children(".icofont").removeClass('icofont-check-circled').addClass('icofont-spinner-alt-4');
			$("#sich-" + help_pid).find(".sub_item_content_help_link_second").attr('rel','0');
			$(this).children('.icofont').removeClass('icofont-spinner-alt-4').addClass('icofont-check-circled');
			$(this).attr('rel','1');
			
			
			//console.log('help_pid' + help_pid + 'help_name' + help_name);
			
			 $("#sic-" + help_pid).children(".catalog_item_help_change").each( function(){
			       var $this = $(this);
			       var value = $this.attr( "data-helps-name-second" ).toLowerCase(); //convert attribute value to lowercase
			       
			       if (value.includes( help_name ))
			    	   {
			    	   	$this.css('display','block');
			    	   }
			       else
			    	   {
			    	   	$this.css('display','none');
			    	   }
			    	   
			    })
			    var check_column_help_change = $("#sic-" + help_pid).children(".catalog_item_help_change:visible").length;
			 
			 
			 /*if (check_column_help_change < 4) {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','unset')
			    	.css('-webkit-column-count','unset')
			    	.css('column-count','unset');
			    }
			    else {
			    	$("#sic-" + help_pid)
			    	.css('-moz-column-count','4')
			    	.css('-webkit-column-count','4')
			    	.css('column-count','4');
			    }*/
			} else {
				
				$("#sich-" + help_pid).find(".sub_item_content_help_link_second").children(".icofont").removeClass('icofont-check-circled').addClass('icofont-spinner-alt-4');
				$(this).children('.icofont').removeClass('icofont-check-circled').addClass('icofont-spinner-alt-4');
				$(this).attr('rel','0');
				
				 $("#sic-" + help_pid).children(".catalog_item_help_change").css('display','block');
				
				 
				 var check_column_help_change = $("#sic-" + help_pid).children(".catalog_item_help_change:visible").length;
				 
				 
				 /*if (check_column_help_change < 4) {
				    	$("#sic-" + help_pid)
				    	.css('-moz-column-count','unset')
				    	.css('-webkit-column-count','unset')
				    	.css('column-count','unset');
				    }
				    else {
				    	$("#sic-" + help_pid)
				    	.css('-moz-column-count','4')
				    	.css('-webkit-column-count','4')
				    	.css('column-count','4');
				    }*/
			}
			
		});
		
	}
	
	/*end left catalog menu */
	
	/*start filter*/
	
	   if ($('.section-filter-ttl').length > 0) {
	        $('.section-filter').on('click', '.section-filter-ttl', function () {
	            if ($(this).parents('.section-filter-item').hasClass('opened')) {
	                $(this).parents('.section-filter-item').removeClass('opened');

	            } else {
	                $(this).parents('.section-filter-item').addClass('opened');
	            }
	            return false;
	        });
	        
	        $('.section-filter-fields').each(function(){
	        	var section_len = $(this).children().length;
	        	var section_id = $(this).attr('id');
	        	
	        	if (section_len >= 6){
	        		$(this).append('<p class="section-filter-ttl-view-all" id="ttl-link-all-' + section_id + '"><a href="#" class="section-filter-ttl-view-all-link" rel="' + section_id + '">Показать все...</a></p>');
	        		//$(this).after('<p class="section-filter-ttl-view-all" id="ttl-link-all-' + section_id + '"><a href="#" class="section-filter-ttl-view-all-link" rel="' + section_id + '">Показать все...</a></p>');
	        		$(this).children().not('.section-filter-ttl-view-all').each(function(e){
	        			if (e >= 6){
	        				$(this).css('display','none');	
	        			}
	        		});
	        	}
	        });
	        
	        $('.section-filter-ttl-view-all-link').on('click',function(e){
	        	e.preventDefault();
		        	var section_link_id = $(this).attr('rel');
		        	$('#' + section_link_id).children('.section-filter-field').css('display','block');
		        	$(this).css('display','none').attr('data-check','1');
	        });
	        
	        $('.section-filter-checkbox').on('click',function(){
	        	//console.log($(this).hasClass('kombox-disabled'));
	        	if ($(this).hasClass('kombox-disabled') !== true){
		        	var toppos = $(this).position().top + 2;
		        	$("#modef").css("display","block");
		        	$("#modef").stop().animate({'top': toppos + 'px'}, 200);
	        	}
	        });   
	        
	        /*section filter search*/
	        $(".section-filter-ttl-search-input").on('keyup input',function() {
	        	//console.log($(this).val().toLowerCase());
	        	var rel_filter = $(this).attr('rel');
	        	var ws_filter = $(this).val().toLowerCase();
	        	var len_filter = $(this).val().toLowerCase().length;
	        	//console.log('len_filter' + len_filter);
	        	if (len_filter > 0) {
	        
	        		$("#section-filter-block-" + rel_filter + " .section-filter-field").each( function(){
	 	   		       var $this = $(this);
	 	   		       var value = $this.attr( "data-filter-val" ).toLowerCase(); //convert attribute value to lowercase
	 	   		       if (value.length > 0)
	 	   		    	   {
	 	   		       if (value.includes( ws_filter ))
	 	   		    	   {
	 	   		    	   	$this.css('display','block');
	 	   		    	   
	 	   		    	   }
	 	   		       else
	 	   		    	   {
	 	   		    	   	$this.css('display','none');
	 	   		    	   }
	 	   		    	   }
	 	   		    });
	        		
	        	} else {
	        		if($('#ttl-link-all-section-filter-block-' + rel_filter).children('.section-filter-ttl-view-all-link').attr('data-check') === '1'){
	        			$("#section-filter-block-" + rel_filter + " .section-filter-field").css('display','block');	
	        		}
	        		else {
	        			$("#section-filter-block-" + rel_filter + " .section-filter-field").css('display','none');
		        		$("#section-filter-block-" + rel_filter + " .section-filter-field").slice(0,6).css('display','block');	
	        		}
	        		
	        	}
	   	});
	        /*section filter search*/
	        
	        $('#section-filter-toggle').on('click', function () {
	            $(this).next('.section-filter-cont').slideToggle();
	            if ($(this).hasClass('opened')) {
	                $(this).removeClass("opened").find('span').text($(this).data("open"));
	            }
	            else {
	                $(this).addClass('opened').find('span').text($(this).data("close"));
	            }
	            return false;
	        });
	        
	    }
	   
		// Range Slider
		if ($('.range-slider').length > 0) {
			$('.range-slider').each(function () {
				var range_slider = $(this);
				$(range_slider).ionRangeSlider({
					type: "double",
					grid: range_slider.data('grid'),
					min: range_slider.data('min'),
					max: range_slider.data('max'),
					from: range_slider.data('from'),
					to: range_slider.data('to'),
					prefix: range_slider.data('prefix')
				});
			});
		}
		
		// Select Styles
		if ($('.chosen-select').length > 0) {
			$('.chosen-select').chosen();
		}
	
	/*end start filter*/
    
});