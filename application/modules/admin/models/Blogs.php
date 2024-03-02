<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Blogs
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Blogs extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_blogs";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idblog";
	
	/**
	 * Inicializa o model
	 * 
	 * @name init
	 */
	public function init() {
		// Adiciona os campos ao model
		$this->setCampo("titulo", "Título artigo (PT)");
		$this->setCampo("titulo_en", "Título artigo (EN)");
		$this->setCampo("titulo_es", "Título artigo (ES)");
		$this->setCampo("imagem", "Imagem do artigo", "Imagem 980x595px [.jpg]");
		$this->setCampo("texto", "Texto (PT)");
		$this->setCampo("texto_en", "Texto (EN)");
		$this->setCampo("texto_es", "Texto (ES)");
		$this->setCampo("autor", "Autor (PT)");
		$this->setCampo("autor_en", "Autor (EN)");
		$this->setCampo("autor_es", "Autor (ES)");
		$this->setCampo("tags", "Tags (PT)", "Separar por vírgula (,)");
		$this->setCampo("tags_en", "Tags (EN)", "Separar por vírgula (,)");
		$this->setCampo("tags_es", "Tags (ES)", "Separar por vírgula (,)");
		$this->setCampo("data", "Data", "Data da postagem");
		$this->setCampo("qtd_curtidas", "Curtidas");
        $this->setCampo("qtd_naocurtidas", "Não curtidas");
		$this->setCampo("qtd_views", "Views");
		$this->setCampo("meta_title", "Título SEO (PT)", "Utilizado no mecanismo de busca");
		$this->setCampo("meta_title_en", "Título SEO (EN)", "Utilizado no mecanismo de busca");
		$this->setCampo("meta_title_es", "Título SEO (ES)", "Utilizado no mecanismo de busca");
		$this->setCampo("meta_description", "Descrição SEO (PT)", "Utilizado no mecanismo de busca");
		$this->setCampo("meta_description_en", "Descrição SEO (EN)", "Utilizado no mecanismo de busca");
		$this->setCampo("meta_description_es", "Descrição SEO (ES)", "Utilizado no mecanismo de busca");
		$this->setCampo("ativo", "Ativo?");
		
		// Seta o campo de descrição da tabela
		$this->setDescription("titulo");

		// Seta visibilidade dos campos
		$this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("titulo_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("titulo_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("imagem", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_en", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto_es", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("autor", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("autor_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("autor_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("tags", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("tags_en", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("tags_es", TRUE, TRUE, TRUE, FALSE);
		$this->setVisibility("data", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("qtd_curtidas", FALSE, FALSE, FALSE, TRUE);
        $this->setVisibility("qtd_naocurtidas", FALSE, FALSE, FALSE, TRUE);
		$this->setVisibility("qtd_views", FALSE, FALSE, FALSE, TRUE);
		$this->setVisibility("meta_title", TRUE, TRUE, FALSE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-12 large-6 column end' ));
		$this->setVisibility("meta_title_en", TRUE, TRUE, FALSE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-12 large-6 column end' ));
		$this->setVisibility("meta_title_es", TRUE, TRUE, FALSE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-12 large-6 column end' ));
		$this->setVisibility("meta_description", TRUE, TRUE, FALSE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-12 large-6 column end' ));
		$this->setVisibility("meta_description_en", TRUE, TRUE, FALSE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-12 large-6 column end' ));
		$this->setVisibility("meta_description_es", TRUE, TRUE, FALSE, FALSE, FALSE, array( 'nclass' => 'input-form small-12 medium-12 large-6 column end' ));
		$this->setVisibility("ativo", FALSE, TRUE, FALSE, TRUE);
		
		// Seta os modificadores
		$this->setModifier("imagem", array(
			'type' => "file",
			'preview' => "common/uploads/blog",
			'destination' => APPLICATION_PATH . "/../common/uploads/blog",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		// Seta o autocomplete personalizado (name 'unicos')
        $id_blog = Zend_Controller_Front::getInstance()->getRequest()->getParam('idblog');
		$select = $this->select();
		$select->where("ativo = 1");
		foreach(explode(",", $id_blog) as $param) {
			if($param != "") {
				$select->where("NOT idblog = ?", $param);
			}
		}
		$this->setQueryAutoComplete("unicos", $select);
		
		// Continua o carregamento do model
		parent::init();
	}
}