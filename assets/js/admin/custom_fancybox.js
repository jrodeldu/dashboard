$(document).ready(function() {
            $("a[rel=fancyimg]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over" style="display: block;">Imagen ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + 
                    '<span style="display: block; text-align: right;"><img src="http://www.ugtcanariasformacion.com/css/_design/images/ico/gob_can_small.png" /><img src="http://www.ugtcanariasformacion.com/css/_design/images/ico/gob_esp_small.png" /><img src="http://www.ugtcanariasformacion.com/css/_design/images/ico/ugt_small.png" /><img src="http://www.ugtcanariasformacion.com/css/_design/images/ico/ue_small.png" /></span></span>';
				}
			});
});            