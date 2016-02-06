
/*
 * post - 向服务器@dst发送post请求
 *
 * @dst: 服务器地址
 * @msg: 请求消息
 * @func: 成功返回时的回调函数
 */
function post(dst, msg, func) {
	var request = new XMLHttpRequest();
	request.open("POST", dst);
	request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	request.onreadystatechange = function() {
		if (request.readyState === 4 && request.status === 200) {
            func(request);
        }
    }
    request.send(msg);
}

/*
 * create_URL - 创建URL
 *
 * @page: 入口网页
 * @module: 调用模块
 * @func: 调用函数
 * @params: 函数的参数列表，顺序无关，object
 */
function create_URL(page, module, func, params) {
    var url = page + "?module=" + module + "&func=" + func;
    if (null != params) {
        for (var field in params) {
            url += "&" + field + "=" + params[field];
        }
    }
    return url;
}

