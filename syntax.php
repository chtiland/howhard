<?php
/**
 * DokuWiki Plugin HowHard (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Fabrice DEJAIGHER <fabrice@chtiland.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC'))
{
	die();
}

if (!defined('DOKU_LF'))
{
	define('DOKU_LF', "\n");
}

if (!defined('DOKU_TAB'))
{
	define('DOKU_TAB', "\t");
}

if (!defined('DOKU_PLUGIN'))
{
	define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
}

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_howhard extends DokuWiki_Syntax_Plugin
{

    var $notes_hh = array('1','2','3','4','5');

    var $note_defaut = '1';



    public function getType()
    {
        return 'container';
    }

    public function getPType()
    {
        return 'normal';
    }
    public function getAllowedTypes()
    {
        return array('container','substition','protected','disabled','formatting','paragraphs');
    }

    public function getSort()
    {
        return 195;
    }


    public function connectTo($mode)
    {
        $this->Lexer->addSpecialPattern('\{\{howhard>.*?\}\}',$mode,'plugin_howhard');
    }

    public function handle($match, $state, $pos, Doku_Handler $handler)
    {
		switch ($state)
		{
		    case DOKU_LEXER_ENTER :
		    break;

		    case DOKU_LEXER_UNMATCHED :
		        return array($state,$this->note_defaut);
		    break;

		    case DOKU_LEXER_SPECIAL :
			$retour = substr($match,-3,1);
			if(!in_array("$retour",$this->notes_hh) or empty($retour))
			{
				$retour=$this->note_defaut;
			}
			return array($state,$retour);
		    break;

		    default :
			return array($state);


		}


    }

    public function render($mode, Doku_Renderer $renderer, $indata)
    {
        list($state, $data) = $indata;

        if($mode == 'xhtml')
        {
			// Compact mode ?
			$isCompact = false;
			if($this->getConf('confhowhardcompact')					// Activated
					&& $this->getConf('confhowhardstyle') != 1)		// But not for style '1'
			{
				$isCompact = '_compact';
			}

			// vars
			$text_level = 'level'.$data;
            $style = $this->getConf('confhowhardstyle');

			// Render
            $renderer->doc.= '<div class="howhard'.$isCompact.'">';

			if(!$isCompact)	// If not compact, add title.
			{
			    $renderer->doc.= '<div class="howhard_title">'.$this->getLang('howhardtitle').'</div>';
			}


            $renderer->doc.= '<div class="howhard_img_compact">';
            $renderer->doc.= '<img src="'.DOKU_BASE.'lib/plugins/howhard/images/style'.$style.'/'.$data.'.png" borber="0">';
            $renderer->doc.= '</div>';
            $renderer->doc.= '<div class="howhard_txt'.$isCompact.'">'.$this->getLang($text_level).'</div>';
            $renderer->doc.= '</div>';

            return true;

        }
        else
        {
            return false;
		}
    }
}