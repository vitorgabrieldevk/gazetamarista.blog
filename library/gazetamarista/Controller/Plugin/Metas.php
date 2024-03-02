<?php

/**
 * Cria o plugin do metas
 * 
 * @name gazetamarista_Controller_Plugin_Metas
 */
class gazetamarista_Controller_Plugin_Metas extends Zend_Controller_Plugin_Abstract {
	/**
	 * Método da classe
	 * 
	 * @name includejs
	 */
	public function preDispatch (Zend_Controller_Request_Abstract $request) {
		// Busca o view renderer
		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper("viewRenderer");
		$viewRenderer->initView();
		$view = $viewRenderer->view;
		
		// Armazena o module, controller e o action
		$module     = (string)$request->getModuleName();
		$controller = (string)$request->getControllerName();
		$action     = (string)$request->getActionName();
		
		// Busca as informações das metas
		try {
			$metas = new Zend_Config_Ini(APPLICATION_PATH . "/configs/metas.ini", $module . "|" . $controller);
		}
		catch(Exception $e) {
			return FALSE;
		}

		// Seta a sessão de linguagem
        $this->linguagem = new Zend_Session_Namespace("linguagem");
        switch ($this->linguagem->lingua) {
        	case 'Espanhol':
                $linguagem_tipo = 'es';
                $cod_lingua = "_es";
                break;

            case 'Inglês':
                $linguagem_tipo = 'en';
                $cod_lingua = "_en";
                break;

            case 'Português':
                $linguagem_tipo = 'pt_BR';
                $cod_lingua = "";
                break;

            default:
            	$this->linguagem->lingua = 'Português';
                $linguagem_tipo = 'pt_BR';
                $cod_lingua = "";
                break;
        }

        // Ajustar variável $action
        $new_action = $action.$cod_lingua;
        if($metas->$new_action !== NULL) {
            $action = $action.$cod_lingua;
        }

        // Verifica se existe a sessão das metas
		if($metas->$action !== NULL) {
		    // Adiciona as meta tags
			if(!empty($metas->$action->title)) {
				$view->headTitle()->prepend($metas->$action->title);
			}

			if(!empty($metas->$action->description)) {
				$view->headMeta()->setName("description", $metas->$action->description);
			}
		}
	}
}