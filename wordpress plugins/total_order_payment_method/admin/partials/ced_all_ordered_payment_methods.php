<!-- First section start here -->
<h1 style="text-align:center;">Store Details</h1>
<?php
echo "<table style='width: 700px;margin:0px auto;padding-top: 15px;'>";
    $store_address     = get_option( 'woocommerce_store_address' );
    $store_postcode    = get_option( 'woocommerce_store_postcode' );
    $store_raw_country = get_option( 'woocommerce_default_country' );
    $ddat = explode(":",$store_raw_country);
    $full_country_name = WC()->countries->countries[$ddat[0]]; 
    $full_state_name   = WC()->countries->states[$ddat[0]][$ddat[1]]; 
    $site_name = site_url();
    echo "<tr><th>Site Name : </th> <td> ". $site_name ."</td></tr>";
    echo "<tr><th>Country / State : </th> <td> ".$full_country_name." / ".$full_state_name." ( ". $store_raw_country ." )</td></tr>";
    echo "<tr><th>Postcode / ZIP : </th> <td> ". $store_postcode ."</td></tr>";
    // global  $woocommerce;
    echo "<tr><th>Store Currency : </th> <td> ". get_woocommerce_currency() ." ( ".get_woocommerce_currency_symbol()." )</td></tr>";
    echo "<tr><th>Store Location : </th> <td> ". $store_address ."</td></tr>";
echo "</table>";
?>

<!-- Second section start here -->

<h1 style="text-align:center;padding-top: 15px;">Total Payment Methods By Order</h1>

    <table border="1" style="padding:10px; margin:0px auto;width:700px;height:auto;box-shadow:5px 15px 10px lightgray;">
        <tr>
            <th>Sr.no</th>
            <th>Payment Method Name</th>
            <th>Total Orders By This Method</th>
            <th>Total Order Amount By This Method</th>
        </tr>

<?php
global $wpdb;
$tot_amnt_arr = array();
$Srno = 1;
global $wpdb;
$all_orders     = $wpdb->get_results( "SELECT ID FROM $wpdb->posts WHERE post_type = 'shop_order'", ARRAY_A );
$all_methods_arr = array();
foreach($all_orders as $ord_val){
    $order = wc_get_order( $ord_val['ID'] );
    $tot_amnt_arr[$order->get_payment_method_title()]+=$order->get_total();
    if( '' == $order->get_payment_method_title() || NULL == $order->get_payment_method_title() || empty( $order->get_payment_method_title() ) ) continue;
    $all_methods_arr[] = $order->get_payment_method_title();

}

$gateways = WC()->payment_gateways()->get_available_payment_gateways();
$all_enable_pay_meth = array();
foreach ( $gateways as $id => $gateway ) {
    $all_enable_pay_meth[$id] = $gateway->get_method_title();
}
$all_payment_method_count =  array_count_values( $all_methods_arr );

$used_pay_meth = array_unique( $all_methods_arr );

$not_used_pay_meth = array_diff($all_enable_pay_meth, $used_pay_meth);

foreach( $all_payment_method_count as $method_name => $count ){
    ?>
        <tr>
            <th><?php  echo $Srno; ?>        </th>
            <th><?php  echo $method_name; ?> </th>
            <th><?php  echo $count; ?>       </th>
            <?php
            if( array_key_exists($method_name,$tot_amnt_arr)){
            ?>
            <th><?php  echo $tot_amnt_arr[$method_name]; ?>       </th>
            <?php
            }
            ?>
        </tr>
    <?php
    $Srno++;
}
foreach($not_used_pay_meth as $unused_meth_data){
    ?>
    <tr>
        <th><?php  echo $Srno; ?>             </th>
        <th><?php  echo $unused_meth_data; ?> </th>
        <th><?php  echo "0"; ?>               </th>
        <th><?php  echo "0"; ?>               </th>
    </tr>
    <?php
    $Srno++;
}

?>

</table>