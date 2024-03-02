<?php

/**
 *
 * @name Default_Model_Emails
 * @see gazetamarista_Db_Table
 */
class Default_Model_Emails
{
    
    /**
     * Dados para impressão automática
     *
     * @var array
     */
    protected $_dados = [];

    /**
     * Olá do usuário
     *
     * @var string
     */
    protected $_olauser = null;
    
    /**
     * Título da mensagem
     *
     * @var string
     */
    protected $_titulo = null;

    /**
     * Título 2 da mensagem
     *
     * @var string
     */
    protected $_titulo2 = null;

    /**
     * Texto do botão sitename
     *
     * @var string
     */
    protected $_sitenamebtt = null;
    
    /**
     * Armazena a sessão de configuração do projeto
     *
     * @access protected
     * @name $_config
     * @var array
     */
    protected $_config = null;
    
    /**
     * Responsável por armazenar gazetamarista_Mail
     *
     * @access protected
     * @name $_mail
     * @var array
     */
    protected $_mail = null;
    
    /**
     * Armazena o nome do site
     *
     * @access protected
     * @name $_nome_site
     * @var string
     */
    protected $_nome_site = null;
    
    /**
     * Armazena o cabeçalho do e-mail
     *
     * @access protected
     * @name $_cabecalho
     * @var string
     */
    protected $_cabecalho = null;
    
    /**
     * Armazena o conteudo do e-mail
     *
     * @access protected
     * @name $_conteudo
     * @var string
     */
    protected $_conteudo = null;
    
    /**
     * Armazena todo o e-mail
     *
     * @access protected
     * @name $_contents
     * @var string
     */
    protected $_contents = null;
    
    /**
     * URL local e em produção
     *
     * @access protected
     * @name $_url
     * @var string
     */
    protected $_url = null;
    
    /**
     * Monta a URL chave
     *
     * @access protected
     * @name $_url_chave
     * @var string
     */
    protected $_url_chave = null;
    
    /**
     * Monta a URL SLUG
     *
     * @access protected
     * @name $_url_slug
     * @var string
     */
    protected $_url_slug = null;
    
    /**
     * Inicializa o model
     *
     * @name init
     */
    public function init()
    {
        // Continua o carregamento do model
    }
    
    /**
     * Captura a url local e em produção
     *
     * @name getUrl
     */
    protected function getUrl()
    {
        // Busca as configurações
        $config = Zend_Registry::get("config");
        
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $this->_url = "http://localhost" . $config->gazetamarista->config->basepath;;
        } elseif ($_SERVER['HTTP_HOST'] == "sites.gazetamarista.com.br") {
            $this->_url = "http://sites.gazetamarista.com.br" . $config->gazetamarista->config->basepath;;
        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.222") {
            $this->_url = "http://192.168.1.222" . $config->gazetamarista->config->basepath;
        } else {
            $this->_url = "http://" . $config->gazetamarista->config->domain;
        }
        
