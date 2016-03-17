$(function() {
    console.log('---start---')
    var player = $('iframe.vimeo');

    // document.getElementById("vimeoiframe").onload = function() {
      console.log("#vimeoiframe is loaded");
        console.log(player);
        console.log(player[0].contentWindow);
        var playerOrigin = '*';
        var status = $('.status');


        // Listen for messages from the player
        console.log('hello, this is your msie version if applicable: ' + detectIE());
        var vimeoapp = document.getElementById("vimeoapp");
        if (window.addEventListener) {
            window.addEventListener('message', onMessageReceived, false);
            console.log('window.addEventListener onMessageReceived(event) ');
        }
        else {
        	console.log('addEventListener-else; atach event');                   //IE < 9
            window.attachEvent('onmessage', onMessageReceived, false);
        }
    // };


    // Handle messages received from the player
    function onMessageReceived(event) {
        console.log('OMR onMessageReceived');
    	console.log('OMR- started with event: ');
        console.log(event);
        // Handle messages from the vimeo player only
        // if (!(/^https?:\/\/player.vimeo.com/).test(event.origin)) {
        // 	console.log('OMR-false origin!!');
        //     return false;
        // }

        if (playerOrigin === '*') {
        	console.log ('OMR-player origin === *, becomes ' + event.origin);
            playerOrigin = event.origin;
        }

        if (event.data == 'hello'){
            alert('hello');
            post('play');
        }

        var data = JSON.parse(event.data);
        console.log('OMR-data parse to JSON: ');
         console.log(data);

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

    // Helper function for sending a message to the player
    function post(action, value) {
    	console.log('1. post() action: ' + action + ', value: ' + value );
        var data = {
            method: action
        };
        if (value) {
            data.value = value;
        }
        console.log('2. post() data: ');
        console.log(data);
        var message = JSON.stringify(data);
        console.log('3. post() postMessage to player[0].contentWindow');
        console.log('4. post() player[0]:')
        console.log(player[0]);
        console.log('5. post() player[0].contentWindow:');
        console.log(player[0].contentWindow);
        console.log('playerOrigin: ');
        console.log(playerOrigin);
        player[0].contentWindow.postMessage(data, 'https://player.vimeo.com');
    }

    function onReady() {
        console.log('onReady(), posting 3 addEventListeners, then posting -play- ');
        post('addEventListener', 'pause');
        post('addEventListener', 'finish');
        post('addEventListener', 'playProgress');
        if (current_visited == false)
        {
        	console.log('onReady() page has not yet been visited, so: autoplay');
            post('play');   
            console.log('onReady() should be playing')
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

    /**
     * detect IE
     * returns version of IE or false, if browser is not Internet Explorer
     */
    function detectIE() {
        var ua = window.navigator.userAgent;

        var msie = ua.indexOf('MSIE ');
        if (msie > 0) {
            // IE 10 or older => return version number
            return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
        }

        var trident = ua.indexOf('Trident/');
        if (trident > 0) {
            // IE 11 => return version number
            var rv = ua.indexOf('rv:');
            return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
        }

        var edge = ua.indexOf('Edge/');
        if (edge > 0) {
           // Edge (IE 12+) => return version number
           return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
        }

        // other browser
        return false;
    }
});
