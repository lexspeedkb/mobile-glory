$(document).ready(function(){
	function getXMLDocument(url) {  
		var xml;  
		if(window.XMLHttpRequest){  
			xml=new window.XMLHttpRequest();  
			xml.open("GET", url, false);  
			xml.send("");  
			return xml.responseXML;  
		}else if(window.ActiveXObject) {  
			xml=new ActiveXObject("Microsoft.XMLDOM");  
			xml.async=false;  
			xml.load(url);  
			return xml;  
		}else{  
			alert("Загрузка XML не поддерживается браузером");  
			return null;  
		}  
	}
	
	// PRELOADER
	$('.preloader').fadeOut();
	
});