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
	protected $_name = "sobre";

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
	
		// Seta Campo
        $this->setCampo("titulo", "Titulo Sessão");
        $this->setCampo("texto1", "Texto 1");
        $this->setCampo("texto2", "Texto 2");
        $this->setCampo("objetivo", "Objetivo");
        $this->setCampo("tag", "Tag");

		// Seta Visibilidade
        $this->setVisibility("titulo", TRUE, TRUE, TRUE, TRUE);
		$this->setVisibility("texto1", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
		$this->setVisibility("texto2", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor' => ''));
        $this->setVisibility("objetivo", TRUE, TRUE, TRUE, TRUE);
        $this->setVisibility("tag", TRUE, TRUE, TRUE, TRUE);	
		
		// Continua o carregamento do model
		parent::init();
	}
}