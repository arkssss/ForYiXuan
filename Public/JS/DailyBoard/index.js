// 编辑框初始js 
$(document).ready(function(){
    var E = window.wangEditor
    var editor = new E('#editor')
    // 或者 var editor = new E( document.getElementById('editor') )
    // editor.customConfig.uploadImgShowBase64 = false   // 使用 base64 保存图片
    editor.customConfig.uploadImgServer = '{:U("DailyBoard/upload")}';  // 上传图片到服务器 上传tab
    editor.customConfig.uploadFileName = 'myFileName';
    editor.customConfig.debug = true; //是否开启Debug 默认为false 建议开启 可以看到错
    
    //表格的菜单定义
    editor.customConfig.menus = [
        'head',  // 标题
        'bold',  // 粗体
        'fontSize',  // 字号
        //'fontName',  // 字体
        //'italic',  // 斜体
        'underline',  // 下划线
        //'strikeThrough',  // 删除线
        'foreColor',  // 文字颜色
        'backColor',  // 背景颜色
        //'link',  // 插入链接
        'list',  // 列表
        //'justify',  // 对齐方式
        //'quote',  // 引用
        'emoticon',  // 表情
        'image',  // 插入图片
        'table',  // 表格
        'video',  // 插入视频
        //'code',  // 插入代码
        // 'undo',  // 撤销
        // 'redo'  // 重复
    ]

    //回掉函数
    editor.customConfig.uploadImgHooks = {
        before : function(xhr, editor, files) {
            
        },
        //成功的回掉函数
        success : function(xhr, editor, result) {
            // 图片url == result['data'][0]
            console.log(result);
        },
        fail : function(xhr, editor, result) {
            console.log("上传失败,原因是"+result);
        },
        error : function(xhr, editor) {
            console.log("上传出错");
        },
        timeout : function(xhr, editor) {
            console.log("上传超时");
        }
    }

    editor.create()
    
})
    



