$(function() {
	$('#right-panel').css('left', $(window).width() - $('#right-panel').width() - 16);
	// move right-panel when you resize the window
	$(window).resize(function() {
		$('#right-panel').css('left', $(window).width() - $('#right-panel').width() - 16);
	});
	var workspaceHeight = $('#workspace').height();
	var workspaceWidth = $('#workspace').width();
	var currentDrag;

	function drag_start(event) {
		currentDrag = '#' + $(this).attr('id');
	    var style = window.getComputedStyle(event.target, null);
	    event.dataTransfer.setData("text/plain",
	    (parseInt(style.getPropertyValue("left"),10) - event.clientX) + ',' + (parseInt(style.getPropertyValue("top"),10) - event.clientY));
	}

	function drag_over(event) { 
	    event.preventDefault(); 
	    return false; 
	}

	function drop(event) { 
	    var offset = event.dataTransfer.getData("text/plain").split(',');
	    $(currentDrag).css('left', (event.clientX + parseInt(offset[0],10)) + 'px');
	    $(currentDrag).css('top', (event.clientY + parseInt(offset[1],10)) + 'px');
	    
	    //console.log(workspaceWidth);

	    if (!currentDrag) {
	    	return;
	    }

	    // if it is the panel, we check drag params based on window size
	    if (currentDrag == '#right-panel') {
	    	workspaceHeight = $(window).height();
			workspaceWidth = $(window).width();
			console.log("height: " + workspaceHeight + ", width: " + workspaceWidth);
	    }
		/* CHECK DRAG BOUNDARIES */
	    // check right bound
	    if ($(currentDrag).position().left + $(currentDrag).width() > workspaceWidth) {
	    	console.log("fix right: " + $(currentDrag).position().left + $(currentDrag).width());
	        $(currentDrag).css('left', (workspaceWidth - $(currentDrag).width()) + 'px');
	    }

	    // check left bound
	    if ($(currentDrag).position().left < 0) {
	    	console.log("fix left: " + $(currentDrag).position().left);
	        $(currentDrag).css('left', 0);
	    }

	    // check bottom bound
	    if ($(currentDrag).position().top + $(currentDrag).height() > workspaceHeight) {
	    	console.log("fix bottom: " + $(currentDrag).position().top + $(currentDrag).height());
	        $(currentDrag).css('top', (workspaceHeight - $(currentDrag).height()) + 'px');
	    }

	    // check top bound
	    if ($(currentDrag).position().top < 0) {
	    	console.log("fix top: " + $(currentDrag).position().top);
	        $(currentDrag).css('top', 0);
	        console.log(" to " + $(currentDrag).position().top);
	    }

	    //change variables back in case we switched for right panel
	    workspaceHeight = $('#workspace').height();
		workspaceWidth = $('#workspace').width();
	    event.preventDefault();
	    return false;
	}
	var rightPanel = document.getElementById('right-panel'); 
	rightPanel.addEventListener('dragstart',drag_start,false); 
	document.body.addEventListener('dragover',drag_over,false); 
	document.body.addEventListener('drop',drop,false);

	var count = 0;

	$('#add-rectangle').click(function() {
		$('#workspace').append('<div class="testgridbox ui-widget-content" id="' + count + 'testgridbox" draggable="true">'
			+ '<input class="boxtitle" id="' + count + 'boxtitle" placeholder="title">'
			+ '<textarea class="boxtext" type="text" id="'+ count + 'boxtext"></textarea></div>');
		$('#' + count + 'testgridbox').resizable();

		var dm = document.getElementById(count + 'testgridbox'); 
		dm.addEventListener('dragstart',drag_start,false); 

		$('#' + count + 'boxtitle').focus();

		count++;
	});


	$('#add-list').click(function() {
		/*
    	var numLines = $('#list-length').val();
    	var listhtml = '<ul id="' + count + 'boxlist">';
    	var boxlisttextcount = 0;
    	for (var i = 0; i < numLines; i++) {
    		listhtml +='<li class="boxlist-li"><input class="boxlist-input" id="' + boxlisttextcount + 'boxlisttext"></li>';
    		boxlisttextcount++;
    	}
    	listhtml += '</ul>';
		*/
    	$('#workspace').append('<div class="testgridbox ui-widget-content" id="' + count + 'testgridbox" draggable="true">'
			+ '<input class="boxlisttitle" id="' + count + 'boxlisttitle" placeholder="title">'
			+ '<ul id="' + count + 'boxlist">'
			+ '<li class="boxlist-li"><input class="boxlist-input"></li>'
			+ '</ul></div>');

    	$('#' + count + 'testgridbox').resizable();

    	$('.boxlist-input').keyup(function(e) {
    		// ENTER key
	  		if (e.which == 13) {
	  			$(this).parent().parent().append('<li class="boxlist-li"><input class="boxlist-input"></li>');
	  		}
	  		// DELETE or BACKSPACE key
	  		else if (e.which == 8 || e.which == 46) {
	  			if (!$(this).val()) {
	  				$(this).parent().next().find(">:first-child").focus();
	  				$(this).parent().remove();
	  			}
	  		}
	  		// UP key 
	  		else if (e.which == 38) {
	  			$(this).parent().prev().find(">:first-child").focus();
	  		}
	  		// DOWN key
	  		else if (e.which == 40) {
	  			$(this).parent().next().find(">:first-child").focus();
	  		}
	  	});

    	var dm = document.getElementById(count + 'testgridbox'); 
		dm.addEventListener('dragstart',drag_start,false); 

    	$('#' + count + 'boxlisttitle').focus();
    	count++;
  	});


  	$('#add-month').click(function() {

  	});

 	$('#delete-selected').click(function() {
  		$( ".box-selected" ).remove();
 	});

	$('#save-button').click(function() {

	});

});