<?php

/**
 * Modelo da tabela de E-mails
 *
 * @name Admin_Model_Emails
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Emails extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_emails";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idemail";

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
		//$this->setCampo("nome", "Nome");
		$this->setCampo("email", "E-mail");
		$this->setCampo("data", "Data");
		$this->setCampo("ip", "IP");
		
		// Seta o campo de descrição da tabela
		$this->setDescription("email");
		
		// Seta visibilidade dos campos
		//$this->setVisibility("nome", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("email", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("data", FALSE, TRUE, TRUE, TRUE);
		$this->setVisibility("ip", TRUE, TRUE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-3 large-2 column end' ));
		
		// Continua o carregamento do model
		parent::init();
	}
}