<html>
<head>
<!-- Mobile viewport optimized -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link media="all" type="text/css" href="assets/dashicons.css" rel="stylesheet">
<link media="all" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet">
<link rel='stylesheet' id='style-css'  href='style.css' type='text/css' media='all' />
<script type='text/javascript' src='assets/jquery.js'></script>
<script type='text/javascript' src='assets/jquery-migrate.js'></script>

<?php /* === GOOGLE MAP JAVASCRIPT NEEDED (JQUERY) ==== */ ?>
<script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
<script type='text/javascript' src='assets/gmaps.js'></script>

</head>

<body>
  <div id="container">

    <article class="entry">
      <div class="entry-content">

        <?php /* === THIS IS WHERE WE WILL ADD OUR MAP USING JS ==== */ ?>
        <div class="google-map-wrap" itemscope itemprop="hasMap" itemtype="http://schema.org/Map">
          <div id="google-map" class="google-map" >
          </div><!-- #google-map -->
        </div>

        <?php
        /* Set Default Map Area Using First Location */
          $map_area_lat = isset( $locations[0]['google_map']['lat'] ) ? $locations[0]['google_map']['lat'] : '';
          $map_area_lng = isset( $locations[0]['google_map']['lng'] ) ? $locations[0]['google_map']['lng'] : '';
        ?>

        <script>
          jQuery( document ).ready( function($) {

            /* Do not drag on mobile. */
            var is_touch_device = 'ontouchstart' in document.documentElement;

            var map = new GMaps({
              el: '#google-map',
              lat: '<?php echo $map_area_lat; ?>',
              lng: '<?php echo $map_area_lng; ?>',
              scrollwheel: false,
              draggable: ! is_touch_device
          });

          /* Map Bound */
          var bounds = [];

          <?php /* For Each Location Create a Marker. */
            foreach($result[1] as $location ){
              $name = $location['location_name'];
              $addr = $location['location_address'];
              $map_lat = $location['google_map']['lat'];
              $map_lng = $location['google_map']['lng'];
              $id = $location['location_id'];
              //printf("abc".$message_tid);
              $author = $location['location_author'];
              if ($name != NULL){
                $url = "posts_single.php?thread_id=$id";
              } else {
                $url = "block.php?user_id=$id";
              }

              ?>
              /* Set Bound Marker */
              var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>);
              bounds.push(latlng);
              /* Add Marker */
              map.addMarker({
                lat: <?php echo $map_lat; ?>,
                lng: <?php echo $map_lng; ?>,
                title: '<?php echo $name; ?>',
                //tid: '<?php echo $message_tid; ?>'
                infoWindow: {
                  content: '<?php if($name != NULL) { ?><i class="fa fa-comments" style="color:#ffac33"></i><a href = <?php echo $url; ?>> <?php echo $name; ?></a><p><?php } ?><i class="fa fa-user" style="color:#3399ff"></i><a href = <?php echo $url; ?>> <?php echo $author; ?></a></p>'
                  //'<a href='posts_single.php?thread_id=$message_tid'><?php echo $name; ?></a>'

                }
              });
            <?php } //end foreach locations ?>

            /* Fit All Marker to map */
            map.fitLatLngBounds(bounds);

            /* Make Map Responsive */
            var $window = $(window);
            function mapWidth() {
              var size = $('.google-map-wrap').width();
              $('.google-map').css({width: size + 'px', height: (size/2.5) + 'px'});
            }
            mapWidth();
            $(window).resize(mapWidth);
          });
        </script>

      </div><!-- .entry-content -->

    </article>

  </div><!-- #container -->
</body>
</html>

