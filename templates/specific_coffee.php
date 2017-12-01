<link rel="stylesheet" type="text/css" href="../public/css/specific.css">
<link rel="stylesheet" type="text/css" href="../public/css/comment.css">
<img id = "introImg" src="../public/img<?php echo $coffee_image; ?>" width = "840px" height = "500px">
<script type="text/javascript" src="../public/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.reel.js"></script>
<script type="text/javascript" src="../public/js/comment.js"></script>

<section>
	<h1><?php echo $title; ?></h1>
	<p><?php echo $description; ?></p>


	<img src="../public/img/loading1.gif" width="900" height="700" 
      class="reel"
      id="image"
      data-image="../public/img/factory/try_panorama.jpg"
      data-stitched="2800"
      data-loops="true"
      data-speed="0"
      data-timeout="0">

      <br/>
      <hr/>

      <div class="comment-box">
            <form id="formi" action="#" onsubmit="event.preventDefault(); postComment();" coffee="<?php echo $_GET["coffee"]; ?>">
     
     
            <textarea id="comment" type="text" required="true" class="feedback-input" placeholder="Comment"></textarea>
      
      
            <div class="submit">
                        <input type="submit" value="Comment" id="button-blue" />
                  <div class="ease"></div>
            </div>
            </form>
      </div>
      <div id="comments" class="comment-box">
            
            <?php
                  foreach ($comments as $value) {
                       echo "<hr><h4>" . 
                        $value["commenter"] . 
                        ": <span>" . 
                        $value["date"] . 
                        "</span></h4><p>" . 
                        $value["comment"] . 
                        "</p>";
                  }
            ?>

      </div>

    


</section>




