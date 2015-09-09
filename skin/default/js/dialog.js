/*此页面记录一切与弹出窗有关的函数*/

$(function (){

$('.dialog').click(function (){
	var dom = $(this);
	/*先看看是否需要提前调用某函数*/
	var onstart = dom.data('onstart');
	if(onstart != undefined){
		eval("var result = "+onstart);
		if( ! result) return;
	}

	/*下面加载内容，分为ID和URL两种情况，URL优先显示*/
	var url = dom.data('url');
	var content = '';
	if(url != undefined && url != ''){
		content = '<iframe src="'+url+'" frameborder="0" style="width:100%; height:100%;"></iframe>';
	}else{
		var target = dom.data('target');
		content = $('#'+target).clone(true, true);
	}
	$('#dialog .dialog-content').html(content);
	var mask = dom.data('mask');
	if(mask === undefined) mask = 1;
	mask = parseInt(mask);
	show_dialog(dom.data('width'), dom.data('height'), mask);

	var oncomplete = dom.data('oncomplete');
	if(oncomplete != undefined){
		eval(oncomplete);
	}
})

})

function show_dialog(width, height, mask){
	var screenWidth = document.body.offsetWidth;
	var screenHeight = document.body.offsetHeight;
	$('#dialog').css({'width' : width, 'height' : height, 'left' : (screenWidth-width)/2, 'top' : (screenHeight-height)/2 });
	$('#dialog').css('display', 'block');
	if(mask) $('#mask').css('display', 'block');
}

function close_dialog(){
	$('#mask, #dialog').css('display', 'none');
}


function nav_switch(){
		// nav切换
		$('.dialog-content .inner_contain .ul_nav li').mouseover(function(){
			$(this).addClass('inner_contain_current').siblings().removeClass('inner_contain_current');
			$('.dialog-content .inner_contain .ul_nav li i').remove();
			$(this).append('<i></i>')

		})

		//nav 与下面内容链接
		$('.dialog-content .inner_contain .ul_nav li').mouseover(function(){
			var index=$(this).index();
			
			$('.dialog-content .ul_contain li:eq('+index+')').show().siblings().hide();

		});

		// 产品优势——内容切换
		$('.dialog-content .strength .imgs img ').mouseover(function(){
			var index=$(this).index();
			var index01=index+1;
			$('.dialog-content .strength .imgs img').each(function(i){
				var d=i+1;
				this.src= base.tpl+'images/product/'+d+'.png';
			})
		    $(this).attr('src', base.tpl+'images/product/'+index01+'.'+index01+'.png');
			$('.dialog-content .strength .words p').hide();
			$('.dialog-content .strength .words p:eq('+index+')').show();
		})
	}


$(function(){
		// nav切换
		$('.inner_contain .ul_nav li').mouseover(function(){
			$(this).addClass('inner_contain_current').siblings().removeClass('inner_contain_current');
			$('.inner_contain .ul_nav li i').remove();
			$(this).append('<i></i>')

		})

		//nav 与下面内容链接
		$('.inner_contain .ul_nav li').mouseover(function(){
			var index03=$(this).index();
			$('.inner_contain .ul_contain li:eq('+index03+')').show().siblings().hide();
		});

		// 产品优势——内容切换
		$('.strength .imgs img ').mouseover(function(){
			var index=$(this).index();
			var index01=index+1;
			$('.strength .imgs img').each(function(i){
				var d=i+1;
				this.src= base.tpl+'images/product/'+d+'.png';
			})
		    $(this).attr('src', base.tpl+'images/product/'+index01+'.'+index01+'.png');
			$('.strength .words p').hide();
			$('.strength .words p:eq('+index+')').show();
		})
		$('.strength .imgs img').mouseout(function(){
			var index=$(this).index();
			var index01=index+1;
			// $('.strength .imgs img').attr('src', base.tpl+'images/product/'+index01+'.'+index01+'.png');
		})
		
	})