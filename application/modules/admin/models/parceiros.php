<?php

/**
 * Modelo da tabela de Clientes
 *
 * @name Admin_Model_Parceiros
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Parceiros extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "Zend_clientes";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idcliente";

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
	protected $_gerarXls = true;

	/**
	 * Armazena se bloqueia exportar xls no list
	 *
	 * @access protected
	 * @name $_gerarPdf
	 * @var boolean
	 */
	protected $_gerarPdf = false;
	
	/**
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Adiciona os campos ao model
		$this->setCampo("titulo", "Nome Parceiro");
		$this->setCampo("imagem", "Imagem | Logo", "200x140px [.jpg, .png]");
		$this->setCampo("link", "Link de Redirecionamento");
		$this->setCampo("ordem", "Ordem");
		$this->setCampo("ativo", "Ativo?");
		$this->setCampo("data", "Criado em");
		
		// Seta o campo de descrição da tabela
		$this->setDescription("titulo");
		
		// Seta visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("link", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("ordem", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, TRUE, TRUE);
		$this->setVisibility("data", FALSE, FALSE, FALSE, TRUE);

		$this->setModifier("imagem", array(
			'type' => "file",
			'preview' => "common/uploads/clientes",
			'destination' => APPLICATION_PATH . "/../common/uploads/parceiros"
		));

		// Continua o carregamento do model
		parent::init();
	}
}