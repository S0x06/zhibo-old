/*此页面记录一切与弹出窗有关的函数*/

$(function (){

$('.dialog').click(function (){
	close_dialog();
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
	var screenWidth = $('body').outerWidth();
	var screenHeight = document.body.offsetHeight;
	$('#dialog').css({'width' : width, 'height' : height, 'left' : (screenWidth-width)/2, 'top' : (screenHeight-height)/2, 'display' : 'block' });
	if(mask) $('#mask').css('display', 'block');
}

function close_dialog(){
	$('#mask, #dialog').css('display', 'none');
	$('#dialog .dialog-content').css('background', '#f7f1eb');
}


