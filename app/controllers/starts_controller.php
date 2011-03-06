<?php

class StartsController extends AppController 
{
	var $name = 'Starts';
	// use no model
	var $uses = null;
	var $useTable = false;

	var $helpers = array('Html', 'Form', 'Javascript', 'Time', 'Session', 'Unitcalc'); // 'TabDisplay',
	var $components = array('Cookie', 'RequestHandler', 'Session', 'Unitcalc', 'Filldatabase', 'Transactionhandler' );

	function beforeFilter()
	{
  		parent::beforeFilter();
  		$this->layout = 'trainer_start';
	}

	function index( $language = 'en' )
	{
      	$this->pageTitle = __('the interactive, online training plan service for run, bike and triathlon athletes ', true);

		if ( isset( $language ) )
		{
			if ( $language == 'de' ) $this->code = 'deu';
			else $this->code = 'eng';
			
			$this->Session->write('Config.language', $this->code);
		}
		
      	if ( isset( $this->params['named']['u'] ) ) 
      	{
      		$transaction_id = $this->params['named']['u'];
			
			// information is saved in transactions
			$this->loadModel('Transaction');
	
			$transaction_content = $this->Transactionhandler->handle_transaction( $this->Transaction, $transaction_id, 'read' );
    		$dt = unserialize($transaction_content['sm_recommend']);
			
			$distance = $dt['distance'];
			$duration = $dt['duration'];
			$distance_unit = $dt['distance_unit'];
			$sport = $dt['sport'];
			$userid = $dt['userid'];

			// create title
			$title = __('I did a', true) . ' ' . $distance . ' ' . $distance_unit . ' ' . 
				__($sport . ' workout', true) . ' ' . __('in',true) . ' ' . $duration . ' ' . 
				__('hour(s)',true) . ' ' . __('with', true) . ' ' . 'http://tricoretraining.com';
				 
			// read userinformation
			$this->loadModel('User');
			$results = $this->User->findById( $userid );
						
			$this->set('distance', $distance);
			$this->set('distance_unit', $distance_unit);
			$this->set('duration', $duration);
			$this->set('sport', $sport);
			$this->set('userinfo', $results['User']);
			$this->set('title', $title);
			
			$this->Session->write('recommendation_userid', $results['User']['id']);
					
      	} elseif ( isset( $this->params['named']['ur'] ) ) 
      	{
 			$userid = base64_decode( $this->params['named']['ur'] );
			$this->loadModel('User');
			$results = $this->User->findById( $userid );

			$this->set('userinfo', $results['User']);
			$this->Session->write('recommendation_userid', $results['User']['id']);
			
		// these users get money for new users
      	} elseif ( isset( $this->params['named']['urm'] ) ) 
      	{
 			$userid = base64_decode( $this->params['named']['urm'] );
			$this->loadModel('User');
			$results = $this->User->findById( $userid );

			$this->set('userinfo', $results['User']);
			$this->Session->write('recommendation_userid', 'money:' . $results['User']['id']);
			
 		} elseif ( isset( $this->params['named']['c'] ) )
 		{
 			$company_email = base64_decode( $this->params['named']['c'] );
			//echo base64_encode( '@gentics.com' );
			if ( isset( $company_email ) )
			{ 
				$this->Session->write('recommendation_userid', $company_email);
				$this->set( 'companyinfo', $company_email );
			}
			
		} elseif ( $this->Session->read('session_userid') )
            $this->redirect('/trainingplans/view');
     

	}
  
  function error404()
  {
    $this->layout = 'default_trainer';
  }
  
  function features()
  {
    $this->layout = 'default_trainer';
	$this->set('statusbox', 'statusbox');
  }

	function change_language()
	{

		if ( isset( $this->params['named']['code'] ) ) 
			$this->code = $this->params['named']['code'];
		else
			$this->code = 'eng';

	    if ( $this->Session->read('session_userid') )
	    {
				$this->loadModel('User');
	
				$this->User->id = $this->Session->read('session_userid');
				$this->User->savefield('yourlanguage', $this->code, false);
	    }

		$this->Session->write('Config.language', $this->code);
		$this->Session->setFlash(__('Language changed.',true));

		if ( $this->referer() ) 
		    $this->redirect($this->referer());
	    else 
	        $this->redirect(array('action'=>'index'));

	}

  function fill_my_database()
  {
      $this->checkSession();
	  $userobject = $this->Session->read('userobject');
	  
      if ( isset( $userobject['admin'] ) )
	  {
		      $this->autoRender = false;            
		      $this->Filldatabase->prefill($this->Start);
	  }      
  }
}
?>
