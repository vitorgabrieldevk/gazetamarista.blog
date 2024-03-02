<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Contatos
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Contatos extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_contatos";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idcontato";

	/**
	 * Armazena se bloqueia exportar xls no list
	 *
	 * @access protected
	 * @name $_gerarXls
	 * @var string
	 */
	protected $_gerarXls = true;

	/**
	 * Armazena se bloqueia manipulação dos dados
	 *
	 * @access protected
	 * @name $_somenteview
	 * @var string
	 */
	protected $_somenteView = true;
	
	/**
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Adiciona os campos ao model
		$this->setCampo("nome", "Nome");
		$this->setCampo("email", "E-mail");
		$this->setCampo("telefone", "Telefone");
		$this->setCampo("assunto", "Assunto");
		$this->setCampo("mensagem", "Mensagem");
		$this->setCampo("anexo", "Anexo");
		$this->setCampo("data", "Data");
		$this->setCampo("ip", "IP");
		$this->setCampo("visualizado", "Visualizado?");
		
		// Seta o campo de descrição da tabela
		$this->setDescription("nome");
		
		// Seta visibilidade dos campos
		$this->setVisibility("nome", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("email", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("telefone", TRUE, TRUE, TRUE, TRUE, FALSE, array('class' => 'no-mask'));
		$this->setVisibility("assunto", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("mensagem", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("anexo", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("data", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("ip", FALSE, FALSE, FALSE, FALSE);
		$this->setVisibility("visualizado", FALSE, FALSE, FALSE, TRUE);

		// Seta os modificadores
        $this->setModifier("anexo", array(
			'type' => "file",
			'preview' => "common/uploads/contato",
			'destination' => APPLICATION_PATH . "/../common/uploads/contato"
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}