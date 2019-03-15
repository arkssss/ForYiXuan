(function ($) {

    "use strict";

    /* ==========================================================================
                            check document is ready, then
   ========================================================================== */
   var date_one = {
    year: 2018,
    month: 10,
    day: 25
    }

    var date_two = {
        year: 2019,
        month: 6,
        day: 24
    }

    var date_three = {
        year: 2018,
        month: 11,
        day: 14
    }

    $(document).ready(function () {
        
        var $defaulteCounter = $("#counter");
        var $defaulteCounter2 = $("#counter2");
        var $defaulteCounter3 = $("#counter3");
        // console.log($defaulteCounter);

        if ($defaulteCounter.length) {
            //enter the last menstrual period date using the date format  year, month, day
            $defaulteCounter.tictic({
                date: date_one,
                charts: {
                    disableAnimation: false
                }
            });
        }

        if ($defaulteCounter2.length) {
            //enter the last menstrual period date using the date format  year, month, day
            $defaulteCounter2.tictic({
                date: date_two,
                charts: {
                    disableAnimation: false
                }
            });
        }


        if ($defaulteCounter3.length) {
            //enter the last menstrual period date using the date format  year, month, day
            $defaulteCounter3.tictic({
                date: date_three,
                charts: {
                    disableAnimation: false
                }
            });
        }

    });

    /**
     * 当前时间
     */
    var today = new Date();
    //设置时间
    $("#totle_conter1").html(DateDifference(Date_to_string(today),my_date_to_string(date_one)))
    $("#totle_conter2").html(DateDifference(Date_to_string(today),my_date_to_string(date_two)))
    $("#totle_conter3").html(DateDifference(Date_to_string(today),my_date_to_string(date_three)))

    // alert(DateDifference("2018-10-25" , today_string))

})(window.jQuery);

/**
 * 自己的date格式转字符串
 */
function my_date_to_string(my_date){

    return my_date.year.toString() + "-" + my_date.month.toString() + "-" + my_date.day.toString()
}

/**
 * 
 * @param {*} date 时间格式
 * return "2018-10-25"
 */
function Date_to_string(date){

    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();

    return year.toString() + "-" + month.toString() + "-" + day.toString()

}


/**
 * 返回两个日期之间的时间差
 * @param {*} Date1  string
 * @param {*} Date2  string 
 */
function DateDifference(Date1,Date2) { //Date1和Date2是2017-07-10格式  
    var newDate1, newDate2, Days
    aDate = Date1.split("-");
    //newDate1 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]); //转换为07-10-2017格式  
    newDate1 = new Date(Date1.replace(/-/g, "/")); //兼容safair
    aDate = Date2.split("-");
    //newDate2 = new Date(aDate[1] + '-' + aDate[2] + '-' + aDate[0]);
    newDate2 = new Date(Date2.replace(/-/g, "/"));
    Days = parseInt(Math.abs(newDate1 - newDate2) / 1000 / 60 / 60 / 24); //把差的毫秒数转换为天数  
    return Days;
}