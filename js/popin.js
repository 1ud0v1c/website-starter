// Options :
//  => opacité
// 	=> scrollbar
//	=> loader
//	=> redimensionnement
//	=> gestion de la touche echap

$(document).ready(function() {
	lightbox.init({
        "scroll" : "disable",
        "opacity" : 0.2,
		"loader_path" : "url('img/loader2.gif')"
    });
});

lightbox = {
	init : function(options) {
		var defauts = {
            "scroll" : "active",
            "escape" : "active",
            "opacity" : 0.7,
            "loader_path" : "url('img/loader.gif')"
        };
        lightbox.p = $.extend(defauts, options);

		lightbox.opacity = lightbox.p.opacity;
		lightbox.duree = 1000;

		$("[rel='lightbox']").click(function(){
			lightbox.link = $(this).attr("href");
			lightbox.open(lightbox.link);
			return false;
		});

		$(window).resize(lightbox.redim());
	},

	open : function(link) {
		lightbox.link = link;
		$("body").append("<div id='lightbox'><div id='lightbox_voile'></div><div id='lightbox_loader'></div><div id='lightbox_content'><div id='lightbox_close'></div></div></div>");
		$("#lightbox_content").hide();
		$("#lightbox_loader").hide().fadeIn();
		$("#lightbox_voile").css("opacity",0).fadeTo(500,lightbox.opacity);
		$("#lightbox_loader").css("background", lightbox.p.loader_path+" center center no-repeat");

		lightbox.img = new Image();
		lightbox.img.src = lightbox.link;
		lightbox.timer = window.setInterval(lightbox.load,100);

		if(lightbox.p.scroll == "disable") {
			var height = document.documentElement.scrollTop;
			if(height == 0) {
				height = window.pageYOffset;
			}
			$('body').addClass('noscroll').css('margin-top', -height + 'px');
			if ($(document).height() > $(window).height()) {
			    var scrollTop = ($('html').scrollTop()) ? $('html').scrollTop() : $('body').scrollTop();
			    $('html').addClass('noscroll').css('top',-scrollTop);
			}
		}

		$("#lightbox_close").click(function() {
			lightbox.close();
		});

		$("#lightbox_voile").click(function() {
			lightbox.close();
		});

		if(lightbox.p.escape == "active") {
			$(document).keyup(function(e) {
				if (e.keyCode == 27) {
					lightbox.close();
				}
			});
		}
	},

	load: function() {
		if(lightbox.img.complete) {
			window.clearInterval(lightbox.timer);
			lightbox.anim();
		}
	},

	anim: function() {
		$("#lightbox_content").show();
		lightbox.width = lightbox.img.width;
		lightbox.height = lightbox.img.height;

		lightbox.redim();

		$("#lightbox_loader").fadeOut();
		$("#lightbox_content").append("<img src="+lightbox.link+" alt='' />");
		$("#lightbox_content img").hide();
		$("#lightbox_close").hide();
		$("#lightbox_content").animate({width: lightbox.width},lightbox.duree/2).animate({height: lightbox.height},lightbox.duree/2,"linear",function(){
			$("#lightbox_close").fadeIn();
			$("#lightbox_content img").fadeIn();
		});
	},

	close: function() {
		if(lightbox.p.scroll == "disable") {
			var scrollTop = parseInt($('html').css('top'));
			console.log($('html').css('top'));
			$('body').removeClass('noscroll');
			$('html,body').scrollTop(-scrollTop);
		}
		$("#lightbox").fadeOut(500,function() {
			$("#lightbox").remove();
		});
	},

	windowHeight: function() {
		return $(window).height();
	},

	windowWidth: function() {
		return $(window).width();
	},

	redim: function() {
		$("#lightbox_content").css("left",(lightbox.windowWidth()-lightbox.width)/2+"px");
		$("#lightbox_content").css("top",((lightbox.windowHeight()-lightbox.height))/2+"px");
	}
}
