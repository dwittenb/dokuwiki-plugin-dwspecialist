<<<<<<< HEAD
<?php 
=======
<?php
>>>>>>> 44888d75738d6f153225921e80e29311b38ab566
/**
 * This plugin allows to add an unordered list of toolbar-Links
 * It can be used to create the wiki-syntax of a list that is needed by 
 * the plugin topbarsyntax to show a tabfolder.
 *
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Dietrich Wittenberg <info.wittenberg@online.de>
 */
 
// must be run within Dokuwiki
//if(!defined('DOKU_INC')) die();

if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'syntax.php');

//

class syntax_plugin_dwspecialist extends DokuWiki_Syntax_Plugin {

	function syntax_plugin_dwspecialist() {
	}
		
<<<<<<< HEAD
/* not longer needed for DokuWiki 2009-12-25 “Lemming” and later
	function getInfo(){
=======
  function getInfo(){
>>>>>>> 44888d75738d6f153225921e80e29311b38ab566
    return array(
      'author' => 'Dietrich Wittenberg',
      'email'  => 'info.wittenberg@online.de',
      'date'   => '2012-07-01',
      'name'   => 'plugin dwspecialist',
      'desc'   => 'includes an unordered list used as a menu',
      'url'    => 'http://dokuwiki.org/plugin:dwspecialist',
    );
  }
<<<<<<< HEAD
*/				
=======
				
>>>>>>> 44888d75738d6f153225921e80e29311b38ab566
  function getType(){ return 'substition'; }
	function getAllowedTypes() { return array('disabled'); }   
  function getPType(){ return 'block'; }
  function getSort(){ return 160; }
  	
		
	function connectTo($mode) {	
		$this->Lexer->addEntryPattern('<specialist>(?=.*?</specialist>)', $mode, 'plugin_dwspecialist' ); 			// the entry of <specialist>
		$this->Lexer->addPattern('\n {2,}/*?[ ]*[^\n<]*<special[^\n>]*>', 'plugin_dwspecialist' ); 	// {\n  * BlaBla <special ...>}
		$this->Lexer->addPattern('\n {2,}/*?[ ]*<special[^\n>]*>', 'plugin_dwspecialist' );					// {\n  * <special ...>}
		$this->Lexer->addPattern('\n[ ]*<special[^\n>]*>', 'plugin_dwspecialist' );									// {\n <special ...>}
		$this->Lexer->addPattern('[^\n<]<special[^\n>]*>', 'plugin_dwspecialist' );									// {BlaBla <special ...>}
	}
											      //$this->Lexer->addSpecialPattern('<test>',$mode,'plugin_dwlistmenu');
	function postConnect() 		{	$this->Lexer->addExitPattern('</specialist\>', 'plugin_dwspecialist');}				// the exit  of <specialist>
 
 
  /**
   * Handle the match
   */
  function handle($match, $state, $pos, &$handler){
  	
	  switch ($state) {
			case DOKU_LEXER_ENTER:
      	break;
      case DOKU_LEXER_UNMATCHED:
      	return array($state, $match);
      	break;

      case DOKU_LEXER_MATCHED:
      	if       (preg_match('#(\n)( {2,}[/*]?)([ ]*[^\n<]*)<special([^\n>]*)>#', $match, $result)) {
      	} elseif (preg_match('#(\n)( {2,}[/*]?)([ ]*)<special([^\n>]*)>#', $match, $result)) {
      	} elseif (preg_match('#(\n)([ ]*)()<special([^\n>]*)>#', $match, $result)) {
      	} elseif (preg_match('#()()([^\n<])<special([^\n>]*)>#', $match, $result)) {
      	}
      	
      	/*
      	list($match, $crlf, $listoffset, $prolog, $parameter)=$result;
      	if ($match != "") { // any match
      		$parameters=explode("&", $parameter);
      		$match="";

      		foreach ($parameters as $action) {
      			$action=trim($action);
      			switch ($action) {
      				case "page_tools":
      					$match.=$this->_handle_special(array($action), $crlf, $listoffset, $prolog);
      					$actions=array("edit", "revert", "revisions", "backlink", "subscribe");
      					$match.=$this->_handle_special($actions, $crlf, "  ".$listoffset, $prolog);
      					break;
     					case "site_tools":
      					$match.=$this->_handle_special(array($action), $crlf, $listoffset, $prolog);
     						$actions=array("recent", "media", "index");
      					$match.=$this->_handle_special($actions, $crlf, "  ".$listoffset, $prolog);
     						break;
     					case "user_tools":
      					$match.=$this->_handle_special(array($action), $crlf, $listoffset, $prolog);
     						$actions=array("login", "register", "profile", "admin");
      					$match.=$this->_handle_special($actions, $crlf, "  ".$listoffset, $prolog);
     						break;
     								
      				default:
      					$match.=$this->_handle_special(array($action), $crlf, $listoffset, $prolog);
      					break;
      			} // switch
      		} // foreach
      	} // !($match=="")

      	return array($state, $match);
      	*/
      	return array($state, $result);
      	break;

      case DOKU_LEXER_EXIT:
      	return array($state, '');
      	break;

      case DOKU_LEXER_SPECIAL :
			  //if (preg_match('(\[NOW]\)',$match,$matches)) 
				//return array($state, $match); //es[1],'');
				return array($state, $match);
        break;
		}
    return array();
	}
 
