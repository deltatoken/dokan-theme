<?php
/**
 * Dokan settings Class
 *
 * @ weDves
 */


class Dokan_Template_Settings{

    public static function init() {
        static $instance = false;

        if( !$instance ) {
            $instance = new Dokan_Template_Settings();
        }

        return $instance;
    }

    function insert_settings_info() {
        if(!isset($_POST['dokan_template_setting']) && !wp_verify_nonce( $_POST['dokan_settings_nonce'], 'dokan_template_settings' ) ) {
            return;
        }

        $dokan_settings = array( 
            'store_name'      => $_POST['dokan_store_name'],
            'social' => array(
                'fb' => filter_var( $_POST['setting_social_fb'], FILTER_VALIDATE_URL ), 
                'gplus' => filter_var( $_POST['setting_social_gol'], FILTER_VALIDATE_URL ),
                'twitter' => filter_var( $_POST['seting_social_twi'], FILTER_VALIDATE_URL ),
                'linkedin' => filter_var( $_POST['setting_social_lin'], FILTER_VALIDATE_URL ),
                'youtube' => filter_var( $_POST['setting_social_you'], FILTER_VALIDATE_URL ),
            ),
            'payment' => array(
                'account_number' => $_POST['settings_bank_acont'],
                'bank_name' => $_POST['setting_bank_name'],
                'swift_code' => $_POST['setting_bank_swf'],
                'paypal_email'  => filter_var( $_POST['setting_paypal_email'], FILTER_VALIDATE_EMAIL ),
            ),
             
            'phone'         => $_POST['setting_phone'],
            'address'       => $_POST['setting_address'],
            'location'      => $_POST['location'],
            'find_address'   => $_POST['find_address'],
            'dokan_category'  => $_POST['setting_category'],
        );

        update_user_meta( get_current_user_id(), 'dokan_profile_settings', $dokan_settings );
        wp_redirect( add_query_arg( array( 'message' => 'profile_saved' ), get_permalink() ) );
    }



    function setting_field() {
        if( isset($_GET['message'])) {
            ?>

            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php _e('Your profile has been updated successfully!','dokan'); ?></strong>
            </div>
            <?php
        }

        $profile_info = get_user_meta( get_current_user_id(), 'dokan_profile_settings', true );
        $storename = isset( $profile_info['store_name'] ) ? esc_attr( $profile_info['store_name'] ) : '';

        $fb = isset( $profile_info['social']['fb'] ) ? esc_url( $profile_info['social']['fb'] ) : '';
        $twitter = isset( $profile_info['social']['twitter'] ) ? esc_url( $profile_info['social']['twitter'] ) : '';
        $gplus = isset( $profile_info['social']['gplus'] ) ? esc_url ( $profile_info['social']['gplus'] ) : '';
        $linkedin = isset( $profile_info['social']['linkedin'] ) ? esc_url( $profile_info['social']['linkedin'] ) : '';
        $youtube = isset( $profile_info['social']['youtube'] ) ? esc_url( $profile_info['social']['youtube'] ) : '';

        $paypal_email = isset( $profile_info['payment']['paypal_email'] ) ? esc_attr( $profile_info['payment']['paypal_email'] ) : '';
        $account_number = isset( $profile_info['payment']['account_number'] ) ? esc_attr( $profile_info['payment']['account_number'] ) : '';
        $bank_name = isset( $profile_info['payment']['bank_name'] ) ? esc_attr( $profile_info['payment']['bank_name'] ) : '';
        $swift_code = isset( $profile_info['payment']['swift_code'] ) ? esc_attr( $profile_info['payment']['swift_code'] ) : '';

        $phone = isset( $profile_info['phone'] ) ? esc_attr( $profile_info['phone'] ) : '';
        $address = isset( $profile_info['address'] ) ? esc_attr( $profile_info['address'] ) : '';
        $map_location = isset( $profile_info['location'] ) ? esc_attr( $profile_info['location'] ) : '';
        $map_address = isset( $profile_info['find_address'] ) ? esc_attr( $profile_info['find_address'] ) : '';
        $dokan_category = isset( $profile_info['dokan_category'] ) ? esc_attr( $profile_info['dokan_category'] ) : '';
        ?>


            <form method="post"  action="" class="form-horizontal">
                <?php wp_nonce_field( 'dokan_template_settings', 'dokan_settings_nonce' ); ?>

                <div class="form-group">
                  <label class="col-md-3 control-label" for="dokan_store_name"><?php _e('Store Name','dokan'); ?></label>  
                  <div class="col-md-5">
                  <input id="dokan_store_name" value="<?php echo $storename; ?>" name="dokan_store_name" placeholder="store name" class="form-control input-md" type="text">
                    
                  </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_social_fb"><?php _e('Social Profile','dokan'); ?></label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <span class="input-group-addon">Facebook</span>
                      <input id="setting_social_fb" value="<?php echo $fb; ?>" name="setting_social_fb" class="form-control" placeholder="http://" type="text">
                    </div>
                  </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_social_gol"></label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <span class="input-group-addon"><?php _e('Google','dokan'); ?></span>
                      <input id="setting_social_gol" value="<?php echo $gplus; ?>" name="setting_social_gol" class="form-control" placeholder="http://" type="text">
                    </div>

                  </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="seting_social_twi"></label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <span class="input-group-addon"><?php _e('Twitter','dokan'); ?></span>
                      <input id="seting_social_twi" value="<?php echo $twitter; ?>" name="seting_social_twi" class="form-control" placeholder="http://" type="text">
                    </div>

                  </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_social_lin"></label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <span class="input-group-addon"><?php _e('Linkedin','dokan'); ?></span>
                      <input id="setting_social_lin" value="<?php echo $linkedin; ?>" name="setting_social_lin" class="form-control" placeholder="http://" type="text">
                    </div>

                  </div>
                </div>

                <!-- Prepended text-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_social_you"></label>
                  <div class="col-md-5">
                    <div class="input-group">
                      <span class="input-group-addon"><?php _e('Youtube','dokan'); ?></span>
                      <input id="setting_social_you" value="<?php echo $youtube; ?>" name="setting_social_you" class="form-control" placeholder="http://" type="text">
                    </div>
                  </div>
                </div>

                <!-- payment tab -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="dokan_setting"><?php _e('Payment Method','dokan'); ?></label>
                  <div class="col-md-4">
                    <ul class="nav nav-tabs">
                        <li><a href="#dokan-paypal" data-toggle="tab"><?php _e('Paypal','dokan'); ?></a></li>
                        <li><a href="#dokan-bank" data-toggle="tab"><?php _e('Bank','dokan'); ?></a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div class="tab-pane active" id="dokan-paypal">


                        <!-- Prepended text-->
                        <div class="form-group">
                          <div class="col-md-10">
                            <div class="input-group">
                              <span class="input-group-addon"><?php _e('E-mail','dokan'); ?></span>
                              <input id="setting_paypal_email" value="<?php echo $paypal_email; ?>" name="setting_paypal_email" class="form-control" placeholder="email" type="text">
                            </div>
                          </div>
                        </div>


                      </div>
                      <div class="tab-pane" id="dokan-bank">


                            <!-- Prepended text-->
                            <div class="form-group">

                              <div class="col-md-10">
                                <div class="input-group">
                                  <span class="input-group-addon"><?php _e('Account No.', 'dokan'); ?></span>
                                  <input id="settings_bank_acont" value="<?php echo $account_number; ?>" name="settings_bank_acont" class="form-control" placeholder="3784746" type="text">
                                </div>
                                
                              </div>
                            </div>

                            <!-- Prepended text-->
                            <div class="form-group">

                              <div class="col-md-10">
                                <div class="input-group">
                                  <span class="input-group-addon"><?php _e('Bank Name', 'dokan'); ?></span>
                                  <input id="setting_bank_name" value="<?php echo $bank_name; ?>" name="setting_bank_name" class="form-control" placeholder="Bangladesh Bank" type="text">
                                </div>
                                
                              </div>
                            </div>

                            <!-- Prepended text-->
                            <div class="form-group">

                              <div class="col-md-10">
                                <div class="input-group">
                                  <span class="input-group-addon"><?php _e('Swift Code', 'dokan'); ?></span>
                                  <input id="setting_bank_swf" value="<?php echo $swift_code; ?>" name="setting_bank_swf" class="form-control" placeholder="0987" type="text">
                                </div>
                                
                              </div>
                            </div>
                      </div>
                    </div>    
                  </div>
                </div>



                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_phone"><?php _e('Phone No', 'dokan'); ?></label>  
                  <div class="col-md-5">
                  <input id="setting_phone" value="<?php echo $phone; ?>" name="setting_phone" placeholder="+8817176644.." class="form-control input-md" type="text">
                    
                  </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_address"><?php _e('Address', 'dokan'); ?></label>
                  <div class="col-md-4">                     
                    <textarea class="form-control" id="setting_address" name="setting_address"><?php echo $address; ?></textarea>
                  </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_map"><?php _e('Map', 'dokan'); ?></label>
                  <div class="col-md-4">                     
                    <!-- <textarea class="form-control" id="setting_map" name="setting_map"></textarea> -->
                    <div class="wpuf-fields">
    <input id="dokan-map-lat" type="hidden" name="location" value="<?php echo $map_location; ?>" size="30" />

    <input id="dokan-map-add" type="text" value="<?php echo $map_address; ?>" name="find_address" placeholder="<?php _e( 'Type an address to find', 'dokan' ); ?>" size="30" />
    <button class="button" id="dokan-location-find-btn"><?php _e( 'Find Address', 'dokan' ); ?></button>

    <div class="google-map" style="margin: 10px 0; height: 250px; width: 450px;" id="dokan-map"></div>
</div>
<script type="text/javascript">

    (function($) {
        $(function() {
            <?php list( $def_lat, $def_long ) = explode(',', $map_location); ?>
            var def_zoomval = 12;
            var def_longval = <?php echo $def_long ? $def_long : 90.40714300000002; ?>;
            var def_latval = <?php echo $def_lat ? $def_lat : 23.709921; ?>;
            var curpoint = new google.maps.LatLng(def_latval, def_longval),
                geocoder   = new window.google.maps.Geocoder(),
                $map_area = $('#dokan-map'),
                $input_area = $( '#dokan-map-lat' ),
                $input_add = $( '#dokan-map-add' ),
                $find_btn = $( '#dokan-location-find-btn' );
                
            autoCompleteAddress();

            $find_btn.on('click', function(e) {
                e.preventDefault();

                geocodeAddress( $input_add.val() );
            });

            var gmap = new google.maps.Map( $map_area[0], {
                center: curpoint,
                zoom: def_zoomval,
                mapTypeId: window.google.maps.MapTypeId.ROADMAP
            });

            var marker = new window.google.maps.Marker({
                position: curpoint,
                map: gmap,
                draggable: true
            });

            window.google.maps.event.addListener( gmap, 'click', function ( event ) {
                marker.setPosition( event.latLng );
                updatePositionInput( event.latLng );
            } );

            window.google.maps.event.addListener( marker, 'drag', function ( event ) {
                updatePositionInput(event.latLng );
            } );

            function updatePositionInput( latLng ) {
                $input_area.val( latLng.lat() + ',' + latLng.lng() );
            }

            function updatePositionMarker() {
                var coord = $input_area.val(),
                    pos, zoom;

                if ( coord ) {
                    pos = coord.split( ',' );
                    marker.setPosition( new window.google.maps.LatLng( pos[0], pos[1] ) );

                    zoom = pos.length > 2 ? parseInt( pos[2], 10 ) : 12;

                    gmap.setCenter( marker.position );
                    gmap.setZoom( zoom );
                }
            }

            function geocodeAddress( address ) {
                geocoder.geocode( {'address': address}, function ( results, status ) {
                    if ( status == window.google.maps.GeocoderStatus.OK ) {
                        updatePositionInput( results[0].geometry.location );
                        marker.setPosition( results[0].geometry.location );
                        gmap.setCenter( marker.position );
                        gmap.setZoom( 15 );
                    }
                } );
            }
            
            function autoCompleteAddress(){
                if (!$input_add) return null;

                $input_add.autocomplete({
                    source: function(request, response) {
                        // TODO: add 'region' option, to help bias geocoder.
                        geocoder.geocode( {'address': request.term }, function(results, status) {
                            response(jQuery.map(results, function(item) {
                                return {
                                    label     : item.formatted_address,
                                    value     : item.formatted_address,
                                    latitude  : item.geometry.location.lat(),
                                    longitude : item.geometry.location.lng()
                                };
                            }));
                        });
                    },
                    select: function(event, ui) {

                        $input_area.val(ui.item.latitude + ',' + ui.item.longitude );       

                        var location = new window.google.maps.LatLng(ui.item.latitude, ui.item.longitude);

                        gmap.setCenter(location);
                        // Drop the Marker
                        setTimeout( function(){
                            marker.setValues({
                                position    : location,
                                animation   : window.google.maps.Animation.DROP
                            });
                        }, 1500);
                    }
                });
            }

        });
    })(jQuery);
</script>
                  </div>
                </div>
                <?php 
                $dokan_categories = $this->get_dokan_categories();
                ?>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="setting_category"><?php _e('Dokan Type', 'dokan'); ?></label>
                  <div class="col-md-5">
                    <select id="setting_category" name="setting_category" class="form-control">
                        <?php foreach($dokan_categories as $key => $val) { ?>
                            <option value="<?php echo esc_attr( $key ); ?>"<?php selected( $dokan_category, $key ); ?>><?php echo $val; ?></option>
                            <?php
                        } ?>
                    </select>
                  </div>
                </div>





                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-3 control-label" for="dokan_setting"></label>
                  <div class="col-md-4">
                    <button id="dokan_setting" name="dokan_template_setting" class="btn btn-primary"><?php _e('Update Settings','dokan'); ?></button>
                  </div>
                </div>
                

                </form>

                <script type="text/javascript">

                jQuery(function($){
                    $('#dokan-paypal a').click(function (e) {
                      e.preventDefault()
                      $(this).tab('show')
                    })

                    $('#dokan-bank a').click(function (e) {
                      e.preventDefault()
                      $(this).tab('show')
                    })
                });
                </script>

        <?php
    } 

    function get_dokan_categories() {
        $dokan_category = array(
            '' => __('--Select--','dokan'),
            'book' => __('Book', 'dokan'),
            'dress' => __('Dress', 'dokan'),
            'electronic' => __('Electronic', 'dokan'),
        );

        return apply_filters('dokan_category', $dokan_category);
    }
}