<?php
/**
 * Sprintmod
 *
 * @license    MIT
 * @author     Gero Gothe <practical@medizin-lernen.de>
 */


# must be run within Dokuwiki
if(!defined('DOKU_INC')) die();


class action_plugin_sprintmod extends DokuWiki_Action_Plugin {

    public function register(Doku_Event_Handler $controller) {

        $controller->register_hook('DOKUWIKI_DONE', 'AFTER', $this, 'editor_elements');

    }
    
    # Show AddNewPage bar
    # Show Page-ID
    public function editor_elements(Doku_Event $event) {
        global $ID;
        
        if (auth_quickaclcheck($ID) < AUTH_CREATE) return;
        
        if ($this->getConf("show_id")) echo "<div class='plugin__sprintmod_statusbar'>$ID</div>";
        
        $list = plugin_list();
        if (in_array('addnewpage',$list) && ($this->getConf("show_addnewpage"))) {
            echo '<div class="plugin__sprintmod_newpage">';
            echo "<span>&xoplus; Add new page</span><br><br>";
            echo p_render('xhtml',p_get_instructions("{{NEWPAGE}}"),$info);
            echo '</div>';
        }

    }


}

//Setup VIM: ex: et ts=4 enc=utf-8 :
