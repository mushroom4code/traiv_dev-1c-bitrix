/* global window, document, define, jQuery, setInterval, clearInterval */
;(function(factory) {
    'use strict';
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports !== 'undefined') {
        module.exports = factory(require('jquery'));
    } else {
        factory(jQuery);
    }

}(function($) {
    'use strict';
    var Kviz = window.Kviz || {};

    Kviz = (function() {

        var instanceUid = 0;

        function Kviz(element, settings) {

            var _ = this, dataSettings;

            _.defaults = {
            		dataJson: null,
            		typeKviz: 'funny',
            		withImg: true,
            		withNextB: false,
            		ansCorrectText: 'А вас не проведешь! Вопрос был с подвохом, но вы ответили верно!',
            		ansDoneText: 'Ой, ошибочка вышла! Гровер изготавливают только из бронзы, т.к остальные металлы для такой шайбы недостаточно прочны!',
            		ansDirection: 'vertical',
            		valList: function( elem, i, val, res, img ) {
            			var imgans='';
            			if (img) {
            				imgans = '<div class="imgans-block"><img src="' + img + '"/></div>';
            				/*imgans = '<div class="imgans-block"><div class="imgans-block-in" style="background-image:url(' + img + ');"><!--<img src="' + img + '"/>--></div></div>';*/
            			}
                        return $('<div class="kviz-ans-link" rel=' + i + ' data-res=' + res + '><i class="fa fa-arrow-right"></i><span>' + val + '</span>' + imgans + '</div>');
                    },
/*              accessibility: true,
                adaptiveHeight: false,
                appendArrows: $(element),
                appendDots: $(element),
                autoplay: false,
                autoplaySpeed: 3000,
                centerMode: false,
                centerPadding: '50px',
                cssEase: 'ease',
                edgeFriction: 0.35,
*/
            };

            _.initials = {
            	$areaBlock: null,
            	$kvizBlock: null,
            	$kvizBlockLeft: null,
            	$kvizBlockRight: null,
            	$kvizBlockClose: null,
            	$kvizBlockTitle: null,
            	$kvizBlockNote: null,
            	$kvizBlockLeftImg: null,
            	$kvizBlockControl: null,
            	$kvizBlockButtonStart: null,
            	$kvizBlockNextB: null,
            	$kvizBlockNextBnote: null,
            	$listV: null,
            	currentQ: 0,
            	totalQ: 0,
            };

            $.extend(_, _.initials);
            
            _.$elem = $(element);
            _.itemArr = [];
            _.itemResVal = [];
            _.itemRes = [];


            dataSettings = $(element).data('kviz') || {};

            _.options = $.extend({}, _.defaults, settings, dataSettings);

            _.originalSettings = _.options;

            if (typeof document.mozHidden !== 'undefined') {
                _.hidden = 'mozHidden';
                _.visibilityChange = 'mozvisibilitychange';
            } else if (typeof document.webkitHidden !== 'undefined') {
                _.hidden = 'webkitHidden';
                _.visibilityChange = 'webkitvisibilitychange';
            }

            _.instanceUid = instanceUid++;

            // A simple way to check for HTML strings
            // Strict HTML recognition (must start with <)
            // Extracted from jQuery v1.11 source
            _.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/;

            _.init(true);

        }

        return Kviz;

    }());


    Kviz.prototype.init = function() {

        var _ = this;
        //console.log(_.options.typeKviz);
        _.build();
        _.initEvents();
    };
    
    Kviz.prototype.build = function () {
    	 var _ = this, i=0;
    	 
    	 $.each(_.options.dataJson[0].q, function ( index, it ) {
    		var qn = it.name;
    		var qans = it.ans;
    		var qimg = it.img;
    		
    		_.itemArr.push({'id': index+1, 'qn': qn, 'qans': qans, 'qimg':qimg});
    		
    		 /*var n = it.name;
    			var v = parseFloat(it.value.replace(',', '.'));
    			var c = it.color;
    			
    			if( _.isNumeric(v) === true ) {
    			  _.itemArr.push({'id': index+1, 'v': v, 'n': n, 'c':c});
    			  _.itemSumm = _.itemSumm + v;
    			  _.itemCount++;*/
    		i++;
    	    	});
    	 
    	 $.each(_.options.dataJson[0].res, function ( index, it ) {
     		var rn = it.name;
     		var rtitle = it.title;
     		var rnote = it.note;
     		var rimg = it.img;
     		
     		_.itemResVal.push({'id': index+1, 'rn': rn, 'rtitle': rtitle, 'rnote': rnote, 'rimg':rimg});

     	  });
    	 
    	 _.totalQ = i;
    	 
    	 //console.log(_.$elem);
    	 _.$areaBlock = $( "<div></div>" )
    		      .appendTo( _.$elem )
    		      .addClass( "kviz-data-layer" );
    	 
    	 _.$kvizBlock = $( "<div></div>" )
   		      .appendTo( _.$elem )
   		      .addClass( "kviz-data-block" );
    	 if (_.options.withImg === true) {
    	 _.$kvizLeft = $( "<div></div>" )
      		      .appendTo( _.$kvizBlock )
      		      .addClass( "kviz-left" );
    	 }
    	 
    	 _.$kvizRight = $( "<div></div>" )
     		      .appendTo( _.$kvizBlock )
     		      .addClass( "kviz-right" );
    	 
    	 _.$kvizBlockClose = $( "<div></div>" )
     		      .appendTo( _.$kvizBlock )
     		      .addClass( "kviz-close" ).html('<i class="fa fa-close"></i>');
    	 
    	 _.$kvizBlock.css("top", Math.max(0, (($(window).height() - _.$kvizBlock.outerHeight()) / 2) + 
                 $(window).scrollTop()) + "px" );
    	 _.$kvizBlock.css("left", Math.max(0, (($(window).width() - _.$kvizBlock.outerWidth()) / 2) + 
                 $(window).scrollLeft()) + "px");
    	 
    	 //console.log(typeof($.parseJSON(_.options.dataJson)));
    	 if ( _.options.dataJson !== null && typeof(_.options.dataJson) === 'object' ) {
    		// console.log(_.options.dataJson[0].name);
    		 
    		 _.$kvizBlockTitle = $( "<div></div>" )
    	   		      .appendTo( _.$kvizRight )
    	   		      .addClass( "kviz-title" ).text(_.options.dataJson[0].name);
    		 _.$kvizBlockNote = $( "<div></div>" )
   	   		      .appendTo( _.$kvizRight )
   	   		      .addClass( "kviz-note" ).html(_.options.dataJson[0].description);
    		 _.$kvizBlockLeftImg = $( "<img>" )
   	   		      .appendTo( _.$kvizLeft ).css('background-image', 'url(' + _.options.dataJson[0].imgsrc + ')');
    		 
    		 _.$kvizBlockControl = $( "<div></div>" )
      	   		      .appendTo( _.$kvizRight )
       	   		      .addClass( "kviz-control" );
    		 _.$kvizBlockButtonStart = $( "<div class='btn-group-blue'><a href='#' class='btn-blue'><span>Начать квиз!</span></a></div>" )
      	   		      .appendTo( _.$kvizBlockControl );
    		 _.$kvizBlockNextB = $( "<div class='btn-group-blue'><a href='#' class='btn-blue'><span>Следующий вопрос</span></a></div>" )
     	   		      .appendTo( _.$kvizBlockControl ).css('display','none');
    		 _.$kvizBlockNextBnote = $( "<div class='block-control-text'></div>" )
    	   		      .appendTo( _.$kvizBlockControl ).css('display','none');
    		 
    		 
    	 }
   };
   
   Kviz.prototype.startKviz = function() {
	   var _ = this;
	   if (_.options.withImg === true) {
		   _.$kvizLeft.stop().animate({'opacity':0},500,function(){
			   _.$kvizLeft.css('visibility', 'hidden');
		   });
	   }
	   _.$kvizBlockNote.stop().animate({'opacity':0},500,function(){
		   _.$kvizBlockNote.css('visibility', 'hidden');
	   });
	   
	   _.$kvizBlockTitle.stop().animate({'opacity':0},500,function(){
		   _.$kvizBlockTitle.css('visibility', 'hidden');
		   _.viewQ();
	   });
   };
   
   Kviz.prototype.viewQ = function() {
	   var _ = this, listV, q, a;
	   _.$kvizBlockButtonStart.css('display','none');
	   _.$kvizBlockLeftImg.css('background-image', 'url(' + _.itemArr[_.currentQ].qimg + ')');
	   _.$kvizBlockTitle.text(_.itemArr[_.currentQ].id + '. ' +_.itemArr[_.currentQ].qn);
	   _.$kvizBlockNote.text('');
	   listV = $("<ul class='kviz-ans-list'/>");
	   
	   
	   $.each(_.itemArr[_.currentQ].qans, function ( index, it ) {
		   if (_.options.ansDirection == 'horizontal') {
			   listV.append($('<li/>').append(_.options.valList.call(this, _, _.itemArr[_.currentQ].id, it.note,it.res,it.imgans)).addClass('ans-horizontal'));   
		   } else {
			   listV.append($('<li/>').append(_.options.valList.call(this, _, _.itemArr[_.currentQ].id, it.note,it.res,it.imgans)));
		   }
   			
   	   });
	   
	   _.$listV = listV.appendTo( _.$kvizBlockNote );
	   
	   //console.log(_.$listV);
	   
	   $('.kviz-ans-link', _.$listV).on( 'click', function ( e ) {   		
			e.preventDefault();
			q = $(this).attr('rel');
			a = $(this).attr('data-res');
			
			if (_.options.withNextB == true) {
				$('.kviz-ans-link').css('pointer-events','none').off('click');
			
				//console.log('q' + q + 'a' + a);
				if (a == 'none') {
					_.$kvizBlockNextBnote.text(_.options.ansDoneText).css('display','block');
					$(this).addClass('none');
				} else if (a == 'correct') {
					_.$kvizBlockNextBnote.text(_.options.ansCorrectText).css('display','block');
				}
				
				_.$kvizBlockNextB.css('display','block');
				
				$('.kviz-ans-link[rel="' + q + '"][data-res="correct"]').addClass('correct');
				
				_.$kvizBlockNextB.on('click',function(){
					
					_.rsRun({
			            data: {
			                q: q,
			                a: a
			            }
			        });
					
				});
				
				
			} else {
			
				_.rsRun({
		            data: {
		                q: q,
		                a: a
		            }
		        });
				
			}
			
			
	   });
	   
	   _.$kvizBlockNextBnote.css('display','none');
	   _.$kvizBlockNextB.css('display','none');
	   _.$kvizBlockNextB.off('click');
	   _.$kvizLeft.css('visibility', 'visible');
	   _.$kvizBlockTitle.css('visibility', 'visible');
	   _.$kvizBlockNote.css('visibility', 'visible');
	   _.$kvizLeft.stop().animate({'opacity':1},500);
	   _.$kvizBlockTitle.stop().animate({'opacity':1},500);
	   _.$kvizBlockNote.stop().animate({'opacity':1},500);
	   
   };
   
   Kviz.prototype.rsRun = function( event ) {
	   var _ = this;
	   //console.log( event );
	   
	   if (_.itemRes.push({'id': event.data.q, 'a': event.data.a})) {
		   _.currentQ++;
		   
		   _.$kvizLeft.stop().animate({'opacity':0},500,function(){
			   _.$kvizLeft.css('visibility', 'hidden');
		   });
		   
		   _.$kvizBlockNote.stop().animate({'opacity':0},500,function(){
			   _.$kvizBlockNote.css('visibility', 'hidden');
		   });
		   
		   _.$kvizBlockTitle.stop().animate({'opacity':0},500,function(){
			   _.$kvizBlockTitle.css('visibility', 'hidden');
			   
			 /*  console.log(_.currentQ);
			   console.log(_.totalQ);*/
			   if (_.currentQ == _.totalQ) {
				   _.endKviz();
			   } else {
				   _.viewQ();
			   }
		   });
	   };
   };
   
   Kviz.prototype.endKviz = function() {
	   var _ = this, result, max, matches, connect_val, found = false, connect_val_end;
	   
	  // console.log('endKviz');
	   //console.log(_.itemRes);
	   //console.log(_.itemResVal);
	   
	   result = _.itemRes.reduce( (acc, o) => (acc[o.a] = (acc[o.a] || 0)+1, acc), {} );
	   
	   //console.log('result.correct' + result.correct);
	   
	   if (_.options.typeKviz == 'funny') {
	   max = _.itemRes.reduce(function(prev, current) {
		    if (+current.a > +prev.a) {
		        return current;
		    } else {
		        return prev;
		    }
		});
	   
	   matches = $.grep(_.itemResVal, function(e) { return e.rn == max.a });
	   //console.log(matches[0].rnote);
	   _.$kvizBlockNote.html(matches[0].rnote);
	   _.$kvizBlockTitle.text(matches[0].rtitle);
	   _.$kvizBlockLeftImg.css('background-image', 'url(' + matches[0].rimg + ')');
	   
	   }
	   else if (_.options.typeKviz == 'correct') {
		   connect_val = result.correct;
		   
		   //console.log('connect_val' + connect_val);
		   
	    	 $.each(_.itemResVal, function ( index, it ) {
	    		 connect_val_end = it.id;
	    		// console.log(connect_val + ' // ' + typeof(parseInt(it.rn)));
	    		 //console.log(parseInt(it.rn));
	    		 if (connect_val > parseInt(it.rn)) {
	    		        found = true;
	    		        return false;
	    		    }
	     		});
	    	 
	    	// console.log('connect_val_end' + connect_val_end);
	    	 
	  	   matches = $.grep(_.itemResVal, function(e) { return e.id == connect_val_end });
		   //console.log(matches[0].rnote);
		   _.$kvizBlockNote.html(matches[0].rnote);
		   _.$kvizBlockTitle.text(matches[0].rtitle);
		   _.$kvizBlockLeftImg.css('background-image', 'url(' + matches[0].rimg + ')');
		   
	   }
	   _.$kvizBlockNextBnote.css('display','none');
	   _.$kvizBlockNextB.css('display','none');
	   _.$kvizBlockNextB.off('click');
	   _.$kvizLeft.css('visibility', 'visible');
	   _.$kvizBlockTitle.css('visibility', 'visible');
	   _.$kvizBlockNote.css('visibility', 'visible');
	   _.$kvizLeft.stop().animate({'opacity':1},500);
	   _.$kvizBlockTitle.stop().animate({'opacity':1},500);
	   _.$kvizBlockNote.stop().animate({'opacity':1},500);
	   
	   
   };
   
   Kviz.prototype.initEvents = function() {
	   var _ = this;
	   
	   $(_.$kvizBlockButtonStart).on( 'click', function ( e ) {   		
			e.preventDefault();
			_.startKviz();
	   });
	   
	   $(_.$kvizBlockClose).on( 'click', function ( e ) {   		
			e.preventDefault();
			_.destroy();
	   });
   };
    
   Kviz.prototype.destroy = function ( ) {
	 var _ = this;
	 _.cleanUpEvents();
	 if ( _.$areaBlock ) {
		    _.$areaBlock
		      .remove();
		  }
 	if ( _.$kvizBlock ) {
	    _.$kvizBlock
	      .remove();
	  }
   };
   
   Kviz.prototype.cleanUpEvents = function () {
	   var _ = this;
	   $(_.$kvizBlockButtonStart).off('click');
	   $(_.$kvizBlockClose).off('click');
   }
   
    $.fn.kviz = function() {
        var _ = this,
            opt = arguments[0],
            args = Array.prototype.slice.call(arguments, 1),
            l = _.length,
            i,
            ret;
        for (i = 0; i < l; i++) {
            if (typeof opt == 'object' || typeof opt == 'undefined')
                _[i].kviz = new Kviz(_[i], opt);
            else
                ret = _[i].kviz[opt].apply(_[i].kviz, args);
            if (typeof ret != 'undefined') return ret;
        }
        return _;
    };

}));