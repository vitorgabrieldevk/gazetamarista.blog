<?php

/**
 * Modelo da tabela de banners
 *
 * @name Admin_Model_Banners
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Banners extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_banners";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idbanner";

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
		$this->setCampo("titulo", "Título");
		$this->setCampo("frase", "Frase Banner");
		$this->setCampo("link", "Link", "Ex: http://www.gazetamarista.blog");
		$this->setCampo("link_novajanela", "Abrir link em nova janela?");
		$this->setCampo("imagem_desktop", "Imagem desktop", "1036x673px [.png]");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22...");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("titulo");

		// Seta visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("frase", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("link", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("link_novajanela", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("imagem_desktop", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

		// Seta os modificadores
		$this->setModifier("imagem_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/banner",
			'destination' => APPLICATION_PATH . "/../common/uploads/banner",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}