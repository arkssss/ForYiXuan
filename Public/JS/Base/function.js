/**
 * js 公共函数库
 */

 //需要保存的cookies常量
user_cookie = ['birthday', 'email','face_img', 'id', 'loving', 'nickname','register_time', 'username','up_down']


/**
 * 设置关于user的 cookies 
 * @param {*} user  obj
 */
 function C_set_user_cookies(user){
    console.log(user);
    if(!$.isEmptyObject(user)){

        Object.keys(user).forEach(function(key){

            // $.cookie() 默认的cookie 是浏览器关闭之后就立即清除, 是因为调用的格式不对
            $.cookie(key, user[key],  {expires : 5, path:'/'})
       });
    
    }
 }

 /**
  * 更新关于user 的cookies
  */
 function C_update_user_cookies(update_user){

    if(!$.isEmptyObject(update_user)){

        var len = user_cookie.length;
        for(var i = 0; i < len ; i++){
            var new_value;
            new_value = update_user[user_cookie[i]] ? update_user[user_cookie[i]] : $.cookie(user_cookie[i]);
            $.cookie(user_cookie[i], new_value,  {expires : 5, path:'/'})
        }
    }

 }

 /**
  * 删除关于用户的cookie
  */
 function C_remove_user_cookies(){
        var len = user_cookie.length;
        for(var i = 0; i < len ; i++){
            // 如果作用域为全局, 则删除的时候需要在后面加路径
            $.removeCookie(user_cookie[i], { path: '/' });
        }
 }