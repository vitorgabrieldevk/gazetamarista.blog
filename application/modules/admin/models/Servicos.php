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
        $this->setCampo("titulo", "Título (PT)");
		$this->setCampo("titulo_en", "Título (EN)");
		$this->setCampo("titulo_es", "Título (ES)");
		$this->setCampo("imagem", "Imagem", "1920x615px [.jpg]");
		$this->setCampo("banner_desktop", "Banner desktop", "1920x615px [.jpg]");
		$this->setCampo("banner_mobile", "Banner mobile", "520x615px [.jpg]");
        $this->setCampo("texto1", "Texto 1 (PT)");
        $this->setCampo("texto1_en", "Texto 1 (EN)");
        $this->setCampo("texto1_es", "Texto 1 (ES)");
        $this->setCampo("texto2", "Texto 2 (PT)");
        $this->setCampo("texto2_en", "Texto 2 (EN)");
        $this->setCampo("texto2_es", "Texto 2 (ES)");
		$this->setCampo("travar_menu", "Travar menu?");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("titulo");

		// Seta visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_en", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_es", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("banner_desktop", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("banner_mobile", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("texto1", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto1_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto1_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto2", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto2_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto2_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("travar_menu", FALSE, FALSE, FALSE, TRUE);
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

		// Seta os modificadores
        $this->setModifier("imagem", array(
			'type' => "file",
			'preview' => "common/uploads/servico",
			'destination' => APPLICATION_PATH . "/../common/uploads/servico",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/servico",
			'destination' => APPLICATION_PATH . "/../common/uploads/servico",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/servico",
			'destination' => APPLICATION_PATH . "/../common/uploads/servico",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}