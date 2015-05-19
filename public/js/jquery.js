var dur = 0;
var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;

$(function(){

	resize();
	dur = 250;

	$('.pagination a').click(function(e) {

		e.preventDefault();
		var url = $(this).attr('href');
		var container = $(this).parents('.section');

		$.ajax({
			type: 'GET',
			url: url,
			data: $('form').serialize(),
			success: function(response) {
				$(container).html(response.html);
				resize();
			}		
		});

	});


	$(document).on('focus', "input.datepicker", function(){
		$(this).datepicker({
			dateFormat: 'yy-mm-dd',
			showAnim: 'slideDown'
		});
	});

	$(document).on('focus', "input.datetimepicker", function(){

		$(this).datetimepicker({
			dateFormat: 'yy-mm-dd',
			showAnim: 'slideDown',
			stepMinute: 5
		});
	});

	$(document).on('focus', 'input.timepicker', function() {
		$(this).timepicker({
			showAnim: 'slideDown',
			stepMinute: 5
		});
	});


	$(document).on('focus', 'input.autocomplete', function() {
                $(this).autocomplete({
                        open: function(event, ui) {
                                if (supportsTouch) {
                                        $('.ui-autocomplete').off('menufocus hover mouseover mouseenter');
                                }
                        },
                        source: $(this).attr('data-complete-url'),
                        minLength: 2,
                        select: function(event, ui) {
                                var id = ui.item.id;
                                $(this).next('input.autocomplete-value').val(id);
                        }
                });
        });


	$(document).on('keyup', 'input.team-filter', function() {
		var search = $(this).val().toLowerCase();
		$('div.team-name').each(function() {
			var team_name = $(this).attr('data-team-name').toLowerCase();;
			if (team_name.indexOf(search) == -1) {
				$(this).addClass('hidden');
			} else {
				$(this).removeClass('hidden');
			}
		});
	});

	$('div.league-teams').droppable({
		drop:function(event, ui) {
			var team_id = ui.draggable.find('input.team-value').val();
			ui.draggable.detach().appendTo($(this));
			//ui.draggable.detach().appendTo($(this)).find('input.team-value').attr('name', 'league_teams[' + $(this).attr('data-league-id') + '][]');
			refreshOrder($(this), $(this).attr('data-league-id'));
		}
	});

	$('div.team-name').draggable({
		revert: "invalid",
		helper: "clone",
		containment: "document",
	});

	$('div.remove-team').click(function() {
		var team = $(this).parents('div.team-name');
		$(team).detach().appendTo('div.teams-list').find('input.team-value').attr('name', null);
		sortTeams();
	});


	$('div.add-set').click(function() {
                var container = $(this).parents('div.game').find('div.game-sets');
		var set_number = $(this).parents('div.game').find('div.game-set').length + 1;

                $.ajax({
                        type: 'GET',
                        url: '/game-sets/add',
                        data: {'game_id': $(this).parents('div.game').attr('data-game-id'), 'set_number': set_number},
                        success: function(response) {
				$(container).height($(container).height());
                                $(container).append(response.html);
				$(container).animate({height: $(container).height() + 28}, 150, function() {
					$(this).css('height', 'auto');
					$(container).find('input.home-team').focus();
				});
                        }
                });
	});

	$(document).on('keydown', 'input.away-team', function(e) {
		var code = e.keyCode || e.which;
		e.preventDefault();
		//console.log(code);
                if (code == 9) {
			$(this).parents('div.game').find('div.add-set').trigger('click');
		}
	});

	$(document).on('click', 'div.remove-set', function() {
		
		if ($(this).parents('div.game-set').find('input.game-set-id').length > 0) {
			var answer = confirm('Are you sure you want to delete this item?');
                        if (answer == true) {
				$.ajax({
					type: 'GET',
					url: '/game-sets/delete',
					data: {'game_set_id': $(this).parents('div.game-set').find('input.game-set-id').val()},
					context: this,
					success: function(response) {
						$(this).parents('div.game-set').slideUp(250, function() {
							$(this).remove();
						});
					}
				});
			}
		} else {
			$(this).parents('div.game-set').slideUp(250, function() {
				$(this).remove();
			});
		}
	});


	$(document).on('click', 'div.populate', function() {

		$.ajax({
			type: 'GET',
			url: '/leagues/populate',
			data: {'season_id': $(this).attr('data-season-id'), 'league_id': $(this).attr('data-league-id')},
			context: this,
			success: function(response) {
				$.each(response, function() {
					console.log(response);
				});
			}
		});

	});


});

function resize() {

	var container_width = $(window).width();

	if (container_width > 800) {
		//container_width = 800;
	}

	$('div#container').animate({width: container_width}, dur);

	$(".form", '#content').each(function() {

                var label_width = 0;
                $(this).find("div.label:not(.no-resize)").each(function() {

                        if ($(this).width() > label_width) {
                                label_width = $(this).outerWidth();
                        }

                });

		if (label_width > 200) {
			label_width = 200;
		}

                $(this).find("div.label:not(.no-resize)").each(function() {
			var change = $(this).width() - label_width;

			if (change > 15 || change < -15 || dur == 0) {
				$(this).animate({width: (label_width)}, dur);
				if (!$(this).hasClass('nowrap')) {
					$(this).css('white-space', 'normal');
				}
			}
		});



		$('div.input:not(.no-resize)').each(function() {
			var input_width = $(this).parents('div.input-block').outerWidth() - label_width - 25;
			//console.log(input_width);
			if (input_width > 400) {
				input_width = 400;
			}
			var change = $(this).width() - input_width;
			if (change > 15 || change < -15 || dur == 0) {
				$(this).stop(true).animate({width: (input_width)}, 0);
			}
		});

        });

	var objects = $('div.section, div.search-results-content, div.qtip-content', '#container');
	//$("div.section, div.search-results-content, div.qtip-content").each(function() {
	for ( var i=0; i < objects.length; i++) {
		$(objects[i]).find('div.row:odd').addClass('odd');
		$(objects[i]).find('div.row:even').addClass('even');

		resizeWidth($(objects[i]).find("div.column[data-column='1']"));
		resizeWidth($(objects[i]).find("div.column[data-column='2']"));
		resizeWidth($(objects[i]).find("div.column[data-column='3']"));
		resizeWidth($(objects[i]).find("div.column[data-column='4']"));
	}

	return false;

}

function resizeWidth(objects) {
	var col_width = 0;
	for ( var i=0; i < objects.length; i++) {
		if (($(objects[i]).width() + 5) > col_width) {
			col_width = ($(objects[i]).width() + 5);
		}
	}
	$(objects).width(col_width);
	//return false;
}

function refreshOrder(container, league_id) {
	var count = 1;
	
	$(container).find('input.team-value').each(function() {
		$(this).attr('name', 'league_teams[' + league_id + '][' + count + ']');
		count ++;
	});


}

function sortTeams() {
	var teams = $('div.teams-list').children('div.team-name');
	var sorted = $(teams).sort(function(a,b){
		var an = a.getAttribute('data-team-name'),
		bn = b.getAttribute('data-team-name');

		if(an > bn) {
			return 1;
		}
		if(an < bn) {
			return -1;
		}
		return 0;
	});

	$(teams).detach();
	$('div.teams-list').append($(sorted));
}
