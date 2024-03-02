<?php

/**
 * Modelo da tabela de usuarios
 *
 * @name Admin_Model_Usuarios
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Usuarios extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_usuarios";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idusuario";

	/**
	 * Armazena se bloqueia manipulação dos dados
	 *
	 * @access protected
	 * @name $_somenteview
	 * @var string
	 */
	protected $_somenteView = false;

	/**
	 * Armazena se bloqueia exportar xls no list
	 *
	 * @access protected
	 * @name $_gerarXls
	 * @var string
	 */
	protected $_gerarXls = false;

	/**
	 * Armazena se bloqueia exportar pdf no view
	 *
	 * @access protected
	 * @name $_gerarPdf
	 * @var string
	 */
	protected $_gerarPdf = false;

	/**
	 * Parâmetros para esconder botão 'Remover'
	 * 
	 * @access protected
	 * @name $_esconderBtnRemover
	 * @var boolean
	 */
	protected $_esconderBtnRemover = false;

	/**
	 * Parâmetros para esconder botão 'Novo'
	 * 
	 * @access protected
	 * @name $_esconderBtnNovo
	 * @var boolean
	 */
	protected $_esconderBtnNovo = false;

	/**
	 * Parâmetros para esconder botão 'Visualizar'
	 * 
	 * @access protected
	 * @name $_esconderBtnVisualizar
	 * @var boolean
	 */
	protected $_esconderBtnVisualizar = false;

	/**
	 * Parâmetros para esconder botão 'Filtrar'
	 * 
	 * @access protected
	 * @name $_esconderBtnFiltrar
	 * @var boolean
	 */
	protected $_esconderBtnFiltrar = false;
	
	/**
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Adiciona os campos ao model
		$this->setCampo("nome", "Nome");
		$this->setCampo("email", "E-mail");
		$this->setCampo("login", "Login");
		$this->setCampo("senha", "Senha", "Informe somente para alterar a senha atual");
		$this->setCampo("idperfil", "Perfil");

		// Seta o campo de descrição da tabela
		$this->setDescription("nome");

		// Seta a visibilidade
		$this->setVisibility("nome", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("email", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("login", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("senha", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("chave", FALSE, FALSE, FALSE, FALSE);
		$this->setVisibility("sendmail", FALSE, FALSE, FALSE, FALSE);
		
		// Seta o modifier
		$this->setModifier("senha", array('type'=>"password"));
		
		// Seta o relacionamento
		$this->setAutocomplete("idperfil", "Admin_Model_Perfis");
		
		// Continua o carregamento do model
		parent::init();

		// Seta o autocomplete personalizado (name 'unicos')
        $select = $this->select();
		$select->where("idperfil = 2");
		$this->setQueryAutoComplete("unicos", $select);
	}
}