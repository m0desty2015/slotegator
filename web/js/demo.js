var elementsCount = $("div.roulette img").length;
var result = 0;
function randomInteger(min, max) {
    var rand = min - 0.5 + Math.random() * (max - min + 1)
    rand = Math.round(rand);
    var type = $('img[number='+rand+']').attr('typePrize');
    var limitCount = 0;
    if (type != 'bonus') {
        $.ajax({
            type: "POST",
            url: '/site/calculate-limits',
            dataType: "html",
            async: false,
            data: {type: type},
            cache: false,
            error: function () {
                console.log("Error loading");
            },
            success: function (limit) {
                limitCount = limit;
            }
        });
    }
    if (type == 'bonus' || limitCount > 0) {
        console.log(type + ' = ' + limitCount);
        console.log('Номер изображения = ' + rand);
        return rand;
    } else {
        randomInteger(min, max);
    }
}

$(function(){

	$('.roulette').find('img').hover(function(){
		console.log($(this).height());
	});

	var p = {
		startCallback : function() {
			$('.start').attr('disabled', 'true');
			$('.stop').removeAttr('disabled');
		},
		slowDownCallback : function() {
			$('.stop').attr('disabled', 'true');
		},
		stopCallback : function($stopElm) {
            $.ajax({
                type: "POST",
                url: '/site/result-page',
                dataType: "html",
                async: false,
                data: {type: $('img[number='+result+']').attr('typePrize'), image: $('img[number='+result+']').attr('src')},
                cache: false,
                error: function () {
                    console.log("Error loading");
                },
                success: function (resultHtml) {
                    if (resultHtml!='') {
                        $('#result').html(resultHtml);
                    } else {
                        console.log("Error loading");
                    }
                }
            });
            $('.start').removeAttr('disabled');
			$('.stop').attr('disabled', 'true');
		}

	}
    var updateParamater = function(){
        p['stopImageNumber'] = Number(randomInteger(0, (elementsCount-1)));
        result = p['stopImageNumber'];
        rouletter.roulette('option', p);
    }
	var rouletter = $('div.roulette');
	rouletter.roulette(p);	
	$('.stop').click(function(){
		rouletter.roulette('stop');
        updateParamater();
	});
	$('.stop').attr('disabled', 'true');
    $('.start').click(function(){
        rouletter.roulette('start');
        updateParamater();
    });

    $(document).on('click', '.refuze', function(){
        location.reload();
    });

    $(document).on('click', '.got', function(){
        location.href=$('.got').attr('url');
    });

    $(document).on('click', '.convert,.out,.go', function(){
        location.href=$(this).attr('url');
    });


});