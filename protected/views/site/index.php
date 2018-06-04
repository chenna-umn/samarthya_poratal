
<div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div class="courses-btn"><a href="<?php echo Yii::app()->request->baseUrl . '/site/courses'; ?>" style="padding-right: 30px;">COURSES</a></div>
                <?php $user = User::model()->findAll(); ?>
               <div class="carousel-caption1" style="top:90%;left:2%;font-size:14px;padding-bottom:0px;width:35%;color:yellow">
                  Technical staff registered till date : <?php echo (count($user)-1); ?>
              </div> 
            <div class="login-form col-xs-6 hidden-xs hidden-sm hidden-md">
                    <?php $this->renderPartial('//site/login'); ?>
                    
            </div>
            
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              <li data-target="#myCarousel" data-slide-to="1"></li>
              <li data-target="#myCarousel" data-slide-to="2"></li>
              <li data-target="#myCarousel" data-slide-to="3"></li>
              <li data-target="#myCarousel" data-slide-to="4"></li>
              <li data-target="#myCarousel" data-slide-to="5"></li>
              <li data-target="#myCarousel" data-slide-to="6"></li>
              <li data-target="#myCarousel" data-slide-to="7"></li>
              <li data-target="#myCarousel" data-slide-to="8"></li>
              <li data-target="#myCarousel" data-slide-to="9"></li>
            </ol>
            
      <div class="carousel-inner" role="listbox">
        
          <div class="item active">
            <img class="first-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-01.jpg" height="430" alt="First slide">
            <div class="container-fluid hidden-xs">
              <div class="carousel-caption">
                <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
              </div>
            </div>
          </div>
          
          <div class="item">
            <img class="second-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-02.jpg" height="430" alt="Second slide">
            <div class="container-fluid hidden-xs">
              <div class="carousel-caption">
                <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
              </div>
            </div>
           </div>
          
           <div class="item">
                <img class="third-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-03.jpg" height="430" alt="Third slide">
                <div class="container-fluid hidden-xs">
                  <div class="carousel-caption">
                    <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
                  </div>
                </div>
           </div>
          
        <div class="item">
          <img class="fourth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-04.jpg" height="430" alt="Fourth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
        <div class="item">
          <img class="fifth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-05.jpg" height="430" alt="Fifth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
        <div class="item">
          <img class="fifth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-06.jpg" height="430" alt="Fifth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
        <div class="item">
          <img class="fifth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-07.jpg" height="430" alt="Fifth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
        <div class="item">
          <img class="fifth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-08.jpg" height="430" alt="Fifth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
        <div class="item">
          <img class="fifth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-09.jpg" height="430" alt="Fifth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
        <div class="item">
          <img class="fifth-slide" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/slider-img-10.jpg" height="430" alt="Fifth slide">
          <div class="container-fluid hidden-xs">
            <div class="carousel-caption">
              <h1 class="slidertext">Enabling technical staff under MGNREGA to enhance their skill</h1>
            </div>
          </div>
        </div>
          
      </div>
            
      <a class="left carousel-control hidden-xs" href="#myCarousel" role="button" data-slide="prev" style="width: 50px; height: 80px; top: 32%;">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true" style="top: 20px;"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control hidden-xs" href="#myCarousel" role="button" data-slide="next" style="width: 50px; height: 80px; top: 32%;">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true" style="top: 20px;"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

<!--   ---------------------- End Home Page Slider -----------------------    -->

<!--   ---------------------- Start Home Page About Content -----------------------    -->

<div class="container-fluid" style="background: #fff;padding-top: 20px; padding-bottom: 20px;">
   <div class="row">
      <div class="col-md-7 featurette" style="padding-left: 7%;">
         <h2 class="featurette-heading"><span class="text-muted">About</span> MGNREGA</h2>
         <p>Mahatma Gandhi National Rural Employment Guarantee Act ensures at least one hundred days of guaranteed wage employment in a financial year to every rural household whose adult members volunteer to do unskilled manual work.To get wage employment qualitative and sustainable  assets have to be created in rural areas with the technical support of MGNREGA functionaries.As a ready reckoner, Samarthya technical manual on MGNREGS works developed is transformed into online learning portal for the benefit of technical and non-technical functionaries of MGNREGS in the country by providing text and video material on each work.This OLP is expected to ensure flow of knowledge and skill  from the brains of MGNREGS field functionaries through the hands of MGNREGS unskilled  labourers on to the ground  to result in qualitative and sustainable assets with enhanced livelihoods.<a href="<?php echo Yii::app()->request->baseUrl . '/site/Download?name=Content_mgnrega.pdf&path=uploads/coursePDF'; ?>">Read More...</a>

</p>
      </div>
      <div class="col-md-5"><img alt="About Image" src="<?php echo Yii::app()->request->baseUrl . '/sm_assets/'; ?>assets/images/homepage-img.jpg" class="featurette-image img-responsive center-block"></div>
   </div>
   </div>

<!--   ---------------------- End Home Page About Content -----------------------    -->


<?php $this->renderPartial('//layouts/footer_main'); ?>