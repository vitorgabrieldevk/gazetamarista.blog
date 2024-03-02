<?php

/**
 * Controlador
 *
 * @name Admin_AvioesController
 */
class Admin_AvioesController extends gazetamarista_Controller_Action {
	/**
	 * Armazena o model padrão da tela
	 *
	 * @access protected
	 * @name $_model
	 * @var Admin_Model_Avioes
	 */
	protected $_model = NULL;

	/**
	 * Inicializa o controlador
	 * 
	 * @name init
	 */
	public function init() {
		// Inicializa o model da tela
		$this->_model = new Admin_Model_Avioes();
		$this->_model_itens = new Admin_Model_Aviaoitens();
		
		// Continua o carregamento do controlador
		parent::init();
	}
	
	/**
	 * Hook para listagem
	 *
	 * @name doBeforeList
	 * @param Zend_Db_Table_Select
	 * @return Zend_Db_Table_Select
	 */
	public function doBeforeList($select) {
		$select
			->order("ordenacao ASC")
			->order("idaviao DESC");

		// Retorna o select
		return $select;
	}

	/**
	 * Hook executado antes a população do formulario
	 *
	 * @name doBeforePopulate
	 * @param array $data Vetor dos dados do formulario
	 * @return array
	 */
	public function doBeforePopulate($data) {
		// Busca o id
		$id = $this->_request->getParam("idaviao", 0);
	
		// Se for editar
		if($id > 0) {
			// Seleciona vantagens
            $itens_vantagens = $this->_model_itens->fetchAll(array('idaviao = ?' => $id, 'tipo = ?' => 'vantagens'), 'ordenacao ASC');

            // Seleciona performances
            $itens_performances = $this->_model_itens->fetchAll(array('idaviao = ?' => $id, 'tipo = ?' => 'performance'), 'ordenacao ASC');
			
			// Assina na view
			$this->view->idaviao 	  = $id;
			$this->view->vantagens    = $itens_vantagens;
			$this->view->performances = $itens_performances;
		}
	
		// Retorna os dados
		return $data;
	}
	
	/**
	 * Ação executada após a atualização do registro
	 *
	 * @name doAfterUpdate
	 */
	public function doAfterUpdate() {
		// Busca o id do registro editado
		$id = $this->_request->getParam("idaviao", 0);

		// Executa o mesmo método que o insert
		$this->doAfterInsert($id);
	}

	/**
	 * Hook executado após a inserção do registro
	 *
	 * @name doAfterInsert
	 * @param int $id Código ID inserido
	 */
	public function doAfterInsert($id) {
		// Busca as vantagens
        $vantagens          = $this->_request->getParam("new_vantagens", "");
        $vantagens_texto    = $this->_request->getParam("new_vantagens_texto", "");
        $vantagens_en       = $this->_request->getParam("new_vantagens_en", "");
        $vantagens_texto_en = $this->_request->getParam("new_vantagens_texto_en", "");
        $vantagens_es       = $this->_request->getParam("new_vantagens_es", "");
        $vantagens_texto_es = $this->_request->getParam("new_vantagens_texto_es", "");
        $vantagens_order    = $this->_request->getParam("new_vantagens_order", "");

        if($vantagens) {
            // Busca última ordem
            $nova_ordem = 1;
            $ordem_vantagem = $this->_model_itens->fetchRow(array('idaviao = ?' => $id, 'tipo = ?' => 'vantagens'), 'ordenacao DESC');
            if($ordem_vantagem) {
                $nova_ordem = $ordem_vantagem->ordenacao + 1;
            }

            foreach($vantagens as $key => $vantagem) {
                // Busca se foi informado ordem
                if((int)$vantagens_order[$key] > 0) {
                    $nova_ordem = (int)$vantagens_order[$key];
                }

                $data = array(
                    'idaviao'       => $id,
                    'tipo'          => 'vantagens',
                    'item'          => $vantagem,
                    'item_en'       => $vantagens_en[$key],
                    'item_es'       => $vantagens_es[$key],
                    'conteudo'      => $vantagens_texto[$key],
                    'conteudo_en'   => $vantagens_texto_en[$key],
                    'conteudo_es'   => $vantagens_texto_es[$key],
                    'ordenacao'     => $nova_ordem
                );

                // Insere
                $this->_model_itens->insert($data);
            }
        }

		// Busca as performances
        $performances           = $this->_request->getParam("new_performances", "");
        $performances_texto     = $this->_request->getParam("new_performances_texto", "");
        $performances_en        = $this->_request->getParam("new_performances_en", "");
        $performances_texto_en  = $this->_request->getParam("new_performances_texto_en", "");
        $performances_es        = $this->_request->getParam("new_performances_es", "");
        $performances_texto_es  = $this->_request->getParam("new_performances_texto_es", "");
        $performances_order     = $this->_request->getParam("new_performances_order", "");

        if($performances) {
            // Busca última ordem
            $nova_ordem = 1;
            $ordem_performance = $this->_model_itens->fetchRow(array('idaviao = ?' => $id, 'tipo = ?' => 'performance'), 'ordenacao DESC');
            if($ordem_performance) {
                $nova_ordem = $ordem_performance->ordenacao + 1;
            }

            foreach($performances as $key => $performance) {
                // Busca se foi informado ordem
                if((int)$performances_order[$key] > 0) {
                    $nova_ordem = (int)$performances_order[$key];
                }

                $data = array(
                    'idaviao'       => $id,
                    'tipo'          => 'performance',
                    'item'          => $performance,
                    'item_en'       => $performances_en[$key],
                    'item_es'       => $performances_es[$key],
                    'conteudo'      => $performances_texto[$key],
                    'conteudo_en'   => $performances_texto_en[$key],
                    'conteudo_es'   => $performances_texto_es[$key],
                    'ordenacao'     => $nova_ordem
                );

                // Insere
                $this->_model_itens->insert($data);
            }
        }
	}

	/**
	 * Ação para remoção de item
	 * 
	 * @name deletaritemAction
	 */
	public function deletaritemAction() {
		// Busca o item
        $id     = $this->_request->getParam("idaviao", 0);
		$iditem = $this->_request->getParam("iditem", 0);
		
		if($id > 0 && $iditem > 0) {
			// Remove o item
			$this->_model_itens->delete(array('idaviao = ?' => $id, 'idaviaoitem = ?' => $iditem));
		}
		
		// Desabilita o layout e da o parse para json
		$this->_helper->json(array('status' => 'sucesso'));
	}

	/**
	 * Ação para alterar ordem dos itens
	 *
	 * @name salvalordemAction
	 */
	public function salvaordemAction() {
		// Desabilita os layouts
		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender(TRUE);

		// Busca os parâmetros
		$id         = $this->_request->getParam("id", 0);
		$type       = $this->_request->getParam("type", "");
		$objOrdemId = $this->_request->getParam("objOrdem", "");

		// Verifica se foi passado os parâmetros
		if($id > 0 && !empty($type) && is_array($objOrdemId)) {
			// Seleciona os itens
			$rows = $this->_model_itens->fetchAll(array('idaviao = ?' => $id, 'tipo = ?' => $type));

			if(count($rows) > 0) {
				// Zera a ordenação atual
				$this->_model_itens->update(array('ordenacao' => 0), array('idaviao = ?' => $id, 'tipo = ?' => $type));

				// Percorre os itens
                $cont_ordem = 1;
				foreach($objOrdemId as $iditem) {
					// Efetua o update com a nova ordenação
					$this->_model_itens->update(array('ordenacao' => $cont_ordem), array('idaviaoitem = ?' => $iditem, 'idaviao = ?' => $id, 'tipo = ?' => $type));

					$cont_ordem++;
				}
			}
		}
	}
}