        return $this->_url;
    }
    
    /**
     * Monta a url chave
     *
     * @name getUrlChave
     */
    protected function getUrlChave($action, $chave, $email)
    {
        $this->_url_chave = $this->getUrl() . '/painel/' . $action . '/' . $chave . '/' . $email;
        
        return $this->_url_chave;
    }
    
    /**
     * Monta a url slug
     *
     * @name getUrlSlug
     */
    protected function getUrlSlug($action, $dados)
    {
        $this->_url_slug = new gazetamarista_View_Helper_CreateSlug();
        $slug_titulo = $this->_url_slug->createslug($dados['titulo']);
        $this->_url_slug = $this->getUrl() . '/' . $dados['id'] . '/' . $slug_titulo;
        
        return $this->_url_slug;
    }
    
    /**
     * Captura o conteudo do e-mail requisitado
     *
     * @name getConteudo
     */
    protected function getConteudo($tipo, $action, $dados, $admin = null)
    {
        // Pega o template por tipo
        if ($tipo === 'admin') {
            $template = APPLICATION_PATH . "/../common/email/template/admin/" . $action . ".html";
            $template_fallback = APPLICATION_PATH . "/../common/email/template/admin/_padrao.html";
        } else {
            $template = APPLICATION_PATH . "/../common/email/template/" . $action . ".html";
            $template_fallback = APPLICATION_PATH . "/../common/email/template/_padrao.html";
        }
        
        // Se não exisir o template usa o padrão
        if (!is_file($template)) {
            $template = $template_fallback;
        }
        
        $this->_conteudo = file_get_contents($template);
        
        // Dados gerais
        $this->_conteudo = str_replace("{\$datetime}", date("d/m/Y H:i:s"), $this->_conteudo);
        
        // Dados caso seja usuario
        if ($tipo === 'usuario') {
            if (isset($dados['chave'])) {
                $this->_conteudo = str_replace("{\$url_chave}", $this->getUrlChave('requerer-senha', $dados['chave'], $dados['email']), $this->_conteudo);
            }
        }
        
        if (count($this->_dados)) {
            $dados_automaticos = '';
            
            // Dados automáticos
            foreach ($this->_dados as $key => $value) {
                $dados_automaticos .= '<tr>
										<td width="115">
											<b><font face="Arial, Helvetica, sans-serif, Verdana" color="#333">' . $key . '</font></b>
										</td>
										<td>
											<font face="Arial, Helvetica, sans-serif, Verdana" color="#333">' . $value . '</font>
										</td>
									</tr>';
            }
            
            $this->_conteudo = str_replace("{\$dados}", $dados_automaticos, $this->_conteudo);
        }
        
        foreach ($dados as $key => $value) {
            // Condições especiais para tratar diferente o campo (adicionar outras especiais, caso necessário)
            if ($key == 'mensagem' or $key == 'comentario') {
                $this->_conteudo = str_replace("{\$" . $key . "}", nl2br($value), $this->_conteudo);
            } else {
                $this->_conteudo = str_replace("{\$" . $key . "}", $value, $this->_conteudo);
            }
        }
        
        return $this->_conteudo;
    }
    
    /**
     * Captura e retorna o cabeçalho do e-mail
     *
     * @name getConfig
     */
    protected function getConfig()
    {
        $this->_config = new Zend_Session_Namespace("configuracao");
        
        return $this->_config->dados;
    }
    
    /**
     * Captura e retorna o nome do site
     *
     * @name getNomeSite
     */
    protected function getNomeSite()
    {
        $this->_nome_site = $this->getConfig()->nome_site;
        
        return $this->_nome_site;
    }
    
    /**
     * Busca e retorna todos e-mails administrativos do site
     *
     * @name getEmailsAdmin
     */
    protected function getEmailsAdmin($action = null, $qtd_emails = null, $dados = null)
    {
        $config_action_email = 'email_' . $action;
        
        // Verifica se existe na configuração por campo de email pela action ex.: "email_action"
        if (isset($this->getConfig()->{$config_action_email}) and !empty($this->getConfig()->{$config_action_email})) {
            $emails = $this->getConfig()->{'email_' . $action};
        } elseif (!empty($this->getConfig()->email_contato)) {
            $emails = $this->getConfig()->email_contato;
        } else {
            $emails = $this->getConfig()->email_padrao;
        }
        
        // Quebra na virgula
        $emails = str_replace(';', ',', $emails);
        $explode_configemails = explode(',', $emails);
        
        // Remove espaços em branco
        $explode_configemails = array_map('trim', $explode_configemails);
        
        // Verifica se retorna 1 ou todos e-mails
        if ($qtd_emails == 1) {
            return $explode_configemails[0];
        } else {
            return $explode_configemails;
        }
    }
    
    /**
     * Monta o corpo da mensagem
     *
     * @name montaEmail
     */
    protected function montaEmail($tipo, $action, $subject, $dados)
    {
        // Busca o conteudo padrão (topo e footer)
        $this->_contents = file_get_contents(APPLICATION_PATH . "/../common/email/default.html");
        
        // Troca o conteudo
        $this->_contents = str_replace("{\$conteudo}", $this->getConteudo($tipo, $action, $dados), $this->_contents);
        $this->_contents = str_replace("{\$olauser}", $this->_olauser ?? 'Olá', $this->_contents);
        $this->_contents = str_replace("{\$titulo}", $this->_titulo ?? 'Obrigado por entrar em contato conosco.', $this->_contents);
        $this->_contents = str_replace("{\$titulo2}", $this->_titulo2 ?? 'Seguem as informações abaixo, entraremos em contato com você o mais breve possível.', $this->_contents);
        $this->_contents = str_replace("{\$siteurl}", $this->getUrl(), $this->_contents);
        $this->_contents = str_replace("{\$sitename}", $this->getUrl(), $this->_contents);
        $this->_contents = str_replace("{\$sitenamebtt}", $this->_sitenamebtt ?? 'ACESSAR SITE.', $this->_contents);
        $this->_contents = str_replace("{\$ip}", $_SERVER['REMOTE_ADDR'], $this->_contents);
        
        return $this->_contents;
    }
    
    /**
     * Metodo responsável por disparar os e-mails
     *
     * @name enviarEmail
     */
    public function enviarEmail($action, $subject, $dados)
    {
        $this->_mail = new gazetamarista_Mail();
        $this->_mail->setSubject($this->getNomeSite() . $subject);
        
        $this->_mail->addTo(trim($dados['email']), $dados['nome'])
            ->addEmbeddedImage(APPLICATION_PATH . "/../common/email/images/logo-cliente.jpg", "logo", "common/email/images/logo-cliente.jpg")
            ->setReplyTo($this->getEmailsAdmin($action, 1, $dados), $this->getNomeSite())
            ->setBodyHtml($this->montaEmail('usuario', $action, $subject, $dados))
            ->send();
    }
    
    /**
     * Envia e-mail para os administradores
     *
     * @name enviarEmailAdmin
     */
    public function enviarEmailAdmin($action, $subject, $dados, $emailsdestino = null)
    {
        $this->_mail = new gazetamarista_Mail();
        $this->_mail->setSubject($this->getNomeSite() . $subject);
        
        if (count($emailsdestino) > 0) {
            // E-mail para destinatário específico
            foreach ($emailsdestino as $email) {
                $email = trim($email);
                if (!empty($email)) {
                    $this->_mail->addTo($email, $this->getNomeSite());
                }
            }
        } else {
            // E-mail para o administrador
            foreach ($this->getEmailsAdmin($action, null, $dados) as $email) {
                $email = trim($email);
                if (!empty($email)) {
                    $this->_mail->addTo($email, $this->getNomeSite());
                }
            }
        }
        
        $this->_mail->addEmbeddedImage(APPLICATION_PATH . "/../common/email/images/logo-cliente.jpg", "logo", "common/email/images/logo-cliente.jpg")
            ->setReplyTo($dados['email'], $dados['nome'])
            ->setBodyHtml($this->montaEmail('admin', $action, $subject, $dados))
            ->send();
    }

    /**
     * Define o olá user
     *
     * @param $olauser
     *
     * @return $this
     */
    public function olauser($olauser)
    {
        $this->_olauser = $olauser;

        return $this;
    }
    
    /**
     * Define o titulo
     *
     * @param $titulo
     *
     * @return $this
     */
    public function titulo($titulo)
    {
        $this->_titulo = $titulo;
        
        return $this;
    }

    /**
     * Define o titulo 2
     *
     * @param $titulo2
     *
     * @return $this
     */
    public function titulo2($titulo2)
    {
        $this->_titulo2 = $titulo2;

        return $this;
    }

    /**
     * Define o texto do botão sitename
     *
     * @param $sitenamebtt
     *
     * @return $this
     */
    public function sitenamebtt($sitenamebtt)
    {
        $this->_sitenamebtt = $sitenamebtt;

        return $this;
    }
    
    /**
     * Define os dados
     *
     * @param array $dados
     *
     * @return $this
     */
    public function dados(array $dados)
    {
        $this->_dados = $dados;
        
        return $this;
    }
}