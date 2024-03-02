<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Avioes
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Avioesvenda extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_avioes_venda";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idaviaovenda";
	
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
		$this->setCampo("imagem", "Imagem", "Imagem 800x600px [.jpg, .png]");
		$this->setCampo("descricao", "Descrição da listagem (PT)");
		$this->setCampo("descricao_en", "Descrição da listagem (EN)");
		$this->setCampo("descricao_es", "Descrição da listagem (ES)");
		$this->setCampo("banner_desktop", "Banner desktop", "1920x615px [.jpg]");
		$this->setCampo("banner_mobile", "Banner mobile", "520x615px [.jpg]");
		$this->setCampo("frase_centro", "Frase de destaque (PT)");
		$this->setCampo("frase_centro_en", "Frase de destaque (EN)");
		$this->setCampo("frase_centro_es", "Frase de destaque (ES)");
        $this->setCampo("texto", "Texto de destaque (PT)");
        $this->setCampo("texto_en", "Texto de destaque (EN)");
        $this->setCampo("texto_es", "Texto de destaque (ES)");
        $this->setCampo("texto2", "Texto inferior (PT)");
        $this->setCampo("texto2_en", "Texto inferior (EN)");
        $this->setCampo("texto2_es", "Texto inferior (ES)");
		$this->setCampo("ordenacao", "Ordenação", "Ex: 1, 14, 22");
		$this->setCampo("ativo", "Ativo?");
		
		// Seta o campo descrição
		$this->setDescription("titulo");
		
		// Seta a visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("titulo_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("descricao", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("descricao_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("descricao_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("banner_desktop", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("banner_mobile", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase_centro", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("frase_centro_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("frase_centro_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto2", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto2_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto2_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("ordenacao", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);

		// Seta os modificadores
		$this->setModifier("imagem", array(
			'type' => "file",
			'preview' => "common/uploads/aviao",
			'destination' => APPLICATION_PATH . "/../common/uploads/aviao",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/aviao",
			'destination' => APPLICATION_PATH . "/../common/uploads/aviao",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/aviao",
			'destination' => APPLICATION_PATH . "/../common/uploads/aviao",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}