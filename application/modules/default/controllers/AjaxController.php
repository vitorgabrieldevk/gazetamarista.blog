<?php

/**
 * Controlador AJAX
 *
 * @name AjaxController
 */
class AjaxController extends Zend_Controller_Action
{
    /**
     *
     */
    public function init()
    {
        // Passa para 800 segundos o max_execution_time
        set_time_limit(800);

        // Desabilita os layouts
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        // Setlocale
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');

        // Controle de origem
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET');
        header("Access-Control-Allow-Headers: 'content-type'");

        // Função de bloquear injection
        $this->sanitize = new gazetamarista_Sanitize();

        // Seta a sessão das mensagens e configuração
        $this->messages = new Zend_Session_Namespace("messages");
        $this->session_config = new Zend_Session_Namespace("configuracao");

        // Busca as configurações
        $config = Zend_Registry::get("config");

        // Domínio
        if ($_SERVER['HTTP_HOST'] == "localhost") {
            $this->dominio = "http://localhost" . $config->gazetamarista->config->basepath;
        } elseif ($_SERVER['HTTP_HOST'] == "sites.gazetamarista.com.br") {
            $this->dominio = "http://sites.gazetamarista.com.br" . $config->gazetamarista->config->basepath;
        } elseif ($_SERVER['HTTP_HOST'] == "192.168.1.222") {
            $this->dominio = "http://192.168.1.222" . $config->gazetamarista->config->basepath;
        } else {
            $this->dominio = "https://" . $config->gazetamarista->config->domain;
        }

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
    }

    /**
     * Ação de aceitar cookies
     */
    public function ajaxCookiesAceitarAction()
    {
        // Desabilita o layout
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        // Salva no banco
        (new Admin_Model_Cookies())->insert([
            'data' => new Zend_Db_Expr('NOW()'),
            'ip' => $this->getRequest()->getClientIp(true),
        ]);

        // Salva o cookie
        setcookie('aceitou_cookies', 1, strtotime("+60 days"), '/', $_SERVER['HTTP_HOST'], false);

        $this->getResponse()->setHttpResponseCode(204)->sendResponse();
    }

    /**
     * Ajax Newsletter
     */
    public function ajaxNewsletterAction()
    {
        // Array resposta
        $resposta = array();

        // Somente ajax e post
        if( !$this->getRequest()->isXmlHttpRequest() or !$this->getRequest()->isPost() )
        {
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']   = 'Invalid request';
                $resposta['mensagem'] = 'Please try again.';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']   = 'Solicitud no válida';
                $resposta['mensagem'] = 'Por favor, vuelva a intentarlo.';
            }else{
                $resposta['titulo']   = 'Seu e-mail já está cadastrado.';
                $resposta['mensagem'] = 'Por favor, tente novamente com outro e-mail.';
            }

            $this->_helper->json($resposta);
        }

