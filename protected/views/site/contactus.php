<div class="container">
    <br>
    <div class="col-xs-12">
        <h3 class="featurette-heading"><span class="text-muted">CONTACT US</span></h3>
        
        <br><?php if (Yii::app()->user->hasFlash('error')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-danger fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                </div>
            <?php } ?>
        <?php if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info1 alert alert-success fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                </div>
            <?php } ?>
    </div>
    
        
        
  
    <div class="col-xs-12 col-xs-6 col-md-6">
        <p>We are here to answer any questions you may have about our samarthya experiences. Reach out to us and we&lsquo;ll respond as soon as we can.</p><br/>
        <div class="contact-form">
            <form class="form-signin" action="<?php echo Yii::app()->request->baseUrl.'/site/contactUs';?>" method="post">
                <input type="text" id="inputEmail" name="Contactus[name]" class="form-control" placeholder="Your Name..." required autofocus><br/>
                <input type="email" id="inputEmail" name="Contactus[email]" class="form-control" placeholder="Your Email Address..." required><br/>
                <textarea id="textArea" name="Contactus[message]" class="form-control custom-control" rows="3" placeholder="Write Your Message..." required></textarea><br/>        
                <button class="btn btn-default pull-right" type="submit">Post Message</button>
            </form>
        </div>
    </div>
    <div class="col-xs-12 col-xs-6 col-md-1"></div>
    <div class="col-xs-12 col-xs-6 col-md-5">
        <div class="address-block">
            <h4><span class="text-muted">ADDRESS</span></h4>
            <address>
                National Institute of Rural Development and Panchayati Raj<br/>
                Rajendranagar,Hyderabad-500030<br/>
                E-mail:<a href="mailto:cit@nird.gov.in">cit@nird.gov.in</a>/<a href="mailto:admin@nird.gov.in">admin@nird.gov.in</a><br/>
                Phone: <strong>+91-40-24008526,24008439</strong><br/>
                Fax:<strong>91-40-2401650</strong>
            </address>
        </div>
    </div>

</div>
<br/>
<div class="container">
    <div class="col-xs-12">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3809.032727676666!2d78.40270799999998!3d17.313970000000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcbbdec76f2fdff%3A0x89c0c14e19e6f0e8!2sNational+Institute+of+Rural+Development+and+Panchayati+Raj!5e0!3m2!1sen!2sin!4v1431968820764" width="1000" height="300" frameborder="0" style="border:0"></iframe>
    </div>
</div>
<br>

<?php $this->renderPartial('//layouts/footer_main'); ?>