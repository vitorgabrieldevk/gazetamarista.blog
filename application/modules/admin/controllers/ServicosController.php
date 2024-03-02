<?php

/**
 * Controlador do model
 *
 * @name Admin_ServicosController
 */
class Admin_ServicosController extends gazetamarista_Controller_Action {
	/**
	 * Armazena o model padrão da tela
	 *
	 * @access protected
	 * @name $_model
	 * @var Admin_Model_Servicos
	 */
	protected $_model = NULL;

	/**
	 * Inicializa o controller
	 * 
	 * @name init
	 */
	public function init() {
		// Inicializa o model da tela
		$this->_model = new Admin_Model_Servicos();

		// Busca a sessão do login
		$this->session  = new Zend_Session_Namespace("loginadmin");
		$this->messages = new Zend_Session_Namespace("messages");
		
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
		// Monta a query
		$select
			->order("ordenacao ASC")
			->order("titulo ASC");

		// Continua a execução
		return $select;
	}

	/**
	 * Hook antes de deletar o registro
	 *
	 * @name doBeforeDelete
	 */
	public function doBeforeDelete(){
		// Busca o parametro
		$id = $this->_request->getParam("idservico", 0);

		if($id > 0) {
			// Verifica se é o serviço travado no menu
            $servico = $this->_model->fetchRow(array('idservico = ?' => $id));
            if($servico->travar_menu == 1) {
                // Erro
                $this->_helper->json(array('result' => FALSE, 'message' => "Este serviço é fixo no menu do site, não é possível remover."));
                die();
            }
		}
	}
}