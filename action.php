<?php
/**
 * Composant Action pour HowHard (Toolbar)
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Fabrice DEJAIGHER <fabrice@chtiland.com>
 */

if (!defined('DOKU_INC'))
{
	die();
}

if (!defined('DOKU_PLUGIN'))
{
	define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
}
require_once(DOKU_PLUGIN . 'action.php');

class action_plugin_howhard extends DokuWiki_Action_Plugin
{


	function register(Doku_Event_Handler $controller)
	{
		$controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'handle_toolbar', array ());
	}

	function handle_toolbar(&$event, $param)
	{
		$event->data[] = array
		(
			'type'  => 'picker',
			'title' => 'HowHard',
			'icon'  => '../../plugins/howhard/images/toolbar/level_select.png',
			'list'  => array (
				array (
					'type'   => 'insert',
					'title'  => $this->getLang('level1'),
					'icon'   => '../../plugins/howhard/images/toolbar/1.png',
					'insert' => '{{howhard>1}}',
				),
				array (
					'type'   => 'insert',
					'title'  => $this->getLang('level2'),
					'icon'   => '../../plugins/howhard/images/toolbar/2.png',
					'insert' => '{{howhard>2}}',
				),
				array (
					'type'   => 'insert',
					'title'  => $this->getLang('level3'),
					'icon'   => '../../plugins/howhard/images/toolbar/3.png',
					'insert' => '{{howhard>3}}',
				),
				array (
					'type'   => 'insert',
					'title'  => $this->getLang('level4'),
					'icon'   => '../../plugins/howhard/images/toolbar/4.png',
					'insert' => '{{howhard>4}}',
				),
				array (
					'type'   => 'insert',
					'title'  => $this->getLang('level5'),
					'icon'   => '../../plugins/howhard/images/toolbar/5.png',
					'insert' => '{{howhard>5}}',
				)
			)
		);
	}
}

