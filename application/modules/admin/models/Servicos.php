<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Servicos
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Servicos extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_servicos";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idservico";

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
	 * @name $_gerarPdf
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
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Adiciona os campos ao model
        $this->setCampo("nome", "Nome do Redator");
		$this->setCampo("imagem", "Imagem", "1920x615px [.jpg]");
        $this->setCampo("biografia", "Biografia");
        $this->setCampo("mensagem", "Mensagem do Autor");
        $this->setCampo("telefone", "Telefone");
        $this->setCampo("email", "E-mail");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("nome");

		// Seta visibilidade dos campos
		$this->setVisibility("nome", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("imagem", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("biografia", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("mensagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("telefone", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("email", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

		// Seta os modificadores
        $this->setModifier("imagem", array(
			'type' => "file",
			'preview' => "common/uploads/redatores",
			'destination' => APPLICATION_PATH . "/../common/uploads/redatores",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}