<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Servicoitens
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Servicoitens extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_servicoitens";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idservicoitem";

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
		$this->setCampo("idservico", "Serviço");
		$this->setCampo("item", "Título item (PT)");
		$this->setCampo("item_en", "Título item (EN)");
		$this->setCampo("item_es", "Título item (ES)");
        $this->setCampo("img", "Imagem", "590x360px [.jpg, .png]");
		$this->setCampo("descricao", "Descrição (PT)");
		$this->setCampo("descricao_en", "Descrição (EN)");
		$this->setCampo("descricao_es", "Descrição (ES)");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("item");

		// Seta visibilidade dos campos
		$this->setVisibility("idservico", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("item", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("item_en", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("item_es", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("img", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("descricao", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("descricao_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("descricao_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, TRUE, TRUE);

		// Seta os modificadores
        $this->setModifier("img", array(
			'type' => "file",
			'preview' => "common/uploads/servico",
			'destination' => APPLICATION_PATH . "/../common/uploads/servico"
		));

        // Seta o relacionamento
		$this->setAutocomplete("idservico", "Admin_Model_Servicos");
		
		// Continua o carregamento do model
		parent::init();
	}
}