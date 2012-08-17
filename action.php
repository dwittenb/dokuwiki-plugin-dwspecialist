<?php
/**
 * DWspecialist Plugin: Inserts a button with DWspecialist-syntax into the toolbar
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Dietrich Wittenberg <info.wittenberg@online.de>
 */
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

/**
 * create the data-array of the toolbar-button definition for the allowed syntax
 * @return array  
 */
function _create_event_data() {
	global $lang;
	
	$actions=array(
			"admin", 
			"back", 
			"backlink",
			"breadcrumbs", 
			"edit", 
			"export_pdf",
			"history", 
			"index", 
			"login", 
			"profile", 
			"recent", 
			"subscribe", 
			"subscription",
			"top", 
			"topbar",
	);
	
	$action="specialist";
	$list[] = array(
			'type'	=>	'insert',
			'title'	=>	$action,
			'icon'	=>	'../../plugins/dwspecialist/images/'.$action.'.png',
			'insert'=>	'<specialist>\n  * <special breadcrumbs>\n</specialist>\n',
	);
	foreach ($actions as $action) {
	$act=tpl_get_action($action);
		if ($act) {
			$name = (key_exists('btn_'.$act['type'], $lang)) ? $lang['btn_'.$act['type']] : $action;
		} else {
			$name = $action;
		}
	$list[] = array(
				'type'	=>	'insert',
	  		'title'	=>	$name,
	  		'icon'	=>	'../../plugins/dwspecialist/images/'.$action.'.png',
	  		'insert'=>	'<special '.$action.'>',
	  		);
	}
	
	return $list;
}

/**
 * All DokuWiki plugins to extend the admin function
 * need to inherit from this class
*/
class action_plugin_dwspecialist extends DokuWiki_Action_Plugin {

  /**
   * @return multitype:string 
   */
/* not longer needed for DokuWiki 2009-12-25 “Lemming” and later
	function getInfo(){
    return array(
      'author' => 'Dietrich Wittenberg',
      'email'  => 'info.wittenberg@online.de',
      'date'   => '2012-07-01',
      'name'   => 'plugin DWspecialist',
      'desc'   => 'adds editor-button to includes an unordered list used as a menu',
      'url'    => 'http://dokuwiki.org/plugin:dwspecialist',
    );
  }
*/	  
	  
  /* 
   * Register the eventhandlers
   * @see DokuWiki_Action_Plugin::register()
   */
  function register(&$controller) {
  	$controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'insert_button', array()); 
  }
  
  /**
   * Insert the toolbar button
   * @param unknown_type $event
   * @param unknown_type $param
   */
  function insert_button(& $event, $param) {
  	$event->data[] = array(
  			'type'	=>	'picker',
  			'title'	=>	'Spezialmenüeintrag auswählen',
  			'icon'	=>	'../../plugins/dwspecialist/images/specialist.png',
  			'list'	=>	_create_event_data()
  			);
  }
}
?>