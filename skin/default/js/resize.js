//框架搭建

function resize(){
			$('.policy_detail_teacher').height(0);
			$('.policy_detail_policy').height(0);
			$('.policy_detail_combat').height(0);
			//获取当前窗口宽高；
			var screenWidth = document.body.offsetWidth;
			var screenHeight = document.body.offsetHeight;

			//.获取head固定宽高；
			var head_height = $('.head').height();
			//.获取aside固定宽高；	
			var aside_width = $('.aside').width();
			var tread_height =$('.tread').height();
			var roll_head_height=$('.roll_head').height();	
			var news_height=$('.news').height();

			//.获取talk固定宽高；
			var talk_head_height =$('.talk_head').height();
			var note_height =$('.note').height();
			//.获取room固定宽高；
			var video_head_height=$('.video_head').height();
			var policy_head_height=$('.policy_head').height();
			//给border宽高固定数值；
			var border_height = 2;
			var border_width = 2;
			//.aside的左右边距是量出来的数值；
			var aside_margin_left =10;
			var aside_margin_right =10;
			var aside_margin_top =10;
			var aside_margin_down =10;


			//.note的上边距是量出来的数值；
			var note_margin_top =10;
			//.video的上边距是量出来的数值；
			var video_margin_down =10;
			//chat_room_padding-top固定数值
			var chat_room_padding_top =20;
			//chat_room_padding-left固定数值
			var chat_room_padding_left =20;
			//talk_margin-right固定数值
			var talk_margin_right=10;
			//video_view宽高比0.75；
			var video_view_per=0.75;
			//takl_room宽比0.75；
			var talk_room_per=0.45;
   			var video_margin_bottom=10;
   			var policy_head_margin_bottom=3;
   			var talk_head_padding_top=10;
   			var news_margin_top=10;
			//申明各高度变量
			var contain_height=$('.contain').height();
			var aside_height=$('.aside').height();
			var inner_aside_height=$('.inner_aside').height();

			var roll_height=$('.roll').height();
			var roll_list_height=$('.roll_list').height();
			var section_height=$('.section').height();
			var talk_height=$('.talk').height();
			var room_height=$('.room').height();
			var chat_height=$('.chat').height();
			var chat_bg_height=$('.chat_bg').height();
			var chat_room_height=$('.chat_room').height();
			var video_height=$('.video').height();
			var video_view_height=$('.video_view').height();
			var policy_detail_height=$('.policy_detail').height();
			var policy_detail_bg_height=$('.policy_detail_bg').height();


			

			//各变量高度之间的关系
			//contain高度计算：当前窗口高度-head的高度；
			contain_height=screenHeight-head_height;
			$('.contain').height(contain_height);

			//aside高度计算：contain高度-aside的边距、边；
			aside_height=contain_height-aside_margin_top-aside_margin_down;
			$('.aside').height(aside_height);
			//aside高度计算：contain高度-aside的边距、边；

			inner_aside_height=aside_height-news_height-news_margin_top-border_height;
			$('.inner_aside').height(inner_aside_height);
			

			//roll高度计算：aside高度-tread的高度-div.news的高度、边距；
			roll_height=inner_aside_height-tread_height;
			$('.roll').height(roll_height);
			//roll_list高度计算：roll—list高度-roll_head的高度-border高度；
			roll_list_height=roll_height-roll_head_height-border_height-10;
			$('.roll_list').height(roll_list_height);

			//section高度计算：contain高度-aside边距；
			section_height=contain_height-aside_margin_top-aside_margin_down;
			$('.section').height(section_height);
			//section高度计算：section高度=talk高度=room高度；
			talk_height=room_height=section_height;
			$('.talk').height(talk_height);
			$('.room').height(room_height);
			//chat高度计算：talk的高度-note下边距-note高度-border高度；
			chat_height=talk_height-note_margin_top-note_height-border_height;
			$('.chat').height(chat_height);
			//chat_bg高度：chat的高度-border；
			 chat_bg_height=chat_height-border_height;
			$('.chat_bg').height(chat_bg_height);
			//chat高度计算：chat的高度-talk_head的高度-padding高度；
			chat_room_height=chat_height-talk_head_height-chat_room_padding_top-talk_head_padding_top;
			$('.chat_room').height(chat_room_height);





			//申明各宽度变量
			var contain_width=$('.contain').width();
			var section_width=$('.section').width();
			var talk_width=$('.talk').width();
			var talk_head_width=$('talk_head').width();
			var chat_width=$('.chat').width();
			var chat_bg_width=$('.chat_bg').width();
			var chat_room_width=$('.chat_room_width').width();
			var text01_widtd=$('.text01').width();

			//各变量宽度之间的关系
			//section宽度=contain宽度-aside宽度-border宽度-aside边距-section边距；
			section_width=contain_width-aside_width-aside_margin_left-aside_margin_right-17;
			$('.section').width(section_width);


			//talk的宽度：section*0.45;
			talk_width=(section_width)*talk_room_per;

			if(talk_width<600){talk_width=600;}
			$('.talk').width(talk_width);
			chat_bg_width=talk_width-border_width;
			$('.chat_bg').width(chat_bg_width);
			text01_widtd=talk_width-18-10-2-10-159;

			//各变量宽度之间的关系
			var room_width=$('.room').width();
			var video_width=$('.video').width();
			var video_head_width=$('.video_head').width();
			var video_view_width=$('.video_view').width();
			var policy_width=$('.policy').width();
			var policy_head_width=$('.policy_head').width();
			var policy_detail_width=$('.policy_detail').width();
			var policy_detail_bg_width=$('.policy_detail_bg').width();
			var policy_head_last=$('.policy_head_last').width();
			//各变量宽度之间的关系
			//room宽度:section宽度-talk宽度-talk_margin-right
			room_width=section_width-talk_width-talk_margin_right;
			if(room_width>800){
				room_width=800;
				talk_width=section_width-room_width-talk_margin_right;
			}
			if(room_width<550){
				room_width=550;
				talk_width=section_width-room_width-talk_margin_right;
			}
			chat_bg_width=talk_width-border_width;
			//18是左边距，10是右边距，2是边框，15是后边图片的左边距，159是图片的宽度；
			text01_widtd=talk_width-18-10-2-15-159;
			
			policy_head_width=policy_width=video_view_width=video_head_width=video_width=room_width;
			policy_detail_width=policy_width-border_width;
			policy_detail_bg_width=policy_detail_width;
			//345是前面 三个span的宽度；
			policy_head_last=policy_head_width-345-15;	
			$('.chat_bg').width(chat_bg_width);
			$('.talk').width(talk_width);
			$('.room').width(room_width);
			$('.video').width(video_width);
			$('.video_head').width(video_head_width);
			$('.video_view').width(video_view_width);
			$('.policy').width(policy_width);
			$('.policy_head').width(policy_head_width);
			$('.policy_detail').width(policy_detail_width);
			$('.policy_detail_bg').width(policy_detail_bg_width);
			$('.text01').width(text01_widtd);
			$('.policy_head_last').width(policy_head_last);
			// $('.it_roll li').width(policy_detail_width);
			//
			//各变量高度之间的关系
			var video_height=$('.video').height();
			var video_view_height=$('.video_view').height();
			var policy_height=$('.policy').height();
			var policy_detail_height=$('.policy_detail').height();
			var policy_detail_bg_height=$('.policy_detail_bg').height();
			var policy_detail_teacher_height=$('.policy_detail_teacher').height();
			var policy_detail_policy_height=$('.policy_detail_policy').height();
			var policy_detail_combat_height=$('.policy_detail_combat').height();


			video_view_height=video_view_width*video_view_per;
			video_height=video_view_height+video_head_height+1;
			policy_height=room_height-video_height-video_margin_bottom;
			policy_detail_height=policy_height- policy_head_height-policy_head_margin_bottom-border_height;
			if(policy_detail_height<150){
				policy_detail_height=150;
				video_view_height=room_height-policy_head_height-policy_head_margin_bottom-policy_detail_height-border_height-video_margin_bottom-video_head_height-1;
					video_height=video_view_height+video_head_height+1;
			}
			//10是padding——height；
			policy_detail_combat_height=policy_detail_policy_height=policy_detail_height-10;
			policy_detail_teacher_height=policy_detail_height;
			policy_detail_bg_height=policy_detail_height;
			$('.video_view').height(video_view_height);
			$('.video').height(video_height);
			$('.policy').height(policy_height);
			$('.policy_detail').height(policy_detail_height);
			$('.policy_detail_bg').height(policy_detail_bg_height);
			$('.policy_detail_teacher').height(policy_detail_teacher_height);
			// $('.it_roll li').height(policy_detail_teacher_height);
			$('.policy_detail_policy').height(policy_detail_combat_height);
			$('.policy_detail_combat').height(policy_detail_combat_height);
			

}

// 函数调用
$(function(){
	//调用函数resize();
	resize();
	//调用函数addname();
	addname();
	//调用函数change_nav01();
	change_nav01();	
	//调用函数srcolldown();javascript:;
	setTimeout(srcolldown,200);
});

