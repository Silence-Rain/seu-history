/*
used to:
1. add cookie with a expiration time
2. get cookie
3. remove cookie by giving a key
4. remove all cookies
*/

// set cookie
function setCookie(key,value,hours){
	var exp=new Date();
	exp.setTime(exp.getTime()+hours*3600*1000);
	document.cookie=key+"="+value+";expires="+exp.toGMTString();
}

// get cookie
function getCookie(key){
	var pairs=document.cookie.split("; ");
	var n=pairs.length;
	for(var i=0;i<n;i++){
		var tuple=pairs[i].split("=");
		if(tuple[0]==key){
			return decodeURI(tuple[1]);
		}
	}
	return null;
}

// delete cookie
function delCookie(key){
	var value=getCookie(key);
	if(value!=null){
		var exp=new Date();
		exp.setTime(exp.getTime()-1);
		document.cookie=key+"="+escape(value)+";expires="+exp.toUTCString();
	}
}

// delete all the cookies
function cleanCookie(){
	var pairs=document.cookie.split("; ");
	var n=pairs.length;
	for(var i=0;i<n;i++){
		var tuple=pairs[i].split("=");
		delCookie(tuple[0]);
	}
}
