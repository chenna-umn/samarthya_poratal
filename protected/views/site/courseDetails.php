<div class="container">
    <br>
    <?php if (isset($courses) && !empty($courses)) { ?>
        <div class="col-xs-12">
            <h3 class="featurette-heading">Course <?php echo $courses->courseNumber; ?> on <span class="text-muted"><?php echo $courses->courseName; ?></span></h3>
            <hr class="featurette-divider">
            <p><?php
    if (isset($courses->description) && !empty($courses->description)) {
        echo $courses->description;
    }
        ?><br>
                <?php if (isset($courses->PDFlink) && !empty($courses->PDFlink)) { ?>
                    <a class="pull-right" href="<?php echo Yii::app()->request->baseUrl . '/site/Download?name=' . $courses->PDFlink . '&path=uploads/coursePDF'; ?>">read more...</a>
                <?php } ?>        
            </p>
        </div>
    <?php } ?>
</div>

<div class="container">



    <?php
    if (isset($courseDetails) && !empty($courseDetails)) {
        $i = 0;
        foreach ($courseDetails as $key => $value) {
            ?>
            <input type="hidden" id="totalvdos" value="<?php echo count($courseDetails); ?>"/>

            <div class="col-xs-12 col-xs-6 col-md-4">
                <div class="course-video"><h5 class="course-title"><?php echo $value->title; ?></h5>
                    <div align="center" class="video-frame iframeholder" id="englishVideo" >
                        <?php if (isset($value->courseEngVideoLink) && !empty($value->courseEngVideoLink)) { ?>
                            <iframe id="player<?php echo $i; ?>" width="92%" height="80%"   frameborder="0" allowfullscreen="" src="<?php echo $value->courseEngVideoLink; ?>"></iframe>
                            <input type="hidden" id="videosubcourseid<?php echo $i; ?>" value="<?php echo $value->id; ?>"/>
                            <input type="hidden" id="videocourseid<?php echo $i; ?>" value="<?php echo $value->courseId; ?>"/>
                        <?php } ?>
                    </div>
                    <div>
                        <?php if (isset($value->courseEngVideoLink) && !empty($value->courseEngVideoLink)) { ?>
                            <a target="_blank" href="<?php echo $value->courseEngVideoLink; ?>"><div class="english"></div></a>
                        <?php } ?>
                        <?php if (isset($value->courseHindiVideoLink) && !empty($value->courseHindiVideoLink)) { ?>
                            <a target="_blank" href="<?php echo $value->courseHindiVideoLink ?>"><div class="hindi"></div></a>
                        <?php } ?>
                        <?php if (isset($value->courseTeluguVideoLink) && !empty($value->courseTeluguVideoLink)) { ?>
                            <a target="_blank" href="<?php echo $value->courseTeluguVideoLink ?>"><div class="telugu"></div></a>
                        <?php } ?>
                        <?php if (isset($value->courseEngPDF) && !empty($value->courseEngPDF)) { ?>
                            <a target="_blank" onclick="pdfdownload('<?php echo $courses->id; ?>','<?php echo $value->id; ?>','<?php echo Yii::app()->request->baseUrl . '/uploads/coursePDF/' . $value->courseEngPDF; ?>')" oncontextmenu="rightclick();return false" href="<?php echo Yii::app()->request->baseUrl . '/uploads/coursePDF/' . $value->courseEngPDF; ?>">
                                <div class="pdf-download"></div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>


            <?php
            $i++;
        }
    } else {
        ?>
        <div class="row margin-bottom-10">
            <div class="info1 alert alert-warning fade in">
                <strong>  Oops... There are No Courses Available Currently...</strong>
            </div>
        </div>
    <?php } ?>
</div>
<br>
<script type="text/javascript">
    function pdfdownload(courseId,subLinkId){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        
        jQuery.ajax({                            
            url: baseurl+'/site/userPdfView',
            type: "POST",
            data: {courseId: courseId,
                subLinkId : subLinkId
            },  
            error: function(){
                    
            },
            success: function(resp){                  
                    
            }
        });
    }
    function rightclick(){
        alert("Right Click Disbled");
    }
    var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
    var player1;var player0;
    function onYouTubeIframeAPIReady() {
        player1 = new YT.Player( 'player1', {
            events: { 'onStateChange': onPlayerStateChange1 }
        });
        player0 = new YT.Player( 'player0', {
            events: { 'onStateChange': onPlayerStateChange0 }
        });
        player2 = new YT.Player( 'player2', {
            events: { 'onStateChange': onPlayerStateChange2 }
        });
        player3 = new YT.Player( 'player3', {
            events: { 'onStateChange': onPlayerStateChange3 }
        });
        player4 = new YT.Player( 'player4', {
            events: { 'onStateChange': onPlayerStateChange4 }
        });
        player5 = new YT.Player( 'player5', {
            events: { 'onStateChange': onPlayerStateChange5 }
        });
        player6 = new YT.Player( 'player6', {
            events: { 'onStateChange': onPlayerStateChange6 }
        });
        player7 = new YT.Player( 'player7', {
            events: { 'onStateChange': onPlayerStateChange7 }
        });
        player8 = new YT.Player( 'player8', {
            events: { 'onStateChange': onPlayerStateChange8 }
        });
        player9 = new YT.Player( 'player9', {
            events: { 'onStateChange': onPlayerStateChange9 }
        });
        player10 = new YT.Player( 'player10', {
            events: { 'onStateChange': onPlayerStateChange10 }
        });
        player11 = new YT.Player( 'player11', {
            events: { 'onStateChange': onPlayerStateChange11 }
        });
        player12 = new YT.Player( 'player12', {
            events: { 'onStateChange': onPlayerStateChange12 }
        });
        player13 = new YT.Player( 'player13', {
            events: { 'onStateChange': onPlayerStateChange13 }
        });
        player14 = new YT.Player( 'player14', {
            events: { 'onStateChange': onPlayerStateChange14 }
        });
        player15 = new YT.Player( 'player15', {
            events: { 'onStateChange': onPlayerStateChange15 }
        });
    }
    function onPlayerStateChange0(event) {
        var subCourseId= document.getElementById('videosubcourseid0').value;
        var courseId= document.getElementById('videocourseid0').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player0.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player0.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange1(event) {
        var subCourseId= document.getElementById('videosubcourseid1').value;
        var courseId= document.getElementById('videocourseid1').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player1.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player1.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    function onPlayerStateChange2(event) {
        var subCourseId= document.getElementById('videosubcourseid2').value;
        var courseId= document.getElementById('videocourseid2').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player2.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player2.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange3(event) {
        var subCourseId= document.getElementById('videosubcourseid3').value;
        var courseId= document.getElementById('videocourseid3').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player3.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player3.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    
    
    function onPlayerStateChange4(event) {
        var subCourseId= document.getElementById('videosubcourseid4').value;
        var courseId= document.getElementById('videocourseid4').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player4.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player4.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange5(event) {
        var subCourseId= document.getElementById('videosubcourseid5').value;
        var courseId= document.getElementById('videocourseid5').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player5.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player5.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    function onPlayerStateChange6(event) {
        var subCourseId= document.getElementById('videosubcourseid6').value;
        var courseId= document.getElementById('videocourseid6').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player6.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player6.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange7(event) {
        var subCourseId= document.getElementById('videosubcourseid7').value;
        var courseId= document.getElementById('videocourseid7').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player7.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player7.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    
    
    
    
    function onPlayerStateChange8(event) {
        var subCourseId= document.getElementById('videosubcourseid8').value;
        var courseId= document.getElementById('videocourseid8').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player8.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player8.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange9(event) {
        var subCourseId= document.getElementById('videosubcourseid9').value;
        var courseId= document.getElementById('videocourseid9').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player9.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player9.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    function onPlayerStateChange10(event) {
        var subCourseId= document.getElementById('videosubcourseid10').value;
        var courseId= document.getElementById('videocourseid10').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player10.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player10.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange11(event) {
        var subCourseId= document.getElementById('videosubcourseid11').value;
        var courseId= document.getElementById('videocourseid11').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player11.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player11.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    
    
    function onPlayerStateChange12(event) {
        var subCourseId= document.getElementById('videosubcourseid12').value;
        var courseId= document.getElementById('videocourseid12').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player12.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player12.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange13(event) {
        var subCourseId= document.getElementById('videosubcourseid13').value;
        var courseId= document.getElementById('videocourseid13').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player13.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player13.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    
    function onPlayerStateChange14(event) {
        var subCourseId= document.getElementById('videosubcourseid6').value;
        var courseId= document.getElementById('videocourseid6').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player14.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
              
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video paused at ',
                        time : player14.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
    function onPlayerStateChange15(event) {
        var subCourseId= document.getElementById('videosubcourseid15').value;
        var courseId= document.getElementById('videocourseid15').value;
        switch(event.data) {
            case 0:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg : 'Video completed',
                        time : 'complete'
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 1:           
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                        msg :'Video playing from ',
                        time : player15.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
                break;
            case 2:
               
                jQuery.ajax({                            
                    url: baseurl+'/site/userVideoView',
                    type: "POST",
                    data: {subCourseId: subCourseId,
                        courseId :courseId,
                       msg :'Video paused at ',
                        time : player15.getCurrentTime()
                    },  
                    error: function(){
                    
                    },
                    success: function(resp){                  
                    
                    }
                });
        }
    }
</script>
<script src="https://www.youtube.com/iframe_api"></script>
<?php $this->renderPartial('//layouts/footer_main'); ?>