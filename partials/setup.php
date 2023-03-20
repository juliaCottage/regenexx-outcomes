<?php

if( function_exists('set_status') ){
    return;
} else {

// This is the secret key for API authentication. You configured it in the settings menu of the license manager plugin.
define('YOUR_SPECIAL_SECRET_KEY', '5bad15a5b97394.35702508'); //Rename this constant name so it is specific to your plugin or theme.

// This is the URL where API query request will be sent to. This should be the URL of the site where you have installed the main license manager plugin. Get this value from the integration help page.
define('YOUR_LICENSE_SERVER_URL', 'https://license.targetdna.com/'); //Rename this constant name so it is specific to your plugin or theme.

// This is a value that will be recorded in the license manager data so you can identify licenses for this item/product.
define('YOUR_ITEM_REFERENCE', 'Regenexx Outcomes Plugin'); //Rename this constant name so it is specific to your plugin or theme.

add_action('admin_menu', 'targetdna_license_menu');

function targetdna_license_menu() {
    add_options_page('License Activation Menu', 'KNM License', 'manage_options', __FILE__, 'targetdna_license_management_page');
}

function targetdna_license_management_page() {
    echo '<div class="wrap">';
    echo '<h2>Regenexx Outcomes Plugin License Key</h2>';

    /*** License activate button was clicked ***/
    if (isset($_REQUEST['activate_license'])) {
        $license_key = $_REQUEST['license_key'];

        delete_transient('targetdna_plugin_status');

        // API query parameters
        $api_params = array(
            'slm_action' => 'slm_activate',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $query = esc_url_raw(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL));
        $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => true));

        // Check for error in the response
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response

        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // TODO - Do something with it.
        //var_dump($license_data);//uncomment it to look at the data

        if($license_data->result == 'success'){//Success was returned for the license activation

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;

            //Save the license key in the options table
            update_option('license_key', $license_key);
        }
        else{
            //Show error to the user. Probably entered incorrect license key.

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;
        }

    }
    /*** End of license activation ***/

    /*** License activate button was clicked ***/
    if (isset($_REQUEST['deactivate_license'])) {
        $license_key = $_REQUEST['license_key'];

        // API query parameters
        $api_params = array(
            'slm_action' => 'slm_deactivate',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => $license_key,
            'registered_domain' => $_SERVER['SERVER_NAME'],
            'item_reference' => urlencode(YOUR_ITEM_REFERENCE),
        );

        // Send query to the license manager server
        $query = esc_url_raw(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL));
        $response = wp_remote_get($query, array('timeout' => 20, 'sslverify' => true));

        // Check for error in the response
        if (is_wp_error($response)){
            echo "Unexpected Error! The query returned with an error.";
        }

        //var_dump($response);//uncomment it if you want to look at the full response

        // License data.
        $license_data = json_decode(wp_remote_retrieve_body($response));

        // TODO - Do something with it.
        //var_dump($license_data);//uncomment it to look at the data

        if($license_data->result == 'success'){//Success was returned for the license activation

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;

            //Remove the licensse key from the options table. It will need to be activated again.
            update_option('license_key', '');
        }
        else{
            //Show error to the user. Probably entered incorrect license key.

            //Uncomment the followng line to see the message that returned from the license server
            echo '<br />The following message was returned from the server: '.$license_data->message;
        }

    }
    /*** End of sample license deactivation ***/

    ?>
    <p>Please enter your Klein New Media license key.</p>
    <form action="" method="post">
        <table class="form-table">
            <tr>
                <th style="width:100px;"><label for="license_key">License Key</label></th>
                <td ><input class="regular-text" type="text" id="license_key" name="license_key"  value="<?php echo get_option('license_key'); ?>" ></td>
            </tr>
        </table>
        <p class="submit">
            <input type="submit" name="activate_license" value="Activate" class="button-primary" />
            <input type="submit" name="deactivate_license" value="Deactivate" class="button" />
        </p>
    </form>
    <p>Contact <a href="mailto:support@kleinnewmedia.com?subject=KNM%20License%20Key">support@kleinnewmedia.com</a> to obtain a license.</p>
    <?php

    echo '</div>';
}

add_filter('widget_text', 'do_shortcode');



function set_status(){

    $slm_status = '';

    if( false === ( $slm_status = get_transient( 'targetdna_plugin_status' ) ) ) {

        $api_params = array(
            'slm_action' => 'slm_check',
            'secret_key' => YOUR_SPECIAL_SECRET_KEY,
            'license_key' => get_option('license_key'),
        );

        $response = wp_remote_get(add_query_arg($api_params, YOUR_LICENSE_SERVER_URL), array('timeout' => 20, 'sslverify' => true));

        if (!is_wp_error($response)) {
            $slm_status = json_decode($response['body'])->status;

            // var_dump($slm_status);

            $slm_status = set_transient( 'targetdna_plugin_status', $slm_status , 1800 );
            return $slm_status;

        } else {
            return;
        }

    } else {
        return $slm_status;
    }
// var_dump($doctors);


}




// Send query to the license manager server



// var_dump(json_decode($response['body'])->status);

// Start

// function add_reps_async_attribute($tag, $handle) {
//    $scripts_to_async = array( 'dk-lazyload' );
//    foreach($scripts_to_async as $async_script) {
//       if ($async_script !== $handle) return $tag;
//       return str_replace( ' src', ' async="async" src', $tag );
//   }
//   return $tag;
// }
// add_filter('script_loader_tag', 'add_reps_async_attribute', 10, 2);



// function dk_reps_add_async_attribute($tag, $handle) {
//    // add script handles to the array below
//  $scripts_to_async = array('bbq-tabs', 'slick-slider');

//  foreach($scripts_to_async as $async_script) {
//   if ($async_script === $handle) {
//    return str_replace(' src', ' async="async" src', $tag);
// }
// }
// return $tag;
// }
// add_filter('script_loader_tag', 'dk_reps_add_async_attribute', 10, 2);
}