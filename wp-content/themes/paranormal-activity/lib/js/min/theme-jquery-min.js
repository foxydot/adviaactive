jQuery(document).ready(function($){$("*:first-child").addClass("first-child"),$("*:last-child").addClass("last-child"),$("*:nth-child(even)").addClass("even"),$("*:nth-child(odd)").addClass("odd");var t=$("#footer-widgets div.widget").length;$("#footer-widgets").addClass("cols-"+t),$(".entry-header").each(function(){var t=$(this).find(".entry-title"),l=$(this).find(".entry-subtitle");t.width()<=l.width()?t.css("border-bottom","0").css("padding-bottom","0").css("margin-bottom","0"):l.css("border-top","0").css("padding-top","0").css("margin-top","0")}),$(".team-info .more-button").click(function(){var t=$(this),l=t.prev("p");l.slideToggle("slow",function(){console.log(t.html()),t.html("More &gt;"===t.html()?"Less &gt;":"More &gt;")})}),$(".gform_wrapper .left").wrapAll('<li class="col-md-4 col-sm-12"><ul></ul></li>'),$(".gform_wrapper .right").wrapAll('<li class="col-md-8 col-sm-12"><ul></ul></li>'),$(".gform_wrapper .gform_footer").addClass("col-md-8 col-md-offset-4 col-sm-12")});