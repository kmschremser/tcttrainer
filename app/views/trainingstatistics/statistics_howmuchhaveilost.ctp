      <div class="panel panel-default" id="forms">
        <div class="panel-heading"><h1><?php __('Statistics'); ?></h1></div>
        
        <div class="panel-body">

           <?php echo $form->create('Trainingstatistic', array('action' => 'statistics_howmuchhaveilost','class' => 'form-horizontal')); ?>
           <fieldset>
           <legend><?php __('How much have I lost?'); ?></legend>

           <?php if ($session->read('flash')) { ?>
           <div class="<?php echo $statusbox; ?>">
           <?php echo $session->read('flash'); $session->delete('flash'); ?>
           </div><br />
           <?php } ?>
           
           <?php __('This statistics shows you your weight-history and the way to your weight targets.'); ?>
           <a target="statistics" href="/blog/<?php if ( $language == 'eng' || $language == '' ) { ?>en<?php } else { ?>de<?php } ?>/what-do-i-learn-from-the-statistics/"><?php __('Explanation on these statistics in our blog?'); ?></a>
           <br /><br />

<div class="form-group">
<?php

echo $form->input('fromdate',
                    array(
                    'type' => 'date',
                    'before' => '',
                    'after' => '',
                    'between' => '',
                    'class' => 'form-control',
                    'label' => __('From', true),
                    'minYear' => date('Y',time())-5,
                    'maxYear' => date('Y',time())
                    //'error' => array('wrap' => 'div', 'style' => 'color:red')
));
?>
</div>

<div class="form-group">
<?php
echo $form->input('todate',
                    array(
                    'type' => 'date',
                    'before' => '',
                    'after' => '',
                    'between' => '',
                    'class' => 'form-control',
                    'label' => __('To', true),
                    'minYear' => date('Y',time())-5,
                    'maxYear' => date('Y',time())
                    //'error' => array('wrap' => 'div', 'style' => 'color:red')
));
                  
echo $form->hidden('id');
echo $form->hidden('user_id');
?>
<br />
<?php 
echo $form->submit(__('Display',true), array('name' => 'display', 'class' => 'btn btn-primary'));
?>
</div>
                   </fieldset>
<?php
      echo $form->end();
?>

<?php
$chart_haxis = $weight_unit;
$chart_vaxis = __('Time', true);

$chart_color1 = '#06FF02';
$chart_color2 = '#F1AD28';

?>

<script type="text/javascript">

      google.load('visualization', '1', {packages: ['corechart']});

      function getJSONdata( jsonurl, chart ) { 
          jQuery.ajax({
              url: jsonurl,
              type: 'POST',
              success: function (data, textStatus, jqXHR) {
                //alert(data.toString());
                //alert(textStatus.toString());
                //alert(jqXHR.responseText);

                var data = jQuery.parseJSON(jqXHR.responseText);
                var graphdata = [['<?php __('Time');?>', '<?php __('Weight'); ?> (<?php echo $weight_unit; ?>)', '<?php __('Weight planned'); ?> (<?php echo $weight_unit; ?>)']];

                jQuery.each(data.results, function(i, jsonobj) {
                    graphdata.push([jsonobj.tcttime, jsonobj.tctdata1, jsonobj.tctdata2]);
                });
                
                drawVisualization(graphdata, chart);
              }, error: function (data, textStatus, jqXHR) { 
                //alert(textStatus); 
                console.log( "JSON Data: ERROR"  );
              }
          });            
      }

      function drawVisualization(jsdata, chart) {
          console.log(jsdata);
          //jsdata = jsdata_title.concat(jsdata);
          
          var data = google.visualization.arrayToDataTable( jsdata );
        
          // Create and draw the visualization.
          var ac = new google.visualization.AreaChart(document.getElementById(chart));

          var graph_width = 700;
          var graph_height = 490;

          if ( window.innerWidth <= 1200 ) { 
            graph_width = 550; 
            graph_height = 450; 
          }   

          if ( window.innerWidth <= 992 ) { 
            graph_width = 350; 
            graph_height = 350; 
          }   

          if ( window.innerWidth <= 768 ) { 
            graph_width = 500; 
            graph_height = 400; 
          }   

          if ( window.innerWidth <= 400 ) { 
            graph_width = 270; 
            graph_height = 300; 
          }  
          
          // read size of div - write in variable and set here
          ac.draw(data, {
            //title : 'A vs. C',
            //isStacked: true,
            colors: ['<?php echo $chart_color1; ?>', '<?php echo $chart_color2; ?>'],
            pointSize: 0,
            width: graph_width,
            height: graph_height,
            legend: { position: 'top' },
            chartArea: {'width': '80%', 'height': '65%'},
            vAxis: { title: "<?php echo $chart_haxis; ?>",  
              slantedText:true, slantedTextAngle:45 },
            hAxis: { title: "<?php echo $chart_vaxis; ?>" }
          });
      }
      
</script>

<h2><?php __('Weight Statistics'); ?></h2>

<?php

if ( count( $trainings ) > 1 ) 
{
    
    $jsonurl = Configure::read('App.hostUrl') . Configure::read('App.serverUrl') . '/trainingstatistics/statistics_howmuchhaveilost_json/type:weight/start:' . $start . '/end:' . $end;

?>
<script language="JavaScript">
function get_weight() {
  getJSONdata('<?php echo $jsonurl; ?>','chart1');
}

google.setOnLoadCallback(get_weight);
</script>

<?php 
} else
{
    $jsonurl = '#';
    __('No Chart data.');
}

?>

<div id="chart1"></div>

<!--
<?php if ( $_SERVER['HTTP_HOST'] == LOCALHOST ) { ?>
<br /><br /><br /><br /><br /><br />
Debugging: (only localhost)<br />
<a target="_blank" href="<?php echo $jsonurl; ?>"><?php echo $jsonurl; ?></a>
<?php } ?>

<br /><br /><br /><br /><br /><br /><br /><br />
-->

        </div>
      </div>

<?php

      $this->js_addon = '';

?>