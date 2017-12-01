<link rel="stylesheet" type="text/css" href="../public/css/where.css">
<script type = "text/javascript" src = "https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&key=AIzaSyBWpatx5i-sfGb_4CsLI2rwcdvQUXLpA7Y"></script>
    <script type = "text/javascript">
      
      

      function initialize() {
      
        var cof1Latlng = new google.maps.LatLng(35.827583, 10.637253);
        var facLatlng = new google.maps.LatLng(35.834077, 10.591116);
      

        var myLatlng = new google.maps.LatLng(35.825078, 10.619829);
        var mapOptions = {
            zoom: 14,
            center: myLatlng
        };
        
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
 
        var marker1 = new google.maps.Marker({position: cof1Latlng, map: map, title: 'coffee1',draggable: false, animation: google.maps.Animation.DROP});
        google.maps.event.addListener(marker1, 'click', function() { if (marker1.getAnimation() != null) {marker1.setAnimation(null);} 
          else {marker1.setAnimation(google.maps.Animation.BOUNCE);}} );
        var marker2 = new google.maps.Marker({position: facLatlng, map: map, title: 'Factory Lounge',draggable: false, animation: google.maps.Animation.DROP});
        google.maps.event.addListener(marker2, 'click', function() { if (marker2.getAnimation() != null) {marker2.setAnimation(null);} else {marker2.setAnimation(google.maps.Animation.BOUNCE);}} );
    
      
      var contentFactory = 
      '<div id="content">'+
        '<div id="siteNotice">'+'</div>'+
        '<h1 id="firstHeading" class="firstHeading">Factory Lounge</h1>'+
        '<div id="bodyContent">'+
          '<p><b>Factory</b>, is a coffee shop located in <b>Sahloul</b>. It is a large ' +
          'coffee shop where you can have drinks or meals.</p>'+
        '<p>Street: Yasser Arafat, Sahloul.<br />Telephone: +21673000000<br /><p>' + '<h4> &#8594 <a href="../coffee/html/factory.html">'+
        'Visit Factory right now !</a> &#8592 </h4>'+
        '</div>'+
      '</div>';
      

        var infowindow = new google.maps.InfoWindow({content: contentFactory, Width: 200});

        google.maps.event.addListener(marker2, 'click', function() {infowindow.open(map, marker2); });

      }
    
        
       
      google.maps.event.addDomListener(window, 'load', initialize);

    </script>

		<section>
      <p>
        <h1>This is a The Google Map.</h1>
        The <img src = "../public/img/map-marker.png" width = "30" height = "30" /> are location of Coffee shops. Click on them for more informations.
      </p>  
    </section>
    <div id = "map-canvas"></div>