        // Params
        $email = $this->sanitize->sanitizestring($this->_request->getParam("email", ""), "search");
        $clean_email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($clean_email, FILTER_VALIDATE_EMAIL)) {
            // Procura um registro no banco com o e-mail informado
            $rowemail = (new Admin_Model_Emails())->select()->where('email = ?', $email)->fetchOne();

            if ($rowemail) {
                // ERRO
                $resposta['status'] = 'erro';
                if($this->cod_lingua == '_en') {
                    $resposta['titulo']   = 'Registration not done!';
                    $resposta['mensagem'] = 'The informed e-mail is already registered.';
                }elseif($this->cod_lingua == '_es') {
                    $resposta['titulo']   = '¡Registro no realizado!';
                    $resposta['mensagem'] = 'El e-mail informado ya está registrado.';
                }else{
                    $resposta['titulo']   = 'Cadastro não realizado!';
                    $resposta['mensagem'] = 'O e-mail informado já está cadastrado.';
                }
            } else {
                // Data
                $data           = array();
                $data['email']  = $email;
                $data['data']   = date("Y-m-d H:i:s");
                $data['ip']     = $this->getRequest()->getClientIp(true);

                // Insert
                (new Admin_Model_Emails())->insert($data);

                // SUCESSO
                $resposta['status'] = 'sucesso';
                if($this->cod_lingua == '_en') {
                    $resposta['titulo']   = 'Thank you for signing up for our newsletter!';
                    $resposta['mensagem'] = 'You will soon receive our emails.';
                }elseif($this->cod_lingua == '_es') {
                    $resposta['titulo']   = '¡Gracias por suscribirte a nuestro boletín!';
                    $resposta['mensagem'] = 'Pronto recibirás nuestros correos electrónicos.';
                }else{
                    $resposta['titulo']   = 'Obrigado por se cadastrar em nossa newsletter!';
                    $resposta['mensagem'] = 'Em breve você receberá nossos e-mails.';
                }
            }
        } else {
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']   = 'Registration not done!';
                $resposta['mensagem'] = 'The email you typed is invalid, please try again.';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']   = '¡Registro no realizado!';
                $resposta['mensagem'] = 'El correo electrónico introducido no es válido, vuelva a intentarlo.';
            }else{
                $resposta['titulo']   = 'Cadastro não realizado!';
                $resposta['mensagem'] = 'O e-mail digitado é inválido, tente novamente.';
            }
        }

        // Retorno resposta
        $this->_helper->json($resposta);
    }

    /**
     * Ajax Like e deslike notícias
     */
    public function ajaxLikeDeslikeAction() {
        // Array resposta
        $resposta = array();

        // Somente ajax e post
        if( !$this->getRequest()->isXmlHttpRequest() or !$this->getRequest()->isPost() )
        {
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']   = 'Invalid request!';
                $resposta['mensagem'] = 'Please try again.';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']   = '¡Solicitud no válida!';
                $resposta['mensagem'] = 'Por favor, vuelva a intentarlo.';
            }else{
                $resposta['titulo']   = 'Seu e-mail já está cadastrado.';
                $resposta['mensagem'] = 'Por favor, tente novamente com outro e-mail.';
            }

            $this->_helper->json($resposta);
        }

        // Params
        $idblog  = $this->sanitize->sanitizestring($this->_request->getParam("id", ""), "search");
        $like    = $this->sanitize->sanitizestring($this->_request->getParam("like", ""), "search");
        $deslike = $this->sanitize->sanitizestring($this->_request->getParam("unlike", ""), "search");

        if($idblog > 0) {
            // Model
            $model_blogs = new Admin_Model_Blogs();

            // Fetch
            $row = $model_blogs->fetchRow(array('idblog = ?' => $idblog));

            if($row) {
                if($deslike) {
                    $up_array = array("qtd_naocurtidas" => $row->qtd_naocurtidas + 1);
                }else{
                    $up_array = array("qtd_curtidas" => $row->qtd_curtidas + 1);
                }

                // Update
                $model_blogs->update($up_array, array("idblog = ?" => $idblog));

                // Sucesso
                $resposta = array(
                    'sucesso' => 'true'
                );
            }else{
                // ERRO
                $resposta['status'] = 'erro';
                if($this->cod_lingua == '_en') {
                    $resposta['titulo']   = 'News not found!';
                    $resposta['mensagem'] = 'Please try again.';
                }elseif($this->cod_lingua == '_es') {
                    $resposta['titulo']   = '¡Noticia no encontrada!';
                    $resposta['mensagem'] = 'Por favor inténtalo de nuevo.';
                }else{
                    $resposta['titulo']   = 'Notícia não encontrada!';
                    $resposta['mensagem'] = 'Por favor, tente novamente.';
                }
            }
        }else{
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']    = 'Invalid news!';
                $resposta['mensagem']  = 'Please try again.';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']    = '¡Noticia inválida!';
                $resposta['mensagem']  = 'Por favor inténtalo de nuevo.';
            }else{
                $resposta['titulo']    = 'Notícia inválida!';
                $resposta['mensagem']  = 'Por favor, tente novamente.';
            }
        }

        // Retorna a resposta
        $this->_helper->json($resposta);
    }

    /**
     * Ajax Fale Conosco
     */
    public function ajaxFaleConoscoAction()
    {
        // Array resposta
        $resposta = array();

        // Somente ajax e post
        if( !$this->getRequest()->isXmlHttpRequest() or !$this->getRequest()->isPost() )
        {
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']   = 'Invalid request!';
                $resposta['mensagem'] = 'Please try again.';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']   = '¡Solicitud no válida!';
                $resposta['mensagem'] = 'Por favor, vuelva a intentarlo.';
            }else{
                $resposta['titulo']   = 'Seu e-mail já está cadastrado.';
                $resposta['mensagem'] = 'Por favor, tente novamente com outro e-mail.';
            }

            $this->_helper->json($resposta);
        }

        // Sessão de retorno
        $retorno = new Zend_Session_Namespace("telaretorno");

        $form = valida_form([
            [
                'campo' => 'assunto',
                'label' => 'Assunto',
                'regras' => [
                    'required',
                    'in_list' => [
						'agendar_atendimento',
						'taxi_aereo',
						'gestao_aeronaves',
						'propriedade_compartilhada',
						'trabalhe_conosco',
						'parcerias',
						'duvidas',
						'outro_assunto',
					],
 				],
            ],
            [
                'campo' => 'nome',
                'label' => 'Nome',
                'regras' => [
                    'required',
                    'min_words:2',
                ],
            ],
            [
                'campo' => 'telefone',
                'label' => 'Telefone',
                'regras' => [
                    'required',
                    'phone',
                ],
            ],
            [
                'campo' => 'email',
                'label' => 'E-mail',
                'regras' => [
                    'required',
                    'email',
                ],
            ],
            [
                'campo' => 'mensagem',
                'label' => 'Mensagem',
                'regras' => [
                    'required',
                ],
            ]
        ]);

        if( !$form['valido'] ) {
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']   = 'An error has occurred!';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']   = '¡Ocurrio un error!';
            }else{
                $resposta['titulo']   = 'Ocorreu um erro!';
            }
            $resposta['mensagem'] = $form['erro'];

            $this->_helper->json($resposta);
        }

        // Valida o captcha
        if( !valida_recaptcha()['valido'] ) {
            // ERRO
            $resposta['status'] = 'erro';
            if($this->cod_lingua == '_en') {
                $resposta['titulo']   = 'An error has occurred!';
                $resposta['mensagem'] = '"I am not a robot" is no longer valid, please redo it.';
            }elseif($this->cod_lingua == '_es') {
                $resposta['titulo']   = '¡Ocurrio un error!';
                $resposta['mensagem'] = '"No soy un robot" ya no es válido, vuelve a hacerlo.';
            }else{
                $resposta['titulo']   = 'Ocorreu um erro!';
                $resposta['mensagem'] = '"Eu não sou um robô" não é mais válido, por favor refaça-o.';
            }

            $this->_helper->json($resposta);
        }

        // Complemento dos dados
        $form['dados']['data'] = new Zend_Db_Expr('NOW()');
        $form['dados']['ip']   = $this->getRequest()->getClientIp(true);

        // Anexo de documento
        $form['dados']['anexo'] = null;

        if(!empty($_FILES['arquivo']['tmp_name'])) {
            // Chama a função para validar o upload
            $resposta_block = (new gazetamarista_Tipoupload())->bloqueio($_FILES['arquivo']);
            if($resposta_block['status'] != 'sucesso') {
                // ERRO
                $resposta['status'] = 'erro';
                if($this->cod_lingua == '_en') {
                    $resposta['titulo']   = 'An error has occurred!';
                    $resposta['mensagem'] = 'File type not allowed.';
                }elseif($this->cod_lingua == '_es') {
                    $resposta['titulo']   = '¡Ocurrio un error!';
                    $resposta['mensagem'] = 'Tipo de archivo no permitido.';
                }else{
                    $resposta['titulo']   = 'Ocorreu um erro!';
                    $resposta['mensagem'] = 'Tipo de arquivo não permitido.';
                }

                $this->_helper->json($resposta);
            }

            // Armazena dados do arquivo
            $arquivo_nome 		= $_FILES['arquivo']['name'];
            $arquivo_tipo		= $_FILES['arquivo']['type'];
            $arquivo_size		= $_FILES['arquivo']['size'];
            $arquivo_extensao	= end(explode(".", $arquivo_nome));

            // Cria nome slug do arquivo
            $nome_slug = (new gazetamarista_View_Helper_CreateSlug())->createslug(str_replace(".".$arquivo_extensao, "", $arquivo_nome));
            $filename  = substr($nome_slug,0,45) . "-" . substr(time(),-5) . "." . $arquivo_extensao;

            // Armazena no array o arquivo
            $form['dados']['anexo'] = $filename;

            // Move o arquivo para o diretório
            move_uploaded_file($_FILES['arquivo']['tmp_name'], APPLICATION_PATH . "/../common/uploads/contato/" . $filename);
        }

        // Salva no banco
        (new Admin_Model_Contatos())->insert($form['dados']);

		// Captura a tradução en ingLês
		$traducao_en = Zend_Registry::get("translate")->getAdapter()->getMessages('en');

		// Envia pro salesforce
		$client = new Zend_Http_Client();
		$client->setUri('https://webto.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8');
		$client->setParameterPost([
			'oid'             => '00D8Y000000g8lY',
			'retURL'          => 'https://sync.aero/',
			'lead_source'     => 'Website',
			'first_name'      => explode(' ', $form['dados']['nome'])[0] ?? $form['dados']['nome'],
			'last_name'       => explode(' ', $form['dados']['nome'])[1] ?? '',
			'company'         => '',
			'email'           => $form['dados']['email'],
			'00N8Y00000MDaIc' => $traducao_en['assuntos'][$form['dados']['assunto']],
			'00N8Y00000MDaIh' => $form['dados']['mensagem'],
			// Debug
			//'debug'           => 1,
			//'debugEmail'      => 'projetos@gazetamarista.com.br',
		]);

		try {
			$respostaSalesForce = $client->request('POST')->getBody();
			//dd($respostaSalesForce);
		} catch (Exception $e) {
			//dd($e->getMessage());
		}

		try {
            // ERRO
            if($this->cod_lingua == '_en') {
                $email_visualizar   = "Preview file";
                $email_ola_user     = "Hello";
                $email_titulo_user  = "Thank you for contacting us.";
                $email_titulo2_user = "Follow the information below, we will contact you as soon as possible.";
                $email_titulo_admin = "Contact sent by";
                $email_titulo2_admin= "Below is contact information.";
                $email_assunto      = "Contact sent by the site";
                $email_txt_btt      = "ACCESS WEBSITE";
                $msg_retorno_title  = "Contact sent successfully!";
                $msg_retorno_message = "Please wait, a member of our team will contact you soon.";
            }elseif($this->cod_lingua == '_es') {
                $email_visualizar   = "Archivo de vista previa";
                $email_ola_user     = "Hola";
                $email_titulo_user  = "Gracias por contactarnos.";
                $email_titulo2_user = "Siga la información a continuación, nos pondremos en contacto con usted lo antes posible.";
                $email_titulo_admin = "Contacto enviado por";
                $email_titulo2_admin= "A continuación se muestra la información de contacto.";
                $email_assunto      = "Contacto enviado por el sitio";
                $email_txt_btt      = "ACCEDER A LA WEB";
                $msg_retorno_title  = "¡Contacto enviado con éxito!";
                $msg_retorno_message = "Por favor espere, un miembro de nuestro equipo lo contactará pronto.";
            }else{
                $email_visualizar   = "Visualizar arquivo";
                $email_ola_user     = "Olá";
                $email_titulo_user  = "Obrigado por entrar em contato conosco.";
                $email_titulo2_user = "Seguem as informações abaixo, entraremos em contato com você o mais breve possível.";
                $email_titulo_admin = "Contato enviado por";
                $email_titulo2_admin= "Abaixo, as informações do contato.";
                $email_assunto      = "Contato enviado pelo site";
                $email_txt_btt      = "ACESSAR SITE";
                $msg_retorno_title  = "Contato enviado com sucesso!";
                $msg_retorno_message = "Aguarde, logo um membro da nossa equipe entrará em contato com você.";
            }

            $dados_email                                         = array();
            $dados_email[$this->traducao['contato']['assunto']]  = $this->traducao['assuntos'][$form['dados']['assunto']];
            $dados_email[$this->traducao['contato']['nome']]     = $form['dados']['nome'];
            $dados_email[$this->traducao['contato']['telefone']] = $form['dados']['telefone'];
            $dados_email[$this->traducao['contato']['email']]    = $form['dados']['email'];
            if(!empty($form['dados']['anexo'])) {
                $class_btt = "color:#333;text-decoration:none;background-color:#ccc;display:inline-block;border:solid 1px #333;border-radius:3px;padding:0.35em 0.75em;font-size:13px;";
                $dados_email[$this->traducao['contato']['anexo']] = "<a href='" . $this->dominio . '/common/uploads/contato/' . $form['dados']['anexo'] . "' title='".$email_visualizar."' target='_blank' style='".$class_btt."'>".$email_visualizar."</a>";
            }
            $dados_email[$this->traducao['contato']['mensagem']] = $form['dados']['mensagem'];
            $dados_email[$this->traducao['contato']['data']]     = date('d/m/Y H:i:s');

            // Envia email para cliente
            (new Default_Model_Emails())->titulo($email_titulo_user)
                ->olauser($email_ola_user)
                ->titulo2($email_titulo2_user)
                ->dados($dados_email)
                ->sitenamebtt($email_txt_btt)
                ->enviarEmail('contato', ' - ' . $email_assunto, $form['dados']);

            // Envia email para admin
            (new Default_Model_Emails())->titulo($email_titulo_admin . ' ' . $form['dados']['nome'])
                ->titulo2($email_titulo2_admin)
                ->dados($dados_email)
                ->enviarEmailAdmin('contato', ' - ' . $email_assunto, $form['dados']);
        }catch( Exception $e ) {
            // Erro no e-mail
            // Armazenar erro ($mensagem, $parametros, $erro)
            gazetamarista_Logatualizacoes::salvaErro($e->getMessage(), json_encode($dados_email), $e);
        }

        // Adiciona retorno na sessão
        $retorno->title     = $msg_retorno_title;
        $retorno->mensagem  = $msg_retorno_message;

        // Sucesso
        $resposta = array(
            'status'            => 'sucesso',
            'titulo'            => '',
            'mensagem'          => '',
            'redirecionar_para' => url('telaretorno', ['pagina'=>'contato', 'status'=>'sucesso'])
        );

        // Retorno resposta
        $this->_helper->json($resposta);
    }
}