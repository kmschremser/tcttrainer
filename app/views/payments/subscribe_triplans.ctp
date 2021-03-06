      <div class="panel panel-default" id="forms">
        <div class="panel-heading"><h1><?php __('Subscribe to TriCoreTraining PREMIUM membership'); ?></h1></div>
        
        <div class="panel-body">

         <?php echo $this->element('js_error'); ?>

         <?php echo $form->create('User', array('action' => '#','class' => 'form-horizontal')); ?>
         <fieldset>
         <legend><?php __('Horay! You are a hero!'); ?></legend>

         <?php if ($session->read('flash')) { ?>
         <div class="<?php echo $statusbox; ?>">
         <?php echo $session->read('flash'); $session->delete('flash'); ?>
         </div><br />
         <?php } ?>

         <div class="alert alert-success">
         <?php echo __('Your current membership is valid from', true) . ' ' . $paid_from . ' ' . __('to', true) . ' ' . $paid_to; ?>.<br />
         <?php __("You're a"); echo ' '; if ( $pay_member == 'freemember' ) echo __('FREE member'); else echo __('PREMIUM member'); ?>
         </div>

         <br />

<?php

if ( $pay_member == 'freemember' || $_SERVER['HTTP_HOST'] == LOCALHOST )
{

?>
	
<table summary="<?php __('All possible subscriptions'); ?>" class="table table-striped table-bordered table-condensed">
<colgroup>
          <col class="colA">
          <col class="colB">
          <col class="colC">
</colgroup>
<thead>
<tr>
    <th colspan="3"><h2><?php __('Click to subscribe for a PREMIUM membership'); ?></h2></th>
</tr>
<?php

$price_array = $unitcalc->get_prices( null, $currency, $userobject );
$price_array_split = $price_array[$currency]['total'];
$price_month_array_split = $price_array[$currency]['month'];

$price1m[$currency] = $price_array_split[0];
$price1pm[$currency] = $price_month_array_split[0];
$price3m[$currency] = $price_array_split[1];
$price3pm[$currency] = $price_month_array_split[1];
$price6m[$currency] = $price_array_split[2];
$price6pm[$currency] = $price_month_array_split[2];
$price12m[$currency] = $price_array_split[3];
$price12pm[$currency] = $price_month_array_split[3];

?>
<tr>
    <td colspan="3">
    <a class="btn btn-primary" href="<?php echo Configure::read('App.serverUrl'); ?>/payments/initiate/t:1">
    <b>1 <?php __('month(s)'); __('TriCoreTraining plans'); ?></b><br />
    <?php __('for ONLY'); ?> <?php echo $price1m[$currency]; ?> <?php echo $currency; ?> 
    <?php if ( isset( $userobject['inviter'] ) && preg_match('/@/', $userobject['inviter'] ) ) echo '(30% ' . __('discount', true) . ')'; ?>
    </a>
    </td>
</tr>
<!--//
<tr class="odd">
    <td colspan="3">
    <a class="btn btn-primary" href="<?php echo Configure::read('App.serverUrl'); ?>/payments/initiate/t:3">
    <b>3 <?php __('month(s)'); __('TriCoreTraining plans'); ?></b><br />
    <?php __('for ONLY'); ?> <?php echo $price3m[$currency]; ?> <?php echo $currency; ?> (<?php echo $price3pm[$currency]; ?> <?php echo $currency; ?> <?php __('per month'); ?>)
    <?php if ( isset( $userobject['inviter'] ) && preg_match('/@/', $userobject['inviter'] ) ) echo '(30% ' . __('discount', true) . ')'; ?>
    </a>
    </td>
</tr>
<tr>
    <td colspan="3">
    <a class="btn btn-primary" href="<?php echo Configure::read('App.serverUrl'); ?>/payments/initiate/t:6">
    <b>6 <?php __('month(s)'); __('TriCoreTraining plans'); ?></b><br />
    <?php __('for ONLY'); ?> <?php echo $price6m[$currency]; ?> <?php echo $currency; ?> (<?php echo $price6pm[$currency]; ?> <?php echo $currency; ?> <?php __('per month'); ?>)
    <?php if ( isset( $userobject['inviter'] ) && preg_match('/@/', $userobject['inviter'] ) ) echo '(30% ' . __('discount', true) . ')'; ?>
    </a>
    </td>
</tr>
//-->
<tr class="odd">
    <td colspan="3">
    <a class="btn btn-primary" href="<?php echo Configure::read('App.serverUrl'); ?>/payments/initiate/t:12">
    <b>12 <?php __('month(s)'); __('TriCoreTraining plans'); ?></b><br />
    <?php __('for ONLY'); ?> <?php echo $price12m[$currency]; ?> <?php echo $currency; ?> (<?php echo $price12pm[$currency]; ?> <?php echo $currency; ?> <?php __('per month'); ?>)
    <?php if ( isset( $userobject['inviter'] ) && preg_match('/@/', $userobject['inviter'] ) ) echo '(30% ' . __('discount', true) . ')'; ?>
    </a>
    </td>
</tr>
</tbody>
</table>

<?php

}

?>

<img alt="<?php __('PAYPAL - secure payment solutions'); ?>" src="<?php echo Configure::read('App.serverUrl'); ?>/img/paypal_logo.gif" />

<?php __('What is PAYPAL? It is a reputable and well-known payment provider (owned by e-Bay) and provides creditcard/payment
solutions for websites. You send your necessary confidential payment information via a secure connection (at least 128-bit encrypted SSL-connection)
and provide these confidential data only to PAYPAL and NOT to us (we only receive your payment).'); ?>
<br /><br />
<a target="_blank" href="http://www.paypal.com">&raquo; Paypal-<?php __('Website'); ?> (www.paypal.com)</a>

<br /><br />

<?php __('Your trial period will be added if you subscribe to a PREMIUM membership.'); ?>
<br />

                </fieldset>

<?php
      echo $form->end();
?>
        </div>
      </div>

<?php

      $this->js_addon = <<<EOE
<script type="text/javascript">

/** initiate JQuery **/

\$(document).ready(function() {

        // facebox box
        //\$('a[rel*=facebox]').facebox();

});

</script>

EOE;

?>