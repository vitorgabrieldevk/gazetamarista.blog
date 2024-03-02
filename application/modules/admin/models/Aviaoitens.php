<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Aviaoitens
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Aviaoitens extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_aviaoitens";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idaviaoitem";

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
		$this->setCampo("idaviao", "Avião");
		$this->setCampo("tipo", "Tipo");
		$this->setCampo("item", "Item (PT)");
		$this->setCampo("item_en", "Item (EN)");
		$this->setCampo("item_es", "Item (ES)");
		$this->setCampo("conteudo", "Descrição (PT)");
		$this->setCampo("conteudo_en", "Descrição (EN)");
		$this->setCampo("conteudo_es", "Descrição (ES)");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");

		// Seta o campo de descrição da tabela
		$this->setDescription("item");

		// Seta visibilidade dos campos
		$this->setVisibility("idaviao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("tipo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("item", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("item_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("item_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("conteudo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("conteudo_en", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("conteudo_es", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);

        // Seta o relacionamento
		$this->setAutocomplete("idaviao", "Admin_Model_Avioes");
		
		// Continua o carregamento do model
		parent::init();
	}
}