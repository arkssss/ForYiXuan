(function ($) {

    "use strict";

    /* ==========================================================================
                            check document is ready, then
   ========================================================================== */

    $(document).ready(function () {

        var $defaulteCounter = $(".counter");
        var $defaulteCounter2 = $(".counter2");
        var $defaulteCounter3 = $(".counter3");
        console.log($defaulteCounter);

        if ($defaulteCounter.length) {
            //enter the last menstrual period date using the date format  year, month, day
            $defaulteCounter.tictic({
                date: {
                    year: 2018,
                    month: 10,
                    day: 25
                },
                charts: {
                    disableAnimation: false
                }
            });
        }

        if ($defaulteCounter2.length) {
            //enter the last menstrual period date using the date format  year, month, day
            $defaulteCounter2.tictic({
                date: {
                    year: 2019,
                    month: 6,
                    day: 30
                },
                charts: {
                    disableAnimation: false
                }
            });
        }


        if ($defaulteCounter3.length) {
            //enter the last menstrual period date using the date format  year, month, day
            $defaulteCounter3.tictic({
                date: {
                    year: 2018,
                    month: 11,
                    day: 14
                },
                charts: {
                    disableAnimation: false
                }
            });
        }

    });

})(window.jQuery);

