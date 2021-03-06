﻿(function(n) {
    n.fn.tictic = function(t) {
        var s = this, r = [], u = [], f, e, o, h = !1, i = n.extend(!0, {}, {
            //缺省默认
            totalWeeks: 40,
            date: {
                year: 2014,
                month: 4,
                day: 29
            },
            charts: {
                disableAnimation: !1,
                darkerColor: "#F57E9F",
                lighterColor: "#FFC1D4",
                size: 200,
                bigchart: {
                    scaleColor: !1,
                    lineCap: "square",
                    lineWidth: 10
                },
                smallchart: {
                    scaleColor: !1,
                    lineCap: "square",
                    lineWidth: 3
                }
            },
            heart: {
                src: "js/heart.png"
            }
        }, t), c = function() {
            var a = new Date, t = new Date(i.date.year,i.date.month - 1,i.date.day,0,0,0,0), o, f, c, l, v, e;
            t.setDate(t.getDate() - 1);
            o = new Date(i.date.year,i.date.month - 1,i.date.day,0,0,0,0);
            o.setDate(t.getDate() + i.totalWeeks * 7);
            var n = a.getTime() - t.getTime()
              , y = o.getTime() - a.getTime()
              , p = Math.floor(y / 864e5)
              , s = Math.floor(n / 6048e5);
            if (n -= s * 6048e5,
            f = Math.floor(n / 864e5),
            n -= f * 864e5,
            c = Math.floor(n / 36e5),
            n -= c * 36e5,
            l = Math.floor(n / 6e4),
            n -= l * 6e4,
            v = Math.floor(n / 1e3),
            r[0].update(Math.floor(s * 100 / i.totalWeeks)),
            u[0].text(s),
            r[1].update(Math.floor(f * 100 / 7)),
            u[1].text(f),
            r[2].update(Math.floor(c * 100 / 24)),
            r[3].update(Math.floor(l * 100 / 60)),
            r[4].update(Math.floor(v * 100 / 60)),
            u[2].text(""),
            !h) {
                if (i.charts.disableAnimation)
                    for (e = 0; e < 5; e++)
                        r[e].disableAnimation();
                h = !0
            }
        }, l = function() {
            var n = .66 * i.heart.size
              , t = .83 * i.heart.size
              , r = (i.heart.size - n) / 2
              , u = (i.heart.size - t) / 2;
            f.animate({
                width: n,
                fontSize: n - 4,
                top: i.heart.top + r,
                left: i.heart.left + r
            }, 450, function() {
                f.animate({
                    width: i.heart.size,
                    fontSize: i.heart.size - 4,
                    top: i.heart.top,
                    left: i.heart.left
                }, 100, function() {
                    f.animate({
                        width: t,
                        fontSize: t - 4,
                        top: i.heart.top + u,
                        left: i.heart.left + u
                    }, 70, function() {
                        f.animate({
                            width: i.heart.size,
                            fontSize: i.heart.size - 4,
                            top: i.heart.top,
                            left: i.heart.left
                        }, 70, function() {
                            l()
                        })
                    })
                })
            })
        }, a = function() {
            var a, h, v, t;
            for (i.charts.bigchart.barColor = i.charts.darkerColor,
            i.charts.bigchart.size = i.charts.size,
            i.charts.smallchart.barColor = i.charts.lighterColor,
            t = 0; t < 5; t++)
                r[t] = n('<span class="chart-' + t + '"><\/span>');
            for (t = 0; t < 5; t++)
                a = n('<div class="chart-set"><\/div>'),
                h = n('<div class="chart"><\/div>'),
                h.css({
                    top: "0",
                    left: "0"
                }),
                h.append(r[t]),
                a.append(h),
                r[t].easyPieChart(i.charts.bigchart),
                t < 2 && (u[t] = n('<div class="chart-title"><\/div>'),
                u[t].css({
                    color: i.charts.smallchart.barColor
                }),
                a.append(u[t]),
                e = Math.floor(i.charts.bigchart.size * .1),
                o = Math.floor(i.charts.bigchart.size * .3),
                u[t].css({
                    "padding-top": Math.floor((i.charts.bigchart.size - o - e) / 2),
                    "font-size": e,
                    color: i.charts.smallchart.barColor
                }),
                u[t].append("<span>" + (t === 0 ? "weeks" : "days") + "<\/span>"),
                v = n('<span class="count">0<\/span>'),
                u[t].prepend(v),
                u[t] = v,
                u[t].css({
                    "font-size": o,
                    color: i.charts.bigchart.barColor
                })),
                t !== 0 && (t++,
                h = n('<div class="chart"><\/div>'),
                h.css({
                    top: i.charts.bigchart.lineWidth + i.charts.smallchart.lineWidth + "px",
                    left: i.charts.bigchart.lineWidth + i.charts.smallchart.lineWidth + "px"
                }),
                h.append(r[t]),
                a.append(h),
                i.charts.smallchart.size = i.charts.bigchart.size - (i.charts.bigchart.lineWidth * 2 + i.charts.smallchart.lineWidth * 2),
                r[t].easyPieChart(i.charts.smallchart)),
                t === 4 && (f = n('<i class="baby-heart fa fa-heart"><\/i>'),
                i.heart.size = Math.floor(i.charts.bigchart.size * .5),
                i.heart.top = i.heart.left = Math.floor((i.charts.bigchart.size - i.heart.size) / 2),
                f.css({
                    width: i.heart.size,
                    "font-size": i.heart.size - 4,
                    top: i.heart.top,
                    left: i.heart.left,
                    color: i.charts.bigchart.barColor,
                    "text-align": "center"
                }),
                a.append(f),
                l()),
                a.css({
                    width: i.charts.bigchart.size,
                    height: i.charts.bigchart.size
                }),
                s.append(a);
            for (u[2] = n('<div class="chart-summary"><\/div>').css({
                clear: "both",
                color: i.charts.darkerColor,
                "font-size": e,
                "text-align": "center"
            }),
            s.append(u[2]),
            t = 0; t < 5; t++)
                r[t] = r[t].data("easyPieChart");
            c();
            setInterval(c, 1e3)
        };
        a()
    }
}
)(jQuery);