	function _render_special($actions, $crlf, $listoffset, $prolog) {
  	global $conf;
		global $lang;
		global $backup;
		global $INFO;
		 
		$id =$backup['ID'];
		$rev=$backup['REV'];
		
		$line="";
    foreach ($actions as $action) {
			switch ($action) {
				case "export_pdf":
					$act=array(	'params'	=>	array('do' => $action, 'rev' => $rev),
					'type'		=>	$action);
					$name="Export PDF";
					$line.=$crlf.$listoffset.$prolog."[[".$id."?".http_build_query ($act['params'])."|".$name."]]";
					break;
			
				case "edit":
				case "history":
				case "recent":
				case "login":
				case "profile":
				case "index":
				case "admin":
				case "top":
				case "back":
				case "backlink":
				case "subscribe":
				case "subscription":
					$act=tpl_get_action($action);
					//$act['params']['do']; is now defined
					if ($act) {
						$name=(key_exists('btn_'.$act['type'], $lang)) ? $lang['btn_'.$act['type']] : $action;
						//$act['params']['id']=$ID;
						$act['params']['rev']=$rev;
						//$act['params']['sectoc']=getSecurityToken();
							
						$line.=$crlf.$listoffset.$prolog."[[".$id."?".http_build_query ($act['params'])."|".$name."]]";
					} else {
						$line.=$crlf.$listoffset.$prolog.$action;
					}
					break;
			
				case "topbar":
					$line.=$crlf.$listoffset.$prolog."[[".$action."|Navigationsleiste]]";
					break;
			
				case "breadcrumbs":
					if(!$conf['breadcrumbs']) {
						// special is empty
					} else {
						$i=1;
						$special= array_reverse(breadcrumbs()); // array([plf:plf] => 'Projektleitfaden', ...)
						foreach ($special as $id => $name) {
							$wikilinks[]="[[".$id."|".(($i<10)?"0":"").$i.": ".$name."]]";
							$i++;
						}
						$line.=$crlf.$listoffset.$prolog.implode($crlf.$listoffset, $wikilinks);
					}
					break;
			
				default: // action not defined
					$line.=$crlf.$listoffset.$prolog.$action;
					break;
			} // switch
    }
    return $line;
	}
	
    /**
     * Create output
     */
	function render($mode, &$renderer, $data) {
  	//global $ID;
  	//global $INFO;
  	global $_dwlm_content;
  	 
    if($mode == 'xhtml'){
			list($state,$match) = $data;
      switch ($state) {
      	case DOKU_LEXER_ENTER:
      		$_dwlm_content="";
      		break;
      	case DOKU_LEXER_UNMATCHED:
      		$_dwlm_content.=$match; //$renderer->_xmlEntities($match);      		
      		break;
      	case DOKU_LEXER_MATCHED:
      		
      		// not in handle because $INFO is not initialized
      		list($matchall, $crlf, $listoffset, $prolog, $parameter)=$match;
      		if ($matchall != "") { // any match
      			$parameters=explode("&", $parameter);
      			$wikitext="";
      		
      			foreach ($parameters as $action) {
      				$action=trim($action);
      				switch ($action) {
      					case "page_tools":
      						$wikitext.=$this->_render_special(array($action), $crlf, $listoffset, $prolog);
      						$actions=array("edit", "revert", "revisions", "backlink", "subscribe");
      						$wikitext.=$this->_render_special($actions, $crlf, "  ".$listoffset, $prolog);
      						break;
      					case "site_tools":
      						$wikitext.=$this->_render_special(array($action), $crlf, $listoffset, $prolog);
      						$actions=array("recent", "media", "index");
      						$wikitext.=$this->_render_special($actions, $crlf, "  ".$listoffset, $prolog);
      						break;
      					case "user_tools":
      						$wikitext.=$this->_render_special(array($action), $crlf, $listoffset, $prolog);
      						$actions=array("login", "register", "profile", "admin");
      						$wikitext.=$this->_render_special($actions, $crlf, "  ".$listoffset, $prolog);
      						break;
      							
      					default:
      						$wikitext.=$this->_render_special(array($action), $crlf, $listoffset, $prolog);
      						break;
      				} // switch
      			} // foreach
      		} // !($match=="")
      		
      		//return array($state, $match);
      		
      		$_dwlm_content.=$wikitext; //$renderer->_xmlEntities($match);      		
      		break;
      		case DOKU_LEXER_EXIT:
       		$renderer->info['cache'] = false; 
       		$renderer->doc .= p_render($mode, p_get_instructions($_dwlm_content), $info);
       		$_dwlm_content="";
      		break;
      }
      return true;
    }
    return false;
	}

}
//Setup VIM: ex: et ts=4 enc=utf-8 :
