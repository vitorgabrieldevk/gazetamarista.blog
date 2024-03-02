<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Sobre
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Sobre extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_sobre";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idsobre";
	
	/**
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Adiciona os campos ao model
        $this->setCampo("banner_home_desktop", "Banner home desktop", "Imagem 1920x885px [.jpg, .png]");
        $this->setCampo("banner_home_mobile", "Banner home mobile", "Imagem 520x680px [.jpg, .png]");
        $this->setCampo("banner_desktop", "Banner desktop", "Imagem 1920x620px [.jpg, .png]");
        $this->setCampo("banner_mobile", "Banner mobile", "Imagem 520x680px [.jpg, .png]");
		$this->setCampo("frase_banner", "Frase banner (PT)");
		$this->setCampo("frase_banner_en", "Frase banner (EN)");
		$this->setCampo("frase_banner_es", "Frase banner (ES)");
        $this->setCampo("texto1", "Texto Home (PT)");
        $this->setCampo("texto1_en", "Texto Home (EN)");
        $this->setCampo("texto1_es", "Texto Home (ES)");
        $this->setCampo("historia_texto", "História - Texto (PT)");
        $this->setCampo("historia_texto_en", "História - Texto (EN)");
        $this->setCampo("historia_texto_es", "História - Texto (ES)");
        $this->setCampo("imagem_texto", "História - Imagem", "580x670px [.jpg, .png]");
		$this->setCampo("frase_inauguracao", "História - Frase inauguração (PT)");
		$this->setCampo("frase_inauguracao_en", "História - Frase inauguração (EN)");
		$this->setCampo("frase_inauguracao_es", "História - Frase inauguração (ES)");
		$this->setCampo("texto_visao", "Texto Visão (PT)");
		$this->setCampo("texto_visao_en", "Texto Visão (EN)");
		$this->setCampo("texto_visao_es", "Texto Visão (ES)");
		$this->setCampo("texto_missao", "Texto Missão (PT)");
		$this->setCampo("texto_missao_en", "Texto Missão (EN)");
		$this->setCampo("texto_missao_es", "Texto Missão (ES)");
		$this->setCampo("texto_valores", "Texto Valores (PT)");
		$this->setCampo("texto_valores_en", "Texto Valores (EN)");
		$this->setCampo("texto_valores_es", "Texto Valores (ES)");
		$this->setCampo("comoatendemos_imagem", "Como atendemos - Imagem", "800x600px [.jpg, .png]");
		$this->setCampo("comoatendemos_titulo_imagem", "Como atendemos - Título imagem (PT)");
		$this->setCampo("comoatendemos_titulo_imagem_en", "Como atendemos - Título imagem (EN)");
		$this->setCampo("comoatendemos_titulo_imagem_es", "Como atendemos - Título imagem (ES)");
		$this->setCampo("comoatendemos_texto", "Como atendemos - Texto (PT)");
		$this->setCampo("comoatendemos_texto_en", "Como atendemos - Texto (EN)");
		$this->setCampo("comoatendemos_texto_es", "Como atendemos - Texto (ES)");

		$this->setCampo("home_capa_video", "Capa do vídeo home", "1920x800px [.jpg .png]");
		$this->setCampo("home_link_video", "URL vídeo home");
		
		// Seta o campo de descrição da tabela
		$this->setDescription("frase_banner");

		// Seta visibilidade dos campos
		$this->setVisibility("banner_home_desktop", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("banner_home_mobile", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("banner_desktop", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("banner_mobile", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase_banner", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("frase_banner_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("frase_banner_es", TRUE, TRUE, TRUE, FALSE);
        $this->setVisibility("texto1", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto1_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("texto1_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("historia_texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("historia_texto_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("historia_texto_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("imagem_texto", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase_inauguracao", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase_inauguracao_en", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("frase_inauguracao_es", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("texto_visao", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_visao_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_visao_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_missao", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_missao_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_missao_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_valores", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_valores_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_valores_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("comoatendemos_imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("comoatendemos_titulo_imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("comoatendemos_titulo_imagem_en", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("comoatendemos_titulo_imagem_es", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("comoatendemos_texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("comoatendemos_texto_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("comoatendemos_texto_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));

		$this->setVisibility("home_capa_video", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("home_link_video", TRUE, TRUE, FALSE, FALSE);
		
		// Seta os modificadores
		$this->setModifier("banner_home_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_home_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("banner_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("imagem_texto", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("comoatendemos_imagem", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("home_capa_video", array(
			'type' => "file",
			'preview' => "common/uploads/sobre",
			'destination' => APPLICATION_PATH . "/../common/uploads/sobre",
            'extension' => array('jpg', 'jpeg', 'png')
		));
		
		// Continua o carregamento do model
		parent::init();
	}
}