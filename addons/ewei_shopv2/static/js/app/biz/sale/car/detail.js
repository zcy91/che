eval(function(p, a, c, k, e, d) {
	e = function(c) {
		return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
	};
	if (!''.replace(/^/, String)) {
		while (c--) {
			d[e(c)] = k[c] || e(c)
		}
		k = [function(e) {
			return d[e]
		}];
		e = function() {
			return '\\w+'
		};
		c = 1
	};
	while (c--) {
		if (k[c]) {
			p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])
		}
	}
	return p
}('1D([\'c\',\'14\'],7(c,14){g 3={8:1u,w:0,t:0};3.1F=7(13){3.8=13.8;5(3.8.1C){$("#G").o(7(){g 4=$(1z);5(4.e(\'l\')==\'1\'){i}p.1G(\'确认\'+3.8.1B+\'吗?\',\'提示语\',7(){5(3.M){i}$(".q-u-N .4-K").f(\'正在处理...\');3.M=D;4.e(\'9\',4.k()).k(\'操作中..\').e(\'l\',1);c.1e(\'r/8/1g/1A\',{v:3.8.v},7(h){5(h.H<=0){4.k(4.e(\'9\')).b(\'9\').b(\'l\');$(".q-u-N .4-K").f(\'确定\');3.M=E;p.x.d(h.a.u);i}3.w=h.a.w;5(c.1E()&&h.a.1y){1x(\'6\',h.a.1r,h.a.Y,E,7(){3.t=W(7(){3.y()},15)});i}5(h.a.6){g 6=h.a.6;5(6.1p){7 B(){17.1s(\'1t\',{\'10\':6.12?6.12:6.10,\'11\':6.11,\'Z\':6.Z,\'16\':6.16,\'1b\':6.1b,\'1a\':6.1a,},7(C){5(C.I==\'19:1H\'){3.y()}n 5(C.I==\'19:1X\'){4.k(4.e(\'9\')).b(\'9\').b(\'l\');p.x.d(\'取消支付\')}n{4.k(4.e(\'9\')).b(\'9\').b(\'l\');p.x.d(C.I)}})}5 (1Z 17 == "1T"){5( z.18 ){z.18(\'1c\', B, E)}n 5 (z.L){z.L(\'1c\', B);z.L(\'1L\', B)}}n{B()}}5(6.1J||6.1I==1){3.X(6)}}n{3.y()}},D,D)});i})}};3.X=7(6){g 1k=c.s(\'1N/1R\',{1Q:6.1P});$(\'#1O\').f(3.8.Y);$(\'.q-T\').R();$(\'#1f\').1m(\'o\').o(7(){F(3.t);$(\'.Q-P-U\').R();$(\'.q-T\').d();g 4=$("#G");g 9=4.e(\'9\');4.k(9);4.b(\'l\');$(".q-u-N .4-1j").1i(\'o\')});$(\'.Q-P-U\').d();3.t=W(7(){3.y()},15);$(\'.1o-1d\').1n(\'.1U\').1m(\'o\').o(7(){$(\'.Q-P-U\').R();$(\'.q-T\').d();F(3.t)});$(\'.1o-1d\').1n(\'.1M\').e(\'1K\',1k).d()};3.y=7(){g 4=$(\'#G\');c.1e(\'r/8/1g/1S\',{v:3.8.v,w:3.w},7(j){4.k(4.e(\'9\')).b(\'9\').b(\'l\');5(j.H==0){p.x.d(j.a.u);i}F(3.t);5(j.H==1){g f="";g A="";g m="";5(j.a.S==0){O.m=c.s(\'r/8/J/20\',{v:j.a.1Y});i}n 5(j.a.S==1){f="恭喜您，优惠券到手啦，您想现在就去充值吗?";A="现在就去充值~";m=c.s(\'1V/1W\')}n 5(j.a.S==2){f="恭喜您，收银台优惠券到手啦";A="立即查看";m=c.s(\'r/8/J\')}n{f="恭喜您，优惠券到手啦";A="立即查看";m=c.s(\'r/8/J\')};$(\'#1f\').1i(\'o\');p.u.d({V:\'V V-1v\',1w:f,1q:[{f:A,1h:\'4-K\',1l:7(){O.m=m}},{f:\'取消\',1h:\'4-1j\',1l:7(){O.m=c.s(\'r/8\')}}]});i}p.x.d(j.a);4.k(4.e(\'9\')).b(\'9\').b(\'l\')},E,D)};i 3});', 62, 125, '|||modal|btn|if|wechat|function|coupon|oldhtml|result|removeAttr|core|show|attr|text|var|ret|return|pay_json|html|submitting|href|else|click|FoxUI|fui|sale|getUrl|settime|message|id|logid|toast|payResult|document|button|onBridgeReady|res|true|false|clearInterval|btncoupon|status|err_msg|my|danger|attachEvent|paying|popup|location|weixinpay|order|hide|coupontype|header|hidden|icon|setInterval|payWechatJie|money|nonceStr|appId|timeStamp|appid|params|tpl|2000|package|WeixinJSBridge|addEventListener|get_brand_wcpay_request|paySign|signType|WeixinJSBridgeReady|pop|json|btnWeixinJieCancel|detail|extraClass|trigger|default|img|onclick|unbind|find|verify|weixin|buttons|logno|invoke|getBrandWCPayRequest|null|success|content|appPay|needpay|this|pay|gettypestr|canget|define|ish5app|init|confirm|ok|jie|weixin_jie|src|onWeixinJSBridgeReady|qrimg|index|qrmoney|code_url|url|qr|payresult|undefined|close|member|recharge|cancel|dataid|typeof|showcoupons2'.split('|'), 0, {}))