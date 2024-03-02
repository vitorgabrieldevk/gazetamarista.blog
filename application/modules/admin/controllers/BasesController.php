<?php

/**
 * Controlador
 *
 * @name Admin_BasesController
 */
class Admin_BasesController extends gazetamarista_Controller_Action {
	/**
	 * Armazena o model padrão da tela
	 *
	 * @access protected
	 * @name $_model
	 * @var Admin_Model_Bases
	 */
	protected $_model = NULL;

	/**
	 * Inicializa o controlador
	 * 
	 * @name init
	 */
	public function init() {
		// Inicializa o model da tela
		$this->_model = new Admin_Model_Bases();
		$this->_model_itens = new Admin_Model_Baseitens();
		
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
			->order("idbase DESC");

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
		$id = $this->_request->getParam("idbase", 0);
	
		// Se for editar
		if($id > 0) {
			// Seleciona serviços
            $itens_servicos = $this->_model_itens->fetchAll(array('idbase = ?' => $id, 'tipo = ?' => 'serviço'), 'ordenacao ASC');

            // Seleciona facilidades
            $itens_facilidades = $this->_model_itens->fetchAll(array('idbase = ?' => $id, 'tipo = ?' => 'facilidade'), 'ordenacao ASC');
			
			// Assina na view
			$this->view->idbase 	 = $id;
			$this->view->servicos    = $itens_servicos;
			$this->view->facilidades = $itens_facilidades;
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
		$id = $this->_request->getParam("idbase", 0);

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
		// Busca os serviços
        $servicos       = $this->_request->getParam("new_servicos", "");
        $servicos_en    = $this->_request->getParam("new_servicos_en", "");
        $servicos_es    = $this->_request->getParam("new_servicos_es", "");
        $servicos_order = $this->_request->getParam("new_servicos_order", "");

        if($servicos) {
            // Busca última ordem
            $nova_ordem = 1;
            $ordem_servico = $this->_model_itens->fetchRow(array('idbase = ?' => $id, 'tipo = ?' => 'serviço'), 'ordenacao DESC');
            if($ordem_servico) {
                $nova_ordem = $ordem_servico->ordenacao + 1;
            }

            foreach ($servicos as $key => $servico) {
                // Busca se foi informado ordem
                if((int)$servicos_order[$key] > 0) {
                    $nova_ordem = (int)$servicos_order[$key];
                }

                $data = array(
                    'idbase'    => $id,
                    'tipo'      => 'serviço',
                    'item'      => $servico,
                    'item_en'   => $servicos_en[$key],
                    'item_es'   => $servicos_es[$key],
                    'ordenacao' => $nova_ordem
                );

                // Insere o serviço
                $this->_model_itens->insert($data);
            }
        }

		// Busca os facilidades
        $facilidades        = $this->_request->getParam("new_facilidades", "");
        $facilidades_en     = $this->_request->getParam("new_facilidades_en", "");
        $facilidades_es     = $this->_request->getParam("new_facilidades_es", "");
        $facilidades_order  = $this->_request->getParam("new_facilidades_order", "");

        if($facilidades) {
            // Busca última ordem
            $nova_ordem = 1;
            $ordem_facilidade = $this->_model_itens->fetchRow(array('idbase = ?' => $id, 'tipo = ?' => 'facilidade'), 'ordenacao DESC');
            if($ordem_facilidade) {
                $nova_ordem = $ordem_facilidade->ordenacao + 1;
            }

            foreach ($facilidades as $key => $facilidade) {
                // Busca se foi informado ordem
                if((int)$facilidades_order[$key] > 0) {
                    $nova_ordem = (int)$facilidades_order[$key];
                }

                $data = array(
                    'idbase'    => $id,
                    'tipo'      => 'facilidade',
                    'item'      => $facilidade,
                    'item_en'   => $facilidades_en[$key],
                    'item_es'   => $facilidades_es[$key],
                    'ordenacao' => $nova_ordem
                );

                // Insere o serviço
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
        $id     = $this->_request->getParam("idbase", 0);
		$iditem = $this->_request->getParam("iditem", 0);
		
		if($id > 0 && $iditem > 0) {
			// Remove o item
			$this->_model_itens->delete(array('idbase = ?' => $id, 'idbaseitem = ?' => $iditem));
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
			$rows = $this->_model_itens->fetchAll(array('idbase = ?' => $id, 'tipo = ?' => $type));

			if(count($rows) > 0) {
				// Zera a ordenação atual
				$this->_model_itens->update(array('ordenacao' => 0), array('idbase = ?' => $id, 'tipo = ?' => $type));

				// Percorre os itens
                $cont_ordem = 1;
				foreach($objOrdemId as $iditem) {
					// Efetua o update com a nova ordenação
					$this->_model_itens->update(array('ordenacao' => $cont_ordem), array('idbaseitem = ?' => $iditem, 'idbase = ?' => $id, 'tipo = ?' => $type));

					$cont_ordem++;
				}
			}
		}
	}
}