/**
 * js 公共函数库
 */

 //需要保存的cookies常量
user_cookie = ['birthday', 'email','face_img', 'id', 'loving', 'nickname','register_time', 'username']


/**
 * 设置关于user的 cookies 
 * @param {*} user  obj
 */
 function C_set_user_cookies(user){
    console.log(user);
    if(!$.isEmptyObject(user)){

        Object.keys(user).forEach(function(key){

            // $.cookie()
            $.cookie(key, user[key],  {path:'/'}, { expires : 5 })
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
            $.cookie(user_cookie[i], new_value,  {path:'/'}, { expires : 5 })
        }
    }

 }
