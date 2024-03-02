<?php

/**
 * Controlador institucional
 *
 * @name BlogController
 */
class BlogController extends Zend_Controller_Action
{
    /**
     *
     */
    public function init()
    {
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

        // Model
        $this->model_blogs = new Admin_Model_Blogs();

        // Seta a sessão de linguagem
        $this->linguagem 	= new Zend_Session_Namespace("linguagem");

        switch ($this->linguagem->lingua) {
        	case 'Espanhol':
                $linguagem_tipo = 'es';
                $cod_lingua = "_es";
                break;

            case 'Inglês':
                $linguagem_tipo = 'en';
                $cod_lingua = "_en";
                break;

            case 'Português':
                $linguagem_tipo = 'pt_BR';
                $cod_lingua = "";
                break;

            default:
            	$this->linguagem->lingua = 'Português';
                $linguagem_tipo = 'pt_BR';
                $cod_lingua = "";
                break;
        }
        $this->cod_lingua = $cod_lingua;

        // Busca as traduções
        $translate = Zend_Registry::get("translate");

        // Captura a tradução
        $this->traducao = $translate->getAdapter()->getMessages($linguagem_tipo);

        // View
        $this->view->linguagem       = $this->linguagem->lingua;
        $this->view->linguagem_tipo  = $cod_lingua;
        $this->view->translate       = $this->traducao;
    }
    
