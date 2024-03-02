<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Aviaodetalhes
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Aviaovendadetalhes extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_aviao_detalhes_venda";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idaviaodetalhevenda";

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
		$this->setCampo("idaviaovenda", "Avião");
        $this->setCampo("detalhe", "Título (PT)");
        $this->setCampo("detalhe_en", "Título (EN)");
        $this->setCampo("detalhe_es", "Título (ES)");
		$this->setCampo("img", "Imagem", "1920x1080px [.jpg]");
        $this->setCampo("texto", "Texto (PT)");
        $this->setCampo("texto_en", "Texto (EN)");
        $this->setCampo("texto_es", "Texto (ES)");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("detalhe");

		// Seta visibilidade dos campos
		$this->setVisibility("idaviaovenda", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("detalhe", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("detalhe_en", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("detalhe_es", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("img", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

        // Seta o relacionamento
		$this->setAutocomplete("idaviaovenda", "Admin_Model_Avioesvenda");

		// Seta os modificadores
        $this->setModifier("img", array(
			'type' => "file",
			'preview' => "common/uploads/aviao",
			'destination' => APPLICATION_PATH . "/../common/uploads/aviao",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}