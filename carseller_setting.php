<?php 





// create custom plugin settings menu
add_action('admin_menu', 'package_setting_menu');

function package_setting_menu() {

  //create new top-level menu

  add_submenu_page( 'edit.php?post_type=carsellers', 'Setting', 'Setting', 'manage_options', 'package_setting', 'baw_settings_page' );
  
  add_action( 'admin_init', 'register_package_settings' );
}


function register_package_settings() {
  //register our settings
  register_setting( 'package-settings-group', 'admin_email' );

register_setting( 'package-settings-group', 'currency_code' );


}

function baw_settings_page() {
?>
<div class="wrap">
<h2>Car Seller Settings</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'package-settings-group' ); ?>
    <?php do_settings_sections( 'package-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Admin Email ID</th>
        <td><input type="text" name="admin_email" value="<?php echo esc_attr( get_option('admin_email') ); ?>" style=" width: 329px;height: 37px;"/>
        <br><span>This user will receive all mails from request information.</span>
        </td>
        </tr>


        <tr valign="top">
        <th scope="row">Currency</th>

        <?php 
        $currency=array('US Dollar'=>array('symbol'=>'$','suffix'=>'USD'),
                        'British Pound'=>array('symbol'=>'£','suffix'=>'GBP'),
                        'Euro'=>array('symbol'=>'€','suffix'=>'EUR'),
                        'Rupees'=>array('symbol'=>'₹','suffix'=>'INR'),
                        
                        );
        ?>
        <td>
          <select name="currency_code" style=" width: 329px;height: 37px;">

          <?php 
         $currency_code=esc_attr( get_option('currency_code') );

         foreach ($currency as $key => $value) {
            // print_r($value);
          if($currency_code==$value["suffix"])
           echo '<option value="'.$value["suffix"].'" selected>'.$key.' ('.$value["symbol"].')</option>';
         else
            echo '<option value="'.$value["suffix"].'" >'.$key.' ('.$value["symbol"].')</option>';
         }
            
         ?>
          </select>

        </td>
        </tr>



         
       
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } 
add_action( 'admin_init', 'get_currency_symbol' );
function get_currency_symbol()
{
   $currency=array('US Dollar'=>array('symbol'=>'$','suffix'=>'USD'),
                        'British Pound'=>array('symbol'=>'£','suffix'=>'GBP'),
                        'Euro'=>array('symbol'=>'€','suffix'=>'EUR'),
                        'Rupees'=>array('symbol'=>'₹','suffix'=>'INR'),
                        );
$currency_code=esc_attr( get_option('currency_code') );
   foreach ($currency as $key => $value) {
    if($currency_code==$value["suffix"])
    {
      $currency_symbol=array('suffix'=>$value["suffix"], 'symbol'=>$value["symbol"],'name'=>$key);
    }
   }
   return $currency_symbol;

}
?>