<div class="container" style="background: #ffffff;">
    <div class="col-xs-12">
        <h3 class="featurette-heading">Manage Tests</h3>
    </div>
</div>
<br>
<iframe id="player1" src="https://www.youtube.com/embed/DjB1OvEYMhY?enablejsapi=1"></iframe>
<iframe id="player" src="https://www.youtube.com/embed/DjB1OvEYMhY?enablejsapi=1"></iframe>
    <h5>Record of user actions:</h5>
    <script>
      var player1;var player;
      function onYouTubeIframeAPIReady() {
        player1 = new YT.Player( 'player1', {
          events: { 'onStateChange': onPlayerStateChange }
        });
        player = new YT.Player( 'player', {
          events: { 'onStateChange': onPlayerStateChange1 }
        });
      }
      function onPlayerStateChange(event) {
        switch(event.data) {
          case 0:
            record('video ended');
            break;
          case 1:
            record('video playing from '+player1.getCurrentTime());
            break;
          case 2:
            record('video paused at '+player1.getCurrentTime());
        }
      }
      function onPlayerStateChange1(event) {
        switch(event.data) {
          case 0:
            record('video ended');
            break;
          case 1:
            record('video1 playing from '+player.getCurrentTime());
            break;
          case 2:
            record('video1 paused at '+player.getCurrentTime());
        }
      }
      function record(str){
       var p = document.createElement("p");
        p.appendChild(document.createTextNode(str));
        document.body.appendChild(p);
      }
    </script>
    
    <script src="https://www.youtube.com/iframe_api"></script>
