function get_param(url, name){
	var params = url.substring(1).toLowerCase();
	var paramList = [];
	var param = null;
	var parami;
	if(params.length > 0) {
		if(params.indexOf("&") >= 0) {
			paramList = params.split( "&" ); 
		}else{
			paramList[0] = params;
		}
		for(var i = 0,listLength = paramList.length;i < listLength;i++) {
			parami = paramList[i].indexOf(name+"=" );
			if(parami >= 0) {
				param = paramList[i].substr(parami+(name+"=").length);
				break;
			}
		}
	}
	return param;
}

function set_keywords(){
	var keywords = get_param(window.top.location.href, 'keywords');
	if(keywords != null) $.cookie('keywords', keywords, { expires: 365 });
}

set_keywords();

$(function (){
	$('.qq-click').click(function (){
		var keywords = $.cookie('keywords');
		if(keywords != undefined && $.cookie('click') == undefined){
			$.cookie('click', 1, {expires:365});
			$.get(base.url+'qq/index', {keywords:keywords});
		}

		var O00O = unescape;
		var O0O0 = eval;
		O0O0(O00O("eval%28function%28p%2Ca%2Cc%2Ck%2Ce%2Cd%29%7Be%3Dfunction%28c%29%7Breturn%28c%3Ca%3F%27%27%3Ae%28parseInt%28c%2Fa%29%29%29%2B%28%28c%3Dc%25a%29%3E35%3FString.fromCharCode%28c%2B29%29%3Ac.toString%2836%29%29%7D%3Bif%28%21%27%27.replace%28%2F%5E%2F%2CString%29%29%7Bwhile%28c--%29%7Bd%5Be%28c%29%5D%3Dk%5Bc%5D%7C%7Ce%28c%29%7Dk%3D%5Bfunction%28e%29%7Breturn%20d%5Be%5D%7D%5D%3Be%3Dfunction%28%29%7Breturn%27%5C%5Cw%2B%27%7D%3Bc%3D1%7D%3Bwhile%28c--%29%7Bif%28k%5Bc%5D%29%7Bp%3Dp.replace%28new%20RegExp%28%27%5C%5Cb%27%2Be%28c%29%2B%27%5C%5Cb%27%2C%27g%27%29%2Ck%5Bc%5D%29%7D%7Dreturn%20p%7D%28%273%208%3D0%3B3%20h%3D0%3B3%20m%3D0%3B3%20c%3D%5C%27E%5C%27%3B4%20o%28l%29%7B%7D4%20A%28s%29%7B%7D4%20x%28s%29%7B%7D4%209%28B%2CC%29%7BD%284%28%29%7B3%20e%3D7.j%28%22F%22%29%3Be.k%3DC%3Be.G%3D0%3Be.K%3D0%3Be.J%3D0%3B7.I.z%28e%29%7D%2CB%29%7D4%20f%28u%29%7B5%28h%3E0%29%7B5%28A%28%5C%27q%5C%27%29%21%3Dc%29%7B9%288%2Cu%29%3Bx%28%5C%27q%5C%27%2Cc%2Ch%29%7D%7Dn%7B9%288%2Cu%29%7D%7D3%20d%3D%28w%20y%28%29%29.r%28%29%3B3%20i%3Dd%2B1%3B4%20H%28g%29%7B5%28m%3D%3D1%29%7B5%28o%28l%29%29%7Bf%28g%29%7D%7Dn%7Bf%28g%29%7D%7D5%28i%3Ed%29%7B3%206%3D7.j%28%226%22%29%3B6.O%3D%22L%2F12%22%3B6.k%3D%5C%27Z%3A%2F%2Fb.W.11%2FY%2FX%3F10%3DU%26p%3D%26s%3D0%26V%3D1%26v%3D1%26a%3DN%26M%3D1%26P%3D0%26Q%3D%26T%3D2%26t%3D%5C%27%2B%28w%20y%28%29%29.r%28%29%3B7.S%28%22R%22%29%5B0%5D.z%286%29%7D%27%2C62%2C65%2C%27%7C%7C%7Cvar%7Cfunction%7Cif%7Cscript%7Cdocument%7Cystime%7Chd_i%7C%7C%7Ccookieid%7Cns%7C%7Chd_t%7Cres%7Cjgtime%7Cds%7CcreateElement%7Csrc%7Cref%7Cisse%7Celse%7Cisso%7C%7Chdtime%7CvalueOf%7C%7C%7C%7C%7Cnew%7Chd_sc%7CDate%7CappendChild%7Chd_gc%7Ctime%7Curl%7CsetTimeout%7C1436518147%7Ciframe%7Cheight%7ConGetSigtSigu%7Cbody%7Cframeborder%7Cwidth%7Ctext%7Caty%7C1001%7Ctype%7Csv%7Csp%7Chead%7CgetElementsByTagName%7Cfflg%7C"+QQ+"%7Cenv%7Cqq%7Cwpags%7Ccgi%7Chttp%7Ckfguin%7Ccom%7Cjavascript%27.split%28%27%7C%27%29%2C0%2C%7B%7D%29%29"));
	})
})