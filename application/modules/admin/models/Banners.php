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
		$this->setCampo("titulo", "Título (PT)");
		$this->setCampo("titulo_en", "Título (EN)");
		$this->setCampo("titulo_es", "Título (ES)");
		$this->setCampo("frase1", "Frase 1 (PT)");
		$this->setCampo("frase1_en", "Frase 1 (EN)");
		$this->setCampo("frase1_es", "Frase 1 (ES)");
		$this->setCampo("frase2", "Frase 2 (PT)");
		$this->setCampo("frase2_en", "Frase 2 (EN)");
		$this->setCampo("frase2_es", "Frase 2 (ES)");
		$this->setCampo("txt_botao", "Texto botão (PT)");
		$this->setCampo("txt_botao_en", "Texto botão (EN)");
		$this->setCampo("txt_botao_es", "Texto botão (ES)");
		$this->setCampo("link", "Link (PT)", "Ex: http://www.site.com.br");
		$this->setCampo("link_en", "Link (EN)", "Ex: http://www.site.com.br");
		$this->setCampo("link_es", "Link (ES)", "Ex: http://www.site.com.br");
		$this->setCampo("link_novajanela", "Abrir link em nova janela?");
		$this->setCampo("imagem_desktop", "Imagem desktop", "1036x673px [.png]");
		$this->setCampo("imagem_mobile", "Imagem mobile", "400x400px [.png]");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22...");
		$this->setCampo("ativo", "Ativo?");

		// Seta o campo de descrição da tabela
		$this->setDescription("titulo");

		// Seta visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_en", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_es", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("frase1", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase1_en", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase1_es", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase2", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase2_en", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase2_es", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("txt_botao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("txt_botao_en", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("txt_botao_es", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("link", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("link_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("link_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("link_novajanela", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("imagem_desktop", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("imagem_mobile", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("ordenacao", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

		// Seta os modificadores
		$this->setModifier("imagem_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/banner",
			'destination' => APPLICATION_PATH . "/../common/uploads/banner",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("imagem_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/banner",
			'destination' => APPLICATION_PATH . "/../common/uploads/banner",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}