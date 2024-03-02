<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Bases
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Bases extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_bases";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idbase";
	
	/**
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Seta os campos do model
		$this->setCampo("titulo", "Título (PT)");
		$this->setCampo("titulo_en", "Título (EN)");
		$this->setCampo("titulo_es", "Título (ES)");
		$this->setCampo("imagem", "Imagem", "Imagem 480x330px [.jpg, .png]");
		$this->setCampo("area_construida", "Área construída", "Ex: 2.500 m2");
		$this->setCampo("descricao", "Descrição (PT)");
		$this->setCampo("descricao_en", "Descrição (EN)");
		$this->setCampo("descricao_es", "Descrição (ES)");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");
		$this->setCampo("ativo", "Ativo?");
		
		// Seta o campo descrição
		$this->setDescription("titulo");
		
		// Seta a visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("titulo_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("area_construida", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("descricao", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("descricao_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("descricao_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("ordenacao", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

		// Seta os modificadores
		$this->setModifier("imagem", array(
			'type' => "file",
			'preview' => "common/uploads/base",
			'destination' => APPLICATION_PATH . "/../common/uploads/base",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}