
<?php __('Welcome'); ?> <?php if ( isset( $to_name ) ) echo $to_name; else echo $user['User']['firstname']; ?>,

<?php __('30 Cents a day and you get your professional interactive training coach.'); ?>

<?php __('Gain speed, loose weight!'); __('Go to TriCoreTraining.com and subscribe to a membership for less than 10 bucks!'); ?>

<?php __('Yes, I\'ll do!'); ?>
<?php echo Configure::read('App.hostUrl'); echo Configure::read('App.serverUrl'); ?>/payments/subscribe_triplans/
                           
<?php __('Yours, Clemens'); ?>

<?php echo $this->element('email/newsletter_text_footer'); ?>
