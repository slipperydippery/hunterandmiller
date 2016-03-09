$(function() {

    console.log('1');
    var player = $('iframe.vimeo');
    console.log(player);
    var playerOrigin = '*';
    var status = $('.status');

    // Listen for messages from the player
    if (window.addEventListener) {
    	console.log('window.addEventListener triggered');
        window.addEventListener('message', onMessageReceived, false);
        console.log('window.addEventListener completed');
    }
    else {
    	console.log('addEventListener-else; atach event');
        window.attachEvent('onmessage', onMessageReceived, false);
    }

    // Handle messages received from the player
    function onMessageReceived(event) {
    	console.log('OMR- started with event: ');
        console.log(event);
        // Handle messages from the vimeo player only
        if (!(/^https?:\/\/player.vimeo.com/).test(event.origin)) {
        	console.log('OMR-false origin!!');
            return false;
        }

        if (playerOrigin === '*') {
        	console.log ('OMR-player origin === *, becomes ' + event.origin);
            playerOrigin = event.origin;
        }

        var data = JSON.parse(event.data);
        console.log('OMR-data parse to JSON: ' + data);

        switch (data.event) {
            case 'ready':
                onReady();
                break;

            case 'playProgress':
                onPlayProgress(data.data);
                break;

            case 'pause':
                onPause();
                break;

            case 'finish':
                onFinish();
                break;
        }
    }

    // Call the API when a button is pressed
    $('button').on('click', function() {
        post($(this).text().toLowerCase());
    });

    $('.playclick').on('click', function(){
    	console.log('play');
        $('.vim-overlay').css("left", -10000);
        $('.vim-overlay').css("opacity", 0);
        post('play');
    });   

    $('.replayclick').on('click', function(){
    	console.log('replay');
        $('.vim-overlay').css("left", -10000).delay(2000);
        $('.vim-overlay').css("opacity", 0);
        post('unload');
        setTimeout("post('play')", 200);
        
    });        

    $('img.play').on('click', function(){
    	console.log('play');
        $('.vim-overlay').css("left", -10000);
        $('.vim-overlay').css("opacity", 0);
        post('play');
    });

    $('img.pause').on('click', function(){
        post('pause');
    });

    $('.vim-post-controls--replay').on('click', function(){
        $('.vim-overlay').css("left", -10000);
        $('.vim-overlay').css("opacity", 0);
        $('.vim-post-controls--play').css("left", 0);
        post('play');
    });

    $('.vim-overlay').on('click', function () {
        // post('play');
    });

    // Helper function for sending a message to the player
    function post(action, value) {
    	console.log('post function. action: ' + action + ', value: ' + value );
        var data = {
            method: action
        };

        if (value) {
            data.value = value;
        }

        var message = JSON.stringify(data);
        player[0].contentWindow.postMessage(data, playerOrigin);
    }

    function onReady() {
        console.log('ready -onReady() ');
        post('addEventListener', 'pause');
        post('addEventListener', 'finish');
        post('addEventListener', 'playProgress');
        if (current_visited == false)
        {
        	console.log('ready to play - current_visited == false');
            post('play');   
            console.log('should be playing')
        }
    }

    function onPause() {
        $('.play').css("left", 0);
        $('.pause').css("left", -10000);
        $('.vim-preplay').css("left", -10000);
        $('.vim-overlay').css("left", 0);
        $('.vim-overlay').css("opacity", 1);
        status.text('paused');
    }

    function onFinish() {
        status.text('finished');
    }

    function onPlayProgress(data) {
        $('.vim-playpause').css("bottom", "0px");
        $('.vim-noblack').css("left", 10000);
        $('.play').css("left", -10000);
        $('.pause').css("left", 0);
        if(data.seconds > (data.duration - 1)) {
        //if(data.seconds > 3) {
            $('.vim-overlay').css("left", 0);
            $('.vim-overlay').css("opacity", 1);
            $('.vim-playpause').css("left", -10000);
            $('.vim-preplay').css("left", -10000);
            $('.vim-post-controls--play').css("left", -10000);
            post('pause');
            post('unload');
        }
        status.text(data.seconds + 's played');
    }
});
