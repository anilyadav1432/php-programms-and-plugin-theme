<?php
if(isset($_POST['submit_token'])){
    $option_name1 = 'app_token_option' ;
    $new_value = $_POST['token_input'];
    if(isset($new_value))
    {
        if ( get_option( $option_name1 ) !== false) {       
            // The option already exists, so update it.
            update_option( $option_name1, $new_value );
        } else {
            $deprecated = null;
            $autoload = 'no';
            add_option( $option_name1, $new_value, $deprecated, $autoload );
        }
    }
}


if(isset($_POST['submit_app_key'])){
    $option_name3 = 'app_key_option';
    $app_key = $_POST['app_key'];
    if (get_option( $option_name2 ) !== false){
        update_option( $option_name2, $new_value );
    }else{
        $deprecated = null;
            $autoload = 'no';
        add_option( $option_name2, $app_key, $deprecated, $autoload );
    }
}

if(isset($_POST['submit_app_secret'])){
    $option_name2 = 'app_secret_option';
    $app_secret = $_POST['app_secret'];
    if (get_option( $option_name3 ) !== false){
        update_option( $option_name3, $new_value );
    }else{
        $deprecated = null;
            $autoload = 'no';
        add_option( $option_name3, $app_secret, $deprecated, $autoload );
    }
}

?> 
    <div>
        <!-- FORM For save app Token -->
        <h2>Dropbox Token Keys</h2>
        <form method="post" action="">
            <table>
                <tr valign="top">
                    <th scope="row"><label for="token_input">Token</label></th>
                    <td><input type="text" id="token_input" name="token_input" value=""/></td>
                </tr>
            </table>
            <input type="submit" value="save Token" name="submit_token">
            <?php  
            // submit_button();
            ?>
        </form>

        <!-- FORM For save app key -->
        <h2>Dropbox App Key</h2>
        <form action="" method="post">
            <table>
                <tr valign="top">
                    <th scope="row"><label for="app_key">App Key</label></th>
                    <td><input type="text" id="app_key" name="app_key" value="<?php  echo !empty(get_option( 'app_key_option' ))?get_option( 'app_key_option' ):"";  ?>" /></td>
                </tr>
            </table>
            <input type="submit" value="save App Key" name="submit_app_key">
        </form>
        
        <!-- FORM For save app secret -->
        <h2>Dropbox App Secret</h2>
        <form action="" method="post">
            <table>
                <tr valign="top">
                    <th scope="row"><label for="app_secret">App secret</label></th>
                    <td><input type="text" id="app_secret" name="app_secret" value="<?php  echo !empty(get_option( 'app_secret_option' ))?get_option( 'app_secret_option' ):"";  ?>"/></td>
                </tr>
            </table>
            <input type="submit" value="save App Secret" name="submit_app_secret">
        </form>

    </div>
<?php

?>