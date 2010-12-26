                   <h1><?php __('Registration - Step 2/2'); ?></h1>

                   <?php echo $this->element('js_error'); ?>

                   <div class="messagebox">
                   <?php __('Get your trainingplans FREE for 1 month. Then invest less than 3 cups of coffee worth per month for your
                   electronic trainingscoach. NO RISK, as we offer a 30-days money back garantuee.'); ?>
                   </div>

                   <br />

                   <?php echo $form->create('User', array('action' => 'add_step2')); ?>

                   <fieldset>
                   <legend><?php __('Fill in your training preferences'); ?></legend>

                   <?php if ($session->check('Message.flash')) { ?>
                   <div class="<?php echo $statusbox; ?>">
                   <?php $session->flash(); ?>
                   </div>
                   <?php } ?>
                   <br />

                   <h2><?php __('Sport preferences'); ?></h2>

<a href="#"><?php __('Details about Distances (Kilometers/Miles)'); ?></a><br />
<?php

$sporttype_array_metric = array(

                                 'Triathlon' => array (
                                             'Triathlon Ironman' => __('Ironman (3.8km swim, 180km bike, 42km run)', true),
                                             'Triathlon Half-Ironman' => __('Half-Ironman (1.9km swim, 90km bike, 21km run)', true),
                                             'Triathlon Olympic Distance' => __('Olympic Distance (1.5km swim, 40km bike, 10km run)', true),
                                             'Triathlon Sprint Distance' => __('Sprint Distance (0.75km swim, 20km bike, 5km run)', true)
                                 ),
                                 'Running' => array(
                                             'Run Ultra' => __('Ultrarun (> 50km run)', true),
                                             'Run Marathon' => __('Marathon (42km run)', true),
                                             'Run Half-Marathon' => __('Half-Marathon (21km run)', true),
                                             'Run 10-5k-Run' => __('Race (5-10km)', true)
                                 ),
                                 'Duathlon' => array(
                                             'Duathlon middle' => __('Duathlon (5km run, 40km bike, 10km run)', true),
                                             'Duathlon long' => __('Duathlon (10km run, 60km bike, 10km run)', true)
                                 ),
                                 'Bikeracing' => array(
                                             'Bike Racing short' => __('Races (up to 50km)', true),
                                             'Bike Racing middle' => __('Races (50-100km)', true),
                                             'Bike Racing long' => __('Races (100-150km)', true),
                                             'Bike Racing ultralong' => __('Races (over 150km)', true)
                                 )
                         );

// TODO convert
$sporttype_array_english = array(
                                 'Triathlon' => array (
                                             'Triathlon Ironman' => __('Ironman (3.8mi swim, 180mi bike, 42mi run)', true),
                                             'Triathlon Half-Ironman' => __('Half-Ironman (1.9mi swim, 90mi bike, 21mi run)', true),
                                             'Triathlon Olympic Distance' => __('Olympic Distance (1.5mi swim, 40mi bike, 10mi run)', true),
                                             'Triathlon Sprint Distance' => __('Sprint Distance (0.75mi swim, 20mi bike, 5mi run)', true)
                                 ),
                                 'Running' => array(
                                             'Run Ultra' => __('Ultrarun (> 50mi run)', true),
                                             'Run Marathon' => __('Marathon (42mi run)', true),
                                             'Run Half-Marathon' => __('Half-Marathon (21mi run)', true),
                                             'Run 10-5k-Run' => __('Race (5-10mi)', true)
                                 ),
                                 'Duathlon' => array(
                                             'Duathlon middle' => __('Duathlon (5mi run, 40mi bike, 10mi run)', true),
                                             'Duathlon long' => __('Duathlon (10mi run, 60mi bike, 10mi run)', true)
                                 ),
                                 'Bikeracing' => array(
                                             'Bike Racing short' => __('Races (up to 50mi)', true),
                                             'Bike Racing middle' => __('Races (50-100mi)', true),
                                             'Bike Racing long' => __('Races (100-150mi)', true),
                                             'Bike Racing ultralong' => __('Races (over 150mi)', true)
                                 )
                         );


//TODO function missing - you have no sessioninfo :(
// at this point - we do not have the unit information :(
$sporttype_array = $sporttype_array_metric;

echo $form->input('typeofsport',
                  array(
                  'legend' => false,
                  'label' => __('Your sport passion?', true),
                  'before' => '',
                  'after' => '',
                  'between' => '',
                  'options' => $sporttype_array
                  ));

// you can not extract this array and place it somewhere globally for re-use :( because of language-function __();
?>

<?php

echo $form->input('rookie',
                           array(
                           'before' => __('Are you a rookie in triathlon, running and biking? So, you want to start from the beginning?', true),
                           'after' => '',
                           'between' => '',
                           'legend' => false,
                           'type' => 'radio',
                           'default' => '0',
                           'multiple' => false,
                           'options' => array(
                           '1' => 'Yes',
                           '0' => 'No'
     )
));
?>
<br /><br />
<?php
echo $form->input('medicallimitations',
                                       array(
                                       'before' => __('Do you have any medical impacts preventing you from doing sports or did your doctor told you not to do any sports? Please talk to your doctor BEFORE starting your training!', true),
                                       'after' => '',
                                       'between' => '',
                                       'legend' => false,
                                       'type' => 'radio',
                                       'multiple' => false,
                                       'default' => '0',
                                       'options' => array(
                                       '1' => 'Yes',
                                       '0' => 'No'
     )
));

?>

<div class="messagebox">
<?php __('Help user somehow - how many ours for IM, Half-IM etc. Should be calculated by various factors (rookie, type of sport)'); ?>
</div>

Translation?
<?php echo $html->link("Training hours calculator", array('action' => 'traininghours_calc'),array('rel' => 'facebox[.bolder]'),null) ?>

<?php

echo $form->input('weeklyhours',
     array(
     'before' => '',
     'after' => '',
     'between' => '',
     'maxLength' => 255,
     'default' => '10',
     'error' => array('wrap' => 'div', 'style' => 'color:red'),
     'label' => __('Weekly hours', true)
//     'default' => __('Enter Lastname here', true)
));

?>

<?php

echo $form->input('dayofheaviesttraining',
                  array(
                  'legend' => false,
                  'label' => __('Day of heaviest training', true),
                  'before' => '',
                  'after' => '',
                  'between' => '',
                  'default' => 'FRI',
                  'options' => array(
                                 'MON' => __('Monday', true),
                                 'TUE' => __('Tuesday', true),
                                 'WED' => __('Wednesday', true),
                                 'THU' => __('Thursday', true),
                                 'FRI' => __('Friday', true),
                                 'SAT' => __('Saturday', true),
                                 'SUN' => __('Sunday', true)
                                 )));
?>

<?php __('For calculating your saison'); ?>
<br />
<?php
echo $form->input('coldestmonth', array(
                                  'before' => '',
                                  'after' => '',
                                  'between' => '',
                                  'label' => __('Coldest month', true),
                                  'options' => array(
                                  '1' => __('January',true),
                                  '2' => __('February',true),
                                  '3' => __('March',true),
                                  '4' => __('April',true),
                                  '5' => __('May',true),
                                  '6' => __('June',true),
                                  '7' => __('July',true),
                                  '8' => __('August',true),
                                  '9' => __('September',true),
                                  '10' => __('October',true),
                                  '11' => __('November',true),
                                  '12' => __('December',true)
                                 )));
?>

<a href="#">Hint how to measure?</a>

<?php

//echo __('Calculate automatically');

echo $form->input('maximumheartrate',
     array(
     'before' => '',
     'after' => '',
     'between' => '',
     'maxLength' => 255,
     'default' => (220-$age),
     'error' => array('wrap' => 'div', 'style' => 'color:red'),
     'label' => __('Your maximum heart rate', true)
));

?>
                   <br />
                   <div class="messagebox">
                   <?php __('Your Lactate Threshold Heart Rate (estimated)'); ?>
                   <br />
                   <?php echo round((220-$age)*0.85); ?>
                   </div>
<br />
                      <h2><?php __('Metric preferences'); ?></h2>

<?php

echo $form->input('unit', array(
                                 'before' => '',
                                 'after' => '',
                                 'between' => '',
                                 'label' => __('<b>Unit</b>', true),
                                 'options' => array(
                                 'metric' => __('Metric (Kilometres, Kilograms, Centimeters)', true),
                                 'english' => __('English (Miles, Pounds, Feet)', true)
                                 )));

echo $form->input('unitdate', array(
                                 'before' => '',
                                 'after' => '',
                                 'between' => '',
                                 'label' => __('Dateformat', true),
                                 'options' => array(
                                 'ddmmyyyy' => __('DD.MM.YYYY', true),
                                 'mmddyyyy' => __('MM.DD.YYYY', true),
                                 'yyyymmdd' => __('YYYY-MM-DD', true)
                                 )));

echo $form->input('yourlanguage', array(
                                  'before' => '',
                                  'after' => '',
                                  'between' => '',
                                  'label' => __('Your language', true),
                                  'options' => array (
                                            'ger' => __('German',true),
                                            'eng' => __('English',true)
                                  )));

$payed_from = date( "Y-m-d", time() );
$payed_to = date( "Y-m-d", time() + (30*24*60*60) );

echo $form->input( 'payed_from', array('type' => 'hidden', 'value' => $payed_from));
echo $form->input( 'payed_to', array('type' => 'hidden', 'value' => $payed_to));

echo $form->hidden('id');

?>
                   <br />
                   <div class="messagebox">
                   <?php __('You MUST have a heart rate monitor like') . ' ' . '<a href="http://www.amazon.de/gp/product/B001NGOYMU?ie=UTF8&tag=trico-21&linkCode=as2&camp=1638&creative=6742&creativeASIN=B001NGOYMU" target="_blank">POLAR</a> ' . __('for your training as we offer heart rate oriented trainingplans.') ?>
                   <br /><br />
                   <center>
                   <a href="http://www.amazon.de/gp/product/B001NGOYMU?ie=UTF8&tag=trico-21&linkCode=as2&camp=1638&creative=6742&creativeASIN=B001NGOYMU" target="_blank"><img border="0" src="https://images-na.ssl-images-amazon.com/images/I/41WA91iWQBL._SL110_.jpg" alt="Heart rate monitor" /></a><img src="http://www.assoc-amazon.de/e/ir?t=trico-21&l=as2&o=3&a=B001NGOYMU" width="1" height="1" border="0" alt="" style="border:none !important; margin:0px !important;" />
                   </center>

                   <br />
                   </div>

                   <br />

                   <div class="messagebox" style="overflow:auto; width: 420px; height: 200px;">

                   <?php echo $this->element('tos'); ?>

                   <br />
                   </div>

<br /><br />

<?php
/** not finished **/

echo $form->hidden('id');
echo $form->hidden('birthday');

echo $form->submit('Finish submitting registration');

?>
                 <br />

                 </fieldset>

<?php
      echo $form->end();
?>

<?php

      $this->js_addon = <<<EOE
<script type="text/javascript">

/** initiate JQuery **/

\$(document).ready(function() {

        // facebox box
        $('a[rel*=facebox]').facebox();

});

</script>

EOE;

?>