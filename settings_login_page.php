<!-- Create a wrapper -->
  <div class="wrap">

    <!-- Headers -->
    <h1>Change the login page</h1>



    <!-- Create the form -->
    <form method="post" action="options.php">

      <?php
        //Get the settings fields
        settings_fields( 'change_login_options_group' );
        do_settings_sections( 'change_login_options_group' );
      ?>

      <!-- Section background settings -->
      <h3>Background settings</h3>
      <table class="form-table">
        <tr valign="top">

          <!-- select the primary color -->
          <th scope="row">Select background image</th>
          <td>
            <input type="text" id="clp_background_url" name="clp_background_url" value="<?php echo esc_attr( get_option('clp_background_url') ); ?>" />
            <input type="button" name="upload-btn" id="upload-background-btn" class="button-secondary" value="Upload background image">
            <p class="description"><i>The background image will appear on the WordPress login page.</i></p>
          </td>
        </tr>
      </table>

      <!-- Section logo settings -->
      <h3>Logo settings</h3>
      <table class="form-table">
        <tr valign="top">

          <!-- Upload the logo -->
          <th scope="row">Select logo</th>
          <td>
            <input type="text" id="clp_logo_url" name="clp_logo_url" value="<?php echo esc_attr( get_option('clp_logo_url') ); ?>" />
            <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Logo">
            <p class="description"><i>The logo will appear on the WordPress login page.</i></p>
          </td>
        </tr>

        <!-- Change the logo height -->
        <tr valign="top">
          <th scope="row">Select logo height</th>
          <td>
            <input type="number" name="clp_logo_height" value="<?php echo esc_attr( get_option('clp_logo_height') ); ?>" />
          </td>
        </tr>

        <!-- Change the logo width -->
        <tr valign="top">
          <th scope="row">Select logo width</th>
          <td>
            <input type="number" name="clp_logo_width" value="<?php echo esc_attr( get_option('clp_logo_width') ); ?>" />
          </td>
        </tr>
      </table>

      <!-- Section text settings -->
      <h3>Text settings</h3>
      <table class="form-table">
        <tr valign="top">

          <!-- select the primary color -->
          <th scope="row">Select the text color</th>
          <td>
            <input type="color" name="clp_text_color" value="<?php echo esc_attr( get_option('clp_text_color') ); ?>" />
          </td>
        </tr>

      </table>

      <!-- Section button settings -->
      <h3>Button settings</h3>
      <table class="form-table">
        <tr valign="top">

          <!-- select the primary color -->
          <th scope="row">Select primary background color</th>
          <td>
            <input type="color" name="clp_primary_color" value="<?php echo esc_attr( get_option('clp_primary_color') ); ?>" />
          </td>
        </tr>

        <tr valign="top">

          <!-- select the primary textcolor -->
          <th scope="row">Select primary text color</th>
          <td>
            <input type="color" name="clp_primary_text_color" value="<?php echo esc_attr( get_option('clp_primary_text_color') ); ?>" />
          </td>
        </tr>
      </table>


      <!-- Submit the logo -->
      <?php submit_button(); ?>
    </form>

    <!-- jQuery for upload logo -->
    <script type="text/javascript">

    // When the user clicks on the upload button
    jQuery(document).ready(function($){
      $('#upload-btn').click(function(e) {
        e.preventDefault();

        // Get the image
        var image = wp.media({
          title: 'Upload Logo',
          multiple: false
        }).open()
        .on('select', function(e){

          // Set the value to the field
          var uploaded_image = image.state().get('selection').first();
          var image_url = uploaded_image.toJSON().url;
          $('#clp_logo_url').val(image_url);
        });
      });
    });

    // When the user clicks on the upload button
    jQuery(document).ready(function($){
      $('#upload-background-btn').click(function(e) {
        e.preventDefault();

        // Get the image
        var image = wp.media({
          title: 'Upload background image',
          multiple: false
        }).open()
        .on('select', function(e){

          // Set the value to the field
          var uploaded_image = image.state().get('selection').first();
          var image_url = uploaded_image.toJSON().url;
          $('#clp_background_url').val(image_url);
        });
      });
    });
  </script>
  </div>
