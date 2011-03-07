<style type="text/css">
    .traffic-light { float:left; margin-right: 30px; background-color: #333; }
    .traffic-light .color { width: 60px; height: 60px; margin: 12px; -moz-border-radius: 30px; -webkit-border-radius: 30px; background-color: grey; cursor: pointer; }
    .traffic-light .color.red.on { background-color: red; }
    .traffic-light .color.yellow.on { background-color: yellow; }
    .traffic-light .color.green.on { background-color: green; }
    #traffic-light-1 { left: 50px; }
    #traffic-light-2 { left: 200px; }
    #traffic-light-3 { left: 350px; }
    #traffic-light-speed { width: 31px; }
</style>

                   <h1><?php __('Statistics'); ?></h1>

                   <?php echo $form->create('Trainingstatistic', array('action' => 'statistics_competition')); ?>
                   <fieldset>
                   <legend><?php __('What have I done?'); ?></legend>

                   <?php if ($session->check('Message.flash')) { ?>
                   <div class="<?php echo $statusbox; ?>">
                   <?php $session->flash(); ?>
                   </div><br />
                   <?php } ?>

                   <?php __('This statistic shows you whether you can finish your next competition. The signal light leads you the way.'); ?> 
                   <a target="statistics" href="/blog/<?php if ( $locale == 'eng' || $locale == '' ) { ?>en<?php } else { ?>de<?php } ?>/do-i-have-trained-enough-for-my-competition/"><?php __('Explanation on these statistics in our blog?'); ?></a>
                   <br /><br />

                   <div>
<?php

echo $form->input('sportstype',
                  array(
                  'legend' => false,
                  'label' => __('Type of Training', true),
                  'before' => '',
                  'after' => '',
                  'between' => '',
                  'options' => array(
                                 '' => __('All', true),
                                 'RUN' => __('Run', true),
                                 'BIKE' => __('Bike', true),
                                 //'MTB' => __('Mountain-Bike', true),
                                 'SWIM' => __('Swim', true)
                                 //'STRENGTH' => __('Strength', true),
                                 //'MISC' => __('Misc', true)
                                 )));

/** not finished **/

echo $form->hidden('id');
echo $form->hidden('user_id');

echo $form->submit(__('Display',true), array('name' => 'display'));

?>
             </div>

<br /><br />
<!-- 
thanks to 
http://www.rodpetrovic.com/jquery/behavior/
-->
<?php

if ( !isset( $total_trimp_tp ) || $total_trimp_tp == 0 )
{
?>
    <?php __('No training information available. Start training and then come back!'); ?>
<?php
} else
{  
?>
<table width="100%">
<tr>
    <td>
    <div class="traffic-light">
         <div class="color red <?php if ( $color == 'red' ) echo 'on'; ?>"></div>
         <div class="color yellow <?php if ( $color == 'orange' ) echo 'on'; ?>"></div>
         <div class="color green <?php if ( $color == 'green' ) echo 'on'; ?>"></div>
    </div>
    </td>
    <td style="vertical-align: top;">
    <?php __('In this season you should have reached training impulse (TRIMP): '); ?> <b><?php echo $total_trimp_tp; ?></b><br /><br />
    <?php __('In this season you already reached this training impulse (TRIMP): '); ?> <b><?php echo $total_trimp; ?></b><br /><br />
    <?php __('Percentage: '); echo $trafficlight_percent . ' %'; ?><br /><br />
    <?php 
    echo "<span style=\"color:green;\">";
    __('Green');
    echo "</span> ";
    __('means'); 
    echo ", "; 
    __('you reach your goal.'); 
    echo '<br />';
    echo "<span style=\"color:orange;\">";
    __('Orange');
    echo "</span> ";
    __('means'); 
    echo ", ";
    __('you are currently under- or overperforming.');
    echo '<br />';
    echo "<span style=\"color:red;\">";
    __('Red');
    echo "</span> ";
    __('means'); 
    echo ", ";
    __("you didn't do enough or too much. You can't finish your competition.");
    ?>
    </td>
</tr>
</table>
<?php
}
?>

                 </fieldset>
<?php

      echo $form->end();

?>

<?php

      $this->js_addon = '';

?>