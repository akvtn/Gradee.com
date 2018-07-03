$(document).ready(function() {
    $("#login").click(function(e) {
        e.preventDefault();
        deleteErrors(["login-username","login-password"]);
        AJAXHelper.post("../administration/log.php",$("#logIn-form").serialize(),function(data) {
            if(data.target.response){
                raiseError(LogErrors[data.target.response][0],{"LogError":LogErrors[data.target.response][1]});
            }else {
                window.location.replace("http://gradee.com/");
            }
        })
    })
});

var LogErrors = {
    1: ["login-username","Unregistered user"],
    2: ["login-username","Banned user"],
    3: ["login-password","Wrong password"]
}

function raiseError(field,messages) {
    if(messages && typeof messages === 'object'){
        Object.keys(messages).map(function(key) {
            document.getElementById(key).innerHTML = messages[key];
        });
    }
    var obj = document.getElementById(field);
    obj.style.border = "2px dashed red";
}

function deleteErrors(fields,textsFields) {
    if(fields){
        for (var field of fields) {
            var obj = document.getElementById(field);
            obj.style.border = "2px solid silver";
        }
    }
    if(textsFields){
        for (var item of textsFields) {
            document.getElementById(item).innerHTML = "";
        }
    }
}

function newElement(name, style, attr, text){
    var elem = document.createElement(name);
    if (style && typeof(style) === 'object') {
        Object.keys(style).map(function(key){
            elem.style[key] = style[key];
        });
    }
    if (attr && typeof(attr) === 'object') {
        Object.keys(attr).map(function(key){
            elem.setAttribute(key,attr[key]);
        });
    }
    if (text && typeof text === 'string'){
        elem.innerHTML = text;
    }
    return elem;
}

function AJAXpost(url,data,succes) {
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    xhr.open('POST', url);
    xhr.onreadystatechange = function() {
        if(xhr.readyState > 3 && xhr.status == 200)
            if (success) success(xhr.responseText);
    }
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    var params = typeof data == 'string' ? data : Object.keys(data).map(function(i){
        return encodeURIComponent(i) + '=' + encodeURIComponent(data[i]);
    }).join('&');
    xhr.send(params);
    return xhr;
}

function AJAXget(url, success){
    var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    xhr.open('GET', url);
    xhr.onreadystatechange = function() {
        if(xhr.readyState > 3 && xhr.status == 200)
            if (success) success(xhr.responseText);
    }
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhr.send();
    return xhr;
}

var AJAXHelper = {
	get: function(url, success, error, progress, end, start){
		return this.ajax(url, 'get', null, success, error, progress, end, start);
	},
	post: function(url, data, success, error, progress, end, start){
		return this.ajax(url, 'post', data, success, error, progress, end, start);
	},
	ajax: function(url, method, data, success, error, progress, end, start) {
		if (!url || typeof url !== 'string') {
			console.error('AJAX: URL not specified');
	        return null;
		}

		const allowedMethods = ['get', 'post'];
		if (method || typeof method == 'string') {
			method = method.toLowerCase();
			if (allowedMethods.indexOf(method) == -1) {
				console.error("AJAX: Unknown method '" + method + "'");
				return null;
			}
		}else {
			console.error('AJAX: Method not specified');
			return null;
		}

		var xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		if (data) {
			var params = typeof data == 'string' ? data : Object.keys(data).map(function(i){
				return encodeURIComponent(i) + '=' + encodeURIComponent(data[i]);
			}).join('&');
		}
		if (method == 'get')
			url = url + (url.includes('?') ? '&' : '?') + params;
		xhr.open(method, url);

		xhr.addEventListener('loadstart', start);
		xhr.addEventListener('load', success);
		xhr.addEventListener('error', error);
		xhr.addEventListener('progress', progress);
		xhr.addEventListener('loadend', end);

		xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		switch (method){
		case 'get':
			xhr.send();
			break;
		case 'post':
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.send(params);
			break;
		}
		return xhr;
	}
}
