<?php

/**
 * Controlador dos Contatos
 *
 * @name Admin_ContatosController
 */
class Admin_ContatosController extends gazetamarista_Controller_Action {
	/**
	 * Armazena o model padrão da tela
	 *
	 * @access protected
	 * @name $_model
	 * @var Admin_Model_Contatos
	 */
	protected $_model = NULL;

	/**
	 * Inicializa o controller
	 * 
	 * @name init
	 */
	public function init() {
		// Inicializa o model da tela
		$this->_model = new Admin_Model_Contatos();
		
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
		// Busca os parametros
		$nome 			= $this->_request->getParam("nome", "");
		$email 			= $this->_request->getParam("email", "");
		$telefone 		= $this->_request->getParam("telefone", "");
		$cidade 		= $this->_request->getParam("cidade", "");
		$assunto 		= $this->_request->getParam("assunto", "");
		$data_inicial 	= $this->_request->getParam("data_inicial", "");
		$data_final 	= $this->_request->getParam("data_final", "");
		
		// Redireciona o usuário
		if($this->_request->isPost()) {
			$data_inicial = implode("-", array_reverse(explode("/", $data_inicial)));
			$data_final   = implode("-", array_reverse(explode("/", $data_final)));
			
			// Monta a URL
			$url  = "";
			$url .= ($nome != "") ? "/nome/" . $nome : "";
			$url .= ($email != "") ? "/email/" . $email : "";
			$url .= ($telefone != "") ? "/telefone/" . $telefone : "";
			$url .= ($cidade != "") ? "/cidade/" . $cidade : "";
			$url .= ($assunto != "") ? "/assunto/" . $assunto : "";
			$url .= ($data_inicial != "") ? "/data_inicial/" . $data_inicial : "";
			$url .= ($data_final != "") ? "/data_final/" . $data_final : "";
			
			$this->_redirect("admin/contatos/list" . $url);
		}
		
		// Monta a query
		$select
			->order("idcontato DESC");
		
		// Verifica o nome
		if($nome != "") {
			$select->where("nome LIKE ?", "%" . $nome . "%");
			$this->view->filtro_nome = $nome;
		}
		
		// Verifica o e-mail
		if($email != "") {
			$select->where("email LIKE ?", "%" . $email . "%");
			$this->view->filtro_email = $email;
		}

		// Verifica a telefone
		if($telefone != "") {
			$select->where("telefone LIKE ?", "%" . $telefone . "%");
			$this->view->filtro_telefone = $telefone;
		}
		
		// Verifica a cidade
		if($cidade != "") {
			$select->where("cidade LIKE ?", "%" . $cidade . "%");
			$this->view->filtro_cidade = $cidade;
		}
		
		// Verifica o assunto
		if($assunto != "") {
			$select->where("assunto LIKE ?", "%" . $assunto . "%");
			$this->view->filtro_assunto = $assunto;
		}
		
		// Verifica os campos da data
		if(($data_inicial != "") && ($data_final != "")) {
			$select->where("CAST(data AS DATE) BETWEEN '" . $data_inicial . "' AND '" . $data_final . "'");
				
			$this->view->filtro_data_inicial = $data_inicial;
			$this->view->filtro_data_final = $data_final;
		}
		elseif($data_inicial != "") {
			$select->where("CAST(data AS DATE) = ?", $data_inicial);
			$this->view->filtro_data_inicial = $data_inicial;
		}
		
		// Monta a URL
		$url = "";
		$url .= ($nome != "") ? "/nome/" . $nome : "";
		$url .= ($email != "") ? "/email/" . $email : "";
		$url .= ($telefone != "") ? "/telefone/" . $telefone : "";
		$url .= ($cidade != "") ? "/cidade/" . $cidade : "";
		$url .= ($assunto != "") ? "/assunto/" . $assunto : "";
		$url .= ($data_inicial != "") ? "/data_inicial/" . $data_inicial : "";
		$url .= ($data_final != "") ? "/data_final/" . $data_final : "";
		
		// Assina na viu os parâmetros de pesquisa
		$this->view->parametros = $url;
	
		// Continua a execução
		return $select;
	}
	
	/**
	 * Visualiza o contato
	 *
	 * @name viewAction
	 */
	public function viewAction() {
		parent::viewAction();

		// Cria a sessão de mensagens
		$messages = new Zend_Session_Namespace("messages");
	
		// Captura o código do registro clicado
		$idcontato = $this->_request->getParam("idcontato", "");

		// Seleciona os dados do contato clicado
		$select_contato = $this->_model->select()
			->where("idcontato = ?", $idcontato);
		
		// Busca o registro no banco
		$contato = $this->_model->fetchRow($select_contato);
		
		// Verifica o id
		if($contato) {
			// Seta como visualizado
			$data_up = array('visualizado' => 1);
			$this->_model->update($data_up, array('idcontato = ?' => $idcontato));
		}else{
			// Adiciona a mensagem de erro à sessão
			$messages->error = "Id inválido. Tente novamente";
			$this->_helper->redirector("list", "contatos", "admin");
		}
	}
}