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

        // Assina na View
        $this->view->path = $path;
        $this->view->noticias = $noticias;

    }

    /**
     * Página de formulário de contato/trabalhe/agenda...
     */
    public function contatoAction() {
        // Assunto
        $assunto = $this->sanitize->sanitizestring($this->_request->getParam("assunto", ""), "search");

        if($assunto == "trabalhe-conosco") {
            // Meta title
            $this->view->headTitle()->prepend($this->traducao['rodape']['trabalhe_conosco']);
        }

        if($assunto == "agendar-atendimento") {
            // Meta title
            $this->view->headTitle()->prepend($this->traducao['assuntos']['agendar_atendimento']);
        }

        // View
        $this->view->assunto = $assunto;
    }

    /**
     * Página de quem somos
     */
    public function historiaAction() {
        // Sobre
        $sobre    = (new Admin_Model_Sobre())->fetchRow(array('idsobre = ?' => 1));
        $dna      = (new Admin_Model_Dna())->fetchAll(array("ativo = 1"), "ordenacao ASC");

        // View
        $this->view->sobre = $sobre;
        $this->view->dna   = $dna;
    }

    /**
     * Página listagem de bases
     */
    public function basesAction() {
        // Bases
        $bases = (new Admin_Model_Bases())->fetchAll(array("ativo = 1"), "ordenacao ASC");

        $arr_bases = array();
        foreach($bases as $base) {
            // Facilidades
            $facilidades = (new Admin_Model_Baseitens())->fetchAll(array("idbase = ?" => $base->idbase, "tipo = ?" => "facilidade"), "ordenacao ASC");

            // Serviços
            $servicoes = (new Admin_Model_Baseitens())->fetchAll(array("idbase = ?" => $base->idbase, "tipo = ?" => "serviço"), "ordenacao ASC");

            // Array base
            $arr_bases[] = array(
                'base'        => $base ? $base->toArray() : null,
                'facilidades' => $facilidades ? $facilidades->toarray() : null,
                'servicos'    => $servicoes ? $servicoes->toarray() : null
            );
        }

        // View
        $this->view->arr_bases = $arr_bases;
    }

    /**
     * Página serviço
     */
    public function servicoAction() {
        // Busca o parametro
        $idservico = $this->sanitize->sanitizestring($this->_request->getParam("idservico", 0), "search");

        // Verifica parâmetro
        if($idservico > 0) {
            // Serviço
            $servico = (new Admin_Model_Servicos())->fetchRow(array("idservico = ?" => $idservico, "ativo = 1"));
            if($servico) {
                // Serviço Itens
                $itens = (new Admin_Model_Servicoitens())->fetchAll(array("idservico = ?" => $idservico), "ordenacao ASC");

                // View
                $this->view->servico = $servico;
                $this->view->itens = $itens;

                // Meta Title
                $this->view->headTitle()->prepend($servico["titulo$this->cod_lingua"]);
                $og_arr['titulo'] = $servico["titulo$this->cod_lingua"] . ' | ' . $this->session_config->dados->nome_site;

                // Meta Description
                if (!empty($servico["texto1$this->cod_lingua"])) {
                    $this->view->headMeta()->setName("description", substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($servico["texto1$this->cod_lingua"])), 0,250));
                    $og_arr['descricao'] = substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($servico["texto1$this->cod_lingua"])), 0,250);
                } else {
                    $this->view->headMeta()->setName("description", $servico["titulo$this->cod_lingua"]);
                    $og_arr['descricao'] = $servico["titulo$this->cod_lingua"];
                }

                // Url
                $slug = new gazetamarista_View_Helper_CreateSlug();
                $og_arr['url'] = $this->view->url(['idservico'=>$idservico, 'slug'=>$slug->createslug($servico["titulo$this->cod_lingua"])], 'servico');

                // Imagem
                if(!empty($servico['imagem']) && file_exists("common/uploads/servico/" . $servico['imagem'])) {
                    $og_arr['imagem'] = $this->dominio . "/thumb/servico/2/940/490/" . $servico['imagem'];
                }
                $this->view->og_arr = $og_arr;
            }else{
                // ERRO
                $this->messages->error = $this->traducao['servicos']['nao_encontrado'];
                redirect_route('home');
            }
        }else{
            // ERRO
            $this->messages->error = $this->traducao['servicos']['invalido'];
            redirect_route('home');
        }
    }

    /**
     * Página listagem de aeronaves da frota
     */
    public function frotaAction() {
        // Avioes
        $avioes = (new Admin_Model_Avioes())->fetchAll(array("ativo = 1"), "ordenacao ASC");

        // View
        $this->view->avioes = $avioes;
    }

    /**
     * Página detalhe de aeronaves da frota
     */
    public function frotaDetalheAction() {
        // Busca o parametro
        $idaviao = $this->sanitize->sanitizestring($this->_request->getParam("idaviao", 0), "search");

        // Verifica parâmetro
        if($idaviao > 0) {
            // Avião
            $aviao = (new Admin_Model_Avioes())->fetchRow(array("idaviao = ?" => $idaviao, "ativo = 1"));

            if($aviao) {
                // Aviao Itens
                $itens = (new Admin_Model_Aviaoitens())->fetchAll(array("idaviao = ?" => $idaviao), "ordenacao ASC");

                // Avião detalhes
                $detalhes = (new Admin_Model_Aviaodetalhes())->fetchAll(array("idaviao = ?" => $idaviao, "ativo = 1"), "ordenacao ASC");

                // View
                $this->view->aviao      = $aviao;
                $this->view->itens      = $itens;
                $this->view->detalhes   = $detalhes;

                // Meta Title
                $this->view->headTitle()->prepend($aviao["titulo$this->cod_lingua"]);
                $og_arr['titulo'] = $aviao["titulo$this->cod_lingua"] . ' | ' . $this->session_config->dados->nome_site;

                // Meta Description
                if (!empty($aviao["descricao$this->cod_lingua"])) {
                    $this->view->headMeta()->setName("description", substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($aviao["descricao$this->cod_lingua"])), 0,250));
                    $og_arr['descricao'] = substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($aviao["descricao$this->cod_lingua"])), 0,250);
                } else {
                    $this->view->headMeta()->setName("description", $aviao["titulo$this->cod_lingua"]);
                    $og_arr['descricao'] = $aviao["titulo$this->cod_lingua"];
                }

                // Url
                $slug = new gazetamarista_View_Helper_CreateSlug();
                $og_arr['url'] = $this->view->url(['idaviao'=>$idaviao, 'slug'=>$slug->createslug($aviao["titulo$this->cod_lingua"])], 'frota-detalhe');

                // Imagem
                if(!empty($aviao['imagem']) && file_exists("common/uploads/aviao/" . $aviao['imagem'])) {
                    $og_arr['imagem'] = $this->dominio . "/thumb/aviao/2/940/490/" . $aviao['imagem'];
                }
                $this->view->og_arr = $og_arr;
            }else{
                // ERRO
                $this->messages->error = $this->traducao['frota']['nao_encontrado'];
                $this->_redirectroute('frota');
            }
        }else{
            // ERRO
            $this->messages->error = $this->traducao['frota']['invalido'];
            $this->_redirectroute('frota');
        }
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
        // Param
        $pagina = $this->sanitize->sanitizestring($this->_request->getParam("pagina", ""), "search");
        $status = $this->sanitize->sanitizestring($this->_request->getParam("status", ""), "search");

        if (!empty($pagina) && !empty($status)) {
            // Busca a sessão do retorno
            $retorno = new Zend_Session_Namespace("telaretorno");

            // Assina na view
            $this->view->pagina = $pagina;
            $this->view->status = $status;
            $this->view->title  = $retorno->title;
            $this->view->msg    = $retorno->mensagem;
        } else {
            // Adiciona a mensagem de erro à sessão
            $this->messages->error = $this->traducao['retorno']['invalido'];
            $this->_redirect($_SERVER["HTTP_REFERER"]);
        }

        // Ativa o menu alternativo
        $this->view->alternative = true;
    }

      /**
     * Página listagem de aeronaves de venda
     */
    public function vendaAction() {
        // Avioes
        $avioesvenda = (new Admin_Model_Avioesvenda())->fetchAll(array("ativo = 1"), "ordenacao ASC");

        // View
        $this->view->avioesvenda = $avioesvenda;
    }

    /**
     * Página detalhe de aeronaves da frota
     */
    public function vendaDetalheAction() {
        // Busca o parametro
        $idaviaovenda = $this->sanitize->sanitizestring($this->_request->getParam("idaviaovenda", 0), "search");

        // Verifica parâmetro
        if($idaviaovenda > 0) {
            // Avião
            $aviaovenda = (new Admin_Model_Avioesvenda())->fetchRow(array("idaviaovenda = ?" => $idaviaovenda, "ativo = 1"));

            if($aviaovenda) {
                // Aviao Itens
                $itens = (new Admin_Model_Aviaovendaitens())->fetchAll(array("idaviaovenda = ?" => $idaviaovenda), "ordenacao ASC");

                // Avião detalhes
                $detalhes = (new Admin_Model_Aviaovendadetalhes())->fetchAll(array("idaviaovenda = ?" => $idaviaovenda, "ativo = 1"), "ordenacao ASC");

                // View
                $this->view->aviao      = $aviaovenda;
                $this->view->itens      = $itens;
                $this->view->detalhes   = $detalhes;

                // Meta Title
                $this->view->headTitle()->prepend($aviaovenda["titulo$this->cod_lingua"]);
                $og_arr['titulo'] = $aviaovenda["titulo$this->cod_lingua"] . ' | ' . $this->session_config->dados->nome_site;

                // Meta Description
                if (!empty($aviaovenda["descricao$this->cod_lingua"])) {
                    $this->view->headMeta()->setName("description", substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($aviaovenda["descricao$this->cod_lingua"])), 0,250));
                    $og_arr['descricao'] = substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($aviaovenda["descricao$this->cod_lingua"])), 0,250);
                } else {
                    $this->view->headMeta()->setName("description", $aviaovenda["titulo$this->cod_lingua"]);
                    $og_arr['descricao'] = $aviaovenda["titulo$this->cod_lingua"];
                }

                // Url
                $slug = new gazetamarista_View_Helper_CreateSlug();
                $og_arr['url'] = $this->view->url(['idaviaovenda'=>$idaviaovenda, 'slug'=>$slug->createslug($aviaovenda["titulo$this->cod_lingua"])], 'frota-detalhe');

                // Imagem
                if(!empty($aviaovenda['imagem']) && file_exists("common/uploads/aviao/" . $aviaovenda['imagem'])) {
                    $og_arr['imagem'] = $this->dominio . "/thumb/aviao/2/940/490/" . $aviaovenda['imagem'];
                }
                $this->view->og_arr = $og_arr;
            }else{
                // ERRO
                $this->messages->error = $this->traducao['frota']['nao_encontrado'];
                $this->_redirectroute('frota');
            }
        }else{
            // ERRO
            $this->messages->error = $this->traducao['frota']['invalido'];
            $this->_redirectroute('frota');
        }
    }
}