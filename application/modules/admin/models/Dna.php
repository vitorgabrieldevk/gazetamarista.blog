<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Dna
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Dna extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_dna";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "iddna";

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
	 * @name $_gerarXls
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
		$this->setCampo("titulo", "Título (PT)");
		$this->setCampo("titulo_en", "Título (EN)");
		$this->setCampo("titulo_es", "Título (ES)");
		$this->setCampo("texto", "Texto (PT)");
		$this->setCampo("texto_en", "Texto (EN)");
		$this->setCampo("texto_es", "Texto (ES)");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("titulo");

		// Seta visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_en", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_es", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, TRUE, TRUE);
		
		// Continua o carregamento do model
		parent::init();
	}
}