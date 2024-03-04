<?php

/**
 * Modelo da tabela
 *
 * @name Admin_Model_Configuracoes
 * @see Zend_Db_Table_Abstract
 */
class Admin_Model_Configuracoes extends gazetamarista_Db_Table {
	/**
	 * Armazena o nome da tabela
	 *
	 * @access protected
	 * @name $_name
	 * @var string
	 */
	protected $_name = "zend_configuracoes";

	/**
	 * Armazena o nome do campo da tabela primaria
	 *
	 * @access protected
	 * @name $_primary
	 * @var string
	 */
	protected $_primary = "idconfiguracao";

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
	 * @name $_gerarXls
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
	public function init()
    {
        // Adiciona os campos ao model
        // $this->setCampo("ativar_traducao", "Tradução ativo?");
        $this->setCampo("nome_site", "Nome site");
        $this->setCampo("email_padrao", "E-mail padrão", "separar por vírgula (,)");
		$this->setCampo("email_contato", "E-mail contato", "separar por vírgula (,)");
		$this->setCampo("email_trabalhe", "E-mail trabalhe conosco", "separar por vírgula (,)");
        // Info
		$this->setCampo("google_play", "Google Play");
		$this->setCampo("apple_store", "Apple Store");
        $this->setCampo("texto_bloco_app_home", "Texto bloco app home");
		$this->setCampo("link_area_cliente", "Link área do cliente");
		$this->setCampo("facebook", "Facebook");
        $this->setCampo("instagram", "Instagram");
        $this->setCampo("linkedin", "LinkedIn");
        $this->setCampo("whatsapp", "WhatsApp");
       
        $this->setCampo("endereco", "Endereço");
        $this->setCampo("link_maps", "Link Google maps");
        
        // Configs
        $this->setCampo("recaptcha_key", "Recaptcha key");
        $this->setCampo("recaptcha_secret", "Recaptcha secret key");
        $this->setCampo("share_tag", "Tag compartilhamento");
        $this->setCampo("codigo_final_head", "HTML final da head");
        $this->setCampo("codigo_inicio_body", "HTML início do body");
        $this->setCampo("codigo_final_body", "HTML final do body");
        $this->setCampo("politica_cookie_texto", "Texto política de cookies");

        // Seta o campo de descrição da tabela
		$this->setDescription("nome_site");

        // Seta visibilidade dos campos
        // $this->setVisibility("ativar_traducao", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("nome_site", TRUE, TRUE, FALSE, TRUE);
        $this->setVisibility("email_padrao", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("email_contato", TRUE, TRUE, FALSE, TRUE);
		$this->setVisibility("email_trabalhe", TRUE, TRUE, FALSE, TRUE);
		// Info
		$this->setVisibility("google_play", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("apple_store", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("texto_bloco_app_home", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("link_area_cliente", TRUE, TRUE, FALSE, FALSE);
		$this->setVisibility("facebook", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("instagram", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("linkedin", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("whatsapp", TRUE, TRUE, FALSE, FALSE);

		// Info
        $this->setVisibility("endereco", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("link_maps", TRUE, TRUE, FALSE, FALSE);

        // Configs
        $this->setVisibility("recaptcha_key", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("recaptcha_secret", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("share_tag", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("codigo_final_head", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("codigo_inicio_body", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("codigo_final_body", TRUE, TRUE, FALSE, FALSE);
        $this->setVisibility("politica_cookie_texto", TRUE, TRUE, FALSE, FALSE, FALSE, array('data-ckeditor-big' => ''));

        // Seta os modificadores
		$this->setModifier("frota_banner_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/configuracao",
			'destination' => APPLICATION_PATH . "/../common/uploads/configuracao",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("frota_banner_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/configuracao",
			'destination' => APPLICATION_PATH . "/../common/uploads/configuracao",
            'extension' => array('jpg', 'jpeg', 'png')
		));

          // Seta os modificadores
		$this->setModifier("venda_banner_desktop", array(
			'type' => "file",
			'preview' => "common/uploads/configuracao",
			'destination' => APPLICATION_PATH . "/../common/uploads/configuracao",
            'extension' => array('jpg', 'jpeg', 'png')
		));

		$this->setModifier("venda_banner_mobile", array(
			'type' => "file",
			'preview' => "common/uploads/configuracao",
			'destination' => APPLICATION_PATH . "/../common/uploads/configuracao",
            'extension' => array('jpg', 'jpeg', 'png')
		));

        // Continua o carregamento do model
        parent::init();
    }
}