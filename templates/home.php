		<section>
    	<script type="text/javascript" src="../public/js/jssor.js"></script>
   	    <script type="text/javascript" src="../public/js/jssor.slider.js"></script>
    	<script>

        jssor_slider1_starter = function (containerId) {

            var _SlideshowTransitions = [
            //Fade
            { $Duration: 1200, $Opacity: 2 }
            ];

            var options = {
                $AutoPlay: true,
                $AutoPlaySteps: 1,
                $AutoPlayInterval: 3000,
                $PauseOnHover: 1,
                $ArrowKeyNavigation: true,
                $SlideDuration: 500,
                $MinDragOffsetToSlide: 20,
                //$SlideWidth: 600,
                //$SlideHeight: 300,                                
                $SlideSpacing: 0, 					                
                $DisplayPieces: 1,
                $ParkingPosition: 0,
                $UISearchMode: 1,
                $PlayOrientation: 1,
                $DragOrientation: 3,
                $SlideshowOptions: {
                    $Class: $JssorSlideshowRunner$,
                    $Transitions: _SlideshowTransitions,
                    $TransitionsOrder: 1,
                    $ShowLink: true
                },

                $BulletNavigatorOptions: {
                    $Class: $JssorBulletNavigator$,
                    $ChanceToShow: 2,
                    $AutoCenter: 1,
                    $Steps: 1,
                    $Lanes: 1,
                    $SpacingX: 10,
                    $SpacingY: 10,
                    $Orientation: 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,
                    $ChanceToShow: 2,
                    $Steps: 1
                }
            };
            var jssor_slider1 = new $JssorSlider$(containerId, options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
                if (parentWidth)
                    jssor_slider1.$ScaleWidth(Math.min(parentWidth, 600));
                else
                    $Jssor$.$Delay(ScaleSlider, 30);
            }

            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);

            $Jssor$.$AddEvent(window, "resize", $Jssor$.$WindowResizeFilter(window, ScaleSlider));
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            //responsive code end
        };
    </script>
    <!-- Jssor Slider Begin -->
    <!-- To move inline styles to css file/block, please specify a class name for each element. --> 
    <div id="slider1_container" style="position: relative; top: 20px; left: 50px; width: 600px; height: 300px; overflow: hidden; ">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(images/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div>

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 600px; height: 300px; overflow: hidden;">
            <div>
                <img u="image" src="../public/img/coffee1.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee2.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee3.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee4.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee5.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee6.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee7.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee8.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/coffee9.jpg" />
            </div>
            <div>
                <img u="image" src="../public/img/Oussema.jpg" />
            </div>
        </div>
        
        <!--#region Bullet Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-bullet-navigator-jquery.html -->
        <style>
            /* jssor slider bullet navigator skin 05 css */
            /*
            .jssorb05 div           (normal)
            .jssorb05 div:hover     (normal mouseover)
            .jssorb05 .av           (active)
            .jssorb05 .av:hover     (active mouseover)
            .jssorb05 .dn           (mousedown)
            */
            .jssorb05 {
                position: absolute;
            }
            .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
                position: absolute;
                /* size of bullet elment */
                width: 16px;
                height: 16px;
                background: url(images/b05.png) no-repeat;
                overflow: hidden;
                cursor: pointer;
            }
            .jssorb05 div { background-position: -7px -7px; }
            .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
            .jssorb05 .av { background-position: -67px -7px; }
            .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype"></div>
        </div>
        <!--#endregion Bullet Navigator Skin End -->
        
        <!--#region Arrow Navigator Skin Begin -->
        <!-- Help: http://www.jssor.com/development/slider-with-arrow-navigator-jquery.html -->
        <style>
            /* jssor slider arrow navigator skin 12 css */
            /*
            .jssora12l                  (normal)
            .jssora12r                  (normal)
            .jssora12l:hover            (normal mouseover)
            .jssora12r:hover            (normal mouseover)
            .jssora12l.jssora12ldn      (mousedown)
            .jssora12r.jssora12rdn      (mousedown)
            */
            .jssora12l, .jssora12r {
                display: block;
                position: absolute;
                /* size of arrow element */
                width: 30px;
                height: 46px;
                cursor: pointer;
                background: url(images/a12.png) no-repeat;
                overflow: hidden;
            }
            .jssora12l { background-position: -16px -37px; }
            .jssora12r { background-position: -75px -37px; }
            .jssora12l:hover { background-position: -136px -37px; }
            .jssora12r:hover { background-position: -195px -37px; }
            .jssora12l.jssora12ldn { background-position: -256px -37px; }
            .jssora12r.jssora12rdn { background-position: -315px -37px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora12l" style="top: 123px; left: 0px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora12r" style="top: 123px; right: 0px;">
        </span>
        <!--#endregion Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">js slider</a>
        <!-- Trigger -->
        <script>
            jssor_slider1_starter('slider1_container');
        </script>

    </div>
    <!-- Jssor Slider End -->

		</section>
		<article>
			<h1>What are the health benefits of coffee?</h1>
			<p>
			A cup of coffee in the morning may pack more than just an energy boost.
			<br />
			More and more research is emerging to suggest that there may be several health benefits associated with drinking this dark black beverage, from helping prevent diabetes to lowering the risk of liver disease.
			</p>
			<h2>The consumption of coffee goes back centuries.</h2>
			<p>
			In 17th century England the popularity of the drink gave rise to a number of coffee houses which were dubbed 'penny universities', because with one penny a person could buy a cup of coffee and have intellectually stimulating conversations with other people.
			</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/aBLYSO0DSVI" frameborder="0" allowfullscreen></iframe>
		</article>
		<aside>
			<img src = "../public/img/coffee-to-rescue.gif" height = "570" width = "220">
		</aside>