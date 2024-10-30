<?php
/**
 * General action, hooks loader
*/
class HMT_Loader {

	protected $hmt_actions;
	protected $hmt_filters;

	/**
	 * Class Constructor
	*/
	function __construct() {
		$this->hmt_actions = array();
		$this->hmt_filters = array();
	}

	function add_action( $hook, $component, $callback ) {
		$this->hmt_actions = $this->add( $this->hmt_actions, $hook, $component, $callback );
	}

	function add_filter( $hook, $component, $callback ) {
		$this->hmt_filters = $this->add( $this->hmt_filters, $hook, $component, $callback );
	}

	private function add( $hooks, $hook, $component, $callback ) {
		$hooks[] = array( 'hook' => $hook, 'component' => $component, 'callback' => $callback );
		return $hooks;
	}

	public function hmt_run() {
		foreach( $this->hmt_filters as $hook ){
			add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
		foreach( $this->hmt_actions as $hook ){
			add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		}
	}
}
?>