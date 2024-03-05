<?php

/**
 * Controlador da index do institucional
 *
 * @name IndexController
 */
class IndexController extends Zend_Controller_Action {
    /**
     *
     */
    public function init() {
        /* Initialize action controller here */
        
        // Setlocale
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
        
        // Função de bloquear injection
        $this->sanitize = new gazetamarista_Sanitize();
        
        // Cria a sessão das mensagens e cliente
        $this->messages = new Zend_Session_Namespace("messages");
        $this->session_config = new Zend_Session_Namespace("configuracao");

        // Busca as configurações
        $config = Zend_Registry::get("config");

        // Domínio
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $this->dominio = "http://localhost" . $config->gazetamarista->config->basepath;
        } elseif ($_SERVER['HTTP_HOST'] == "sites.gazetamarista.com.br") {
            $this->dominio = "http://sites.gazetamarista.com.br" . $config->gazetamarista->config->basepath;
        } elseif ($_SERVER['HTTP_HOST'] == "local.gazetamarista.com.br") {
            $this->dominio = "http://local.gazetamarista.com.br" . $config->gazetamarista->config->basepath;
        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.222") {
            $this->dominio = "http://192.168.1.222" . $config->gazetamarista->config->basepath;
        } else {
            $this->dominio = "https://" . $config->gazetamarista->config->domain;
        }
        
        $this->view->dominio = $this->dominio;

        // View
        $this->view->linguagem       = $this->linguagem->lingua;
        $this->view->linguagem_tipo  = $cod_lingua;
        $this->view->translate       = $this->traducao;
    }

    /**
     * Página inicial
     */
    public function indexAction() {

        $config = Zend_Registry::get("config");
        $path = $config->gazetamarista->config->basepath;

        // Busca as Noticias
        $noticias = (new Admin_Model_Blogs())->fetchAll(array("ativo = 1"), "data DESC");
        $categorias = (new Admin_Model_Categorias())->fetchAll(array("ativo = 1"), "idCategoria ASC");
        $bannerNoticia = (new Admin_Model_Blogs())->fetchAll(array("ativo = 1"), "data DESC", "LIMIT 1");
        
        // Assina na View
        $this->view->path = $path;
        $this->view->bannerNoticia = $bannerNoticia;
        $this->view->categorias = $categorias;
        $this->view->noticias = $noticias;

    }

    /**
     * Página de formulário de contato/trabalhe/agenda...
     */
    public function contatoAction() {
        
    }

    /**
     * Página de quem somos
     */
    public function historiaAction() {
        
    }

    /**
     * Página listagem de bases
     */
    public function basesAction() {
        
    }

    /**
     * Página serviço
     */
    public function servicoAction() {
        
    }

    /**
     * Página listagem de aeronaves da frota
     */
    public function frotaAction() {
        
    }

    /**
     * Página detalhe de aeronaves da frota
     */
    public function frotaDetalheAction() {
        
    }

    /**
     * Tela de retorno do envio de formulário
     * Pagina = email, contato...
     * Status = 'erro' ou 'sucesso'
     *
     * @param String $pagina
     * @param String $status
     *
     */
    public function telaretornoAction() {
        
    }

      /**
     * Página listagem de aeronaves de venda
     */
    public function vendaAction() {
        
    }

    /**
     * Página detalhe de aeronaves da frota
     */
    public function vendaDetalheAction() {
       
    }
}