    /**
     * Página noticias listagem
     */
    public function indexAction()
    {
        // Parametros
        $current_page = $this->sanitize->sanitizestring($this->_request->getParam("page", 1), "search");
        $termo = $this->sanitize->sanitizestring($this->getParam('termo', ""), "search"); // get

        // Verifica se foi efetuado uma busca
        if ($this->_request->isPost()) {
            $busca = $this->sanitize->sanitizestring($this->_request->getParam("search", ""), "search"); // post

            // Atualiza a variável com o termo buscado
            $termo_txt = preg_replace('/[`^~\'"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $busca));

            //$comAcentos = array('à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ü', 'ú', 'ÿ', 'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'O', 'Ù', 'Ü', 'Ú');
            //$semAcentos = array('a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'y', 'A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'N', 'O', 'O', 'O', 'O', 'O', '0', 'U', 'U', 'U');
            //$termo_txt = str_replace($comAcentos, $semAcentos, $busca);

            if (!empty($termo_txt)) {
                // Redirect
                redirect_route('noticias', array('page' => '1', 'termo' => $termo_txt));
            }
        }

        // Blogs
		$select = $this->model_blogs->select()
			->from($this->model_blogs->getTableName(), array("*"))
            ->where("ativo = 1")
            ->where("data <= CURDATE()")
            ->order("data DESC")
            ->order("idblog DESC")
            ->setIntegrityCheck(FALSE);

		// Verifica se existe o termo get
        if(!empty($termo)) {
            // Instancia o db
            $db = Zend_Registry::get("db");

            // Limpa texto
            $termo = preg_replace('/[`^~\"]/', null, iconv('UTF-8', 'ASCII//TRANSLIT', $termo));

            $select
                ->where("
                    LOWER(titulo$this->cod_lingua) LIKE _utf8 " . $db->quote("%" . strtolower($termo) . "%") . " COLLATE utf8_unicode_ci
                    OR LOWER(texto$this->cod_lingua) LIKE _utf8 " . $db->quote("%" . strtolower($termo) . "%") . " COLLATE utf8_unicode_ci
                    OR LOWER(autor$this->cod_lingua) LIKE _utf8 " . $db->quote("%" . strtolower($termo) . "%") . " COLLATE utf8_unicode_ci
                    OR LOWER(tags$this->cod_lingua) LIKE _utf8 " . $db->quote("%" . strtolower($termo) . "%") . " COLLATE utf8_unicode_ci
                ");

            // MetaTag
            $txtbusca_meta = $this->traducao['noticias']['termo_buscado'] . ' `' . strtolower($termo) . '`. | ';

            // SEO
            $og_arr['titulo'] = $this->traducao['topo']['noticias'] . ' | ' . $txtbusca_meta . $this->session_config->dados->nome_site;
            $this->view->og_arr = $og_arr;

            // Meta title
            $this->view->headTitle()->append($this->traducao['noticias']['termo_buscado'] . ' `' . strtolower($termo) . '`');
        }

        // Busca os dados no banco (com paginação - Cria o paginator)
        $blogs = new gazetamarista_Paginator($select);
        $blogs
            ->setItemCountPerPage(12)
            ->setCurrentPageNumber($current_page)
            ->setPageRange(10)
            ->assign();

        // Assina na view
        $this->view->termo = $termo;
        $this->view->paginator = $blogs;
    }
    
    /**
     * Página noticia detalhe
     */
    public function noticiaAction()
    {
        // Busca o parametro
        $idpost = $this->sanitize->sanitizestring($this->_request->getParam("idnoticia", 0), "search");

        // Verifica parâmetro
        if($idpost > 0) {
            // Blog
            $select = $this->model_blogs->select()
                ->from($this->model_blogs->getTableName(), array("*"))
                ->where("ativo = 1")
                ->where("data <= CURDATE()")
                ->where("idblog = ?", $idpost)
                ->setIntegrityCheck(FALSE);

            // Busca os dados no banco
            $blog = $this->model_blogs->fetchRow($select);

            if($blog) {
                // Array
                $blog = $blog->toarray();

                // Adiciona um view no post
                $qtd_view = $blog['qtd_views'];
                $this->model_blogs->update(array("qtd_views" => $qtd_view+1), array("idblog = ?" => $idpost));

                // Outros blogs
                $select_outrosblogs = $this->model_blogs->select()
                    ->where("ativo = 1")
                    ->where("data <= CURDATE()")
                    ->where("idblog != ?", $idpost)
                    ->order("qtd_views DESC")
                    ->limit(3);

                // Fetch
                $outrosblogs = $this->model_blogs->fetchAll($select_outrosblogs);

                // Meta Title
                if(!empty($blog["meta_title$this->cod_lingua"])) {
                    $this->view->headTitle()->prepend($blog["meta_title$this->cod_lingua"]);
                    $og_arr['titulo'] = $blog["meta_title$this->cod_lingua"] . ' | ' . $this->session_config->dados->nome_site;
                } else {
                    $this->view->headTitle()->prepend($blog["titulo$this->cod_lingua"]);
                    $og_arr['titulo'] = $blog["titulo$this->cod_lingua"] . ' | ' . $this->session_config->dados->nome_site;
                }

                // Meta Description
                if (!empty($blog["meta_description$this->cod_lingua"])) {
                    $this->view->headMeta()->setName("description", strip_tags($blog["meta_description$this->cod_lingua"]));
                    $og_arr['descricao'] = substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($blog["meta_description$this->cod_lingua"])), 0,250);
                } else {
                    if (!empty($blog["texto$this->cod_lingua"])) {
                        $this->view->headMeta()->setName("description", substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($blog["texto$this->cod_lingua"])), 0,250));
                        $og_arr['descricao'] = substr(preg_replace( "/\r|\n|nbsp;|&amp;/", "", strip_tags($blog["texto$this->cod_lingua"])), 0,250);
                    } else {
                        $this->view->headMeta()->setName("description", $blog["titulo$this->cod_lingua"]);
                        $og_arr['descricao'] = $blog["titulo$this->cod_lingua"];
                    }
                }

                // Url
                $slug = new gazetamarista_View_Helper_CreateSlug();
                $og_arr['url'] = $this->view->url(['idnoticia'=>$idpost, 'slug'=>$slug->createslug($blog["titulo$this->cod_lingua"])], 'noticia');

                // Imagem
                if(!empty($blog['imagem']) && file_exists("common/uploads/blog/" . $blog['imagem'])) {
                    $og_arr['imagem'] = $this->dominio . "/thumb/blog/1/940/490/" . $blog['imagem'];
                }
                $this->view->og_arr = $og_arr;

                // View
                $this->view->noticia     = $blog;
                $this->view->outrosblogs = $outrosblogs;
            }else{
                // ERRO
                $this->messages->error = $this->traducao['noticias']['nao_encontrada'];
                redirect_route('noticias');
            }
        }else{
            // ERRO
            $this->messages->error = $this->traducao['noticias']['invalida'];
            redirect_route('noticias');
        }
    }
}