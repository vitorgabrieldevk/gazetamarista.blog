<?php

/**
 * Classe de pagamentos pela cielo
 *
 * @name gazetamarista_Pagamentos_Cielo
 */
class gazetamarista_Pagamentos_Cielo {

    private $logger;
    public $dadosEcNumero;
    public $dadosEcChave;
    public $dadosPortadorNumero;
    public $dadosPortadorVal;
    public $dadosPortadorInd;
    public $dadosPortadorCodSeg;
    public $dadosPortadorNome;
    public $dadosPedidoNumero;
    public $dadosPedidoValor;
    public $dadosPedidoMoeda = "986";
    public $dadosPedidoData;
    public $dadosPedidoDescricao;
    public $dadosPedidoIdioma = "PT";
    public $formaPagamentoBandeira;
    public $formaPagamentoProduto;
    public $formaPagamentoParcelas;
    public $urlRetorno;
    public $autorizar;
    public $capturar;
    public $tid;
    public $status;
    public $urlAutenticacao;
    public $_ENDERECO_BASE = "https://qasecommerce.cielo.com.br";
    
    public $_ENDERECO 	= "";
    public $_LOJA 		= "";
    public $_LOJA_CHAVE = "";

    public $_VERSAO = "1.1.0";
    public $_ENCODING = "ISO-8859-1";
    
    public function __construct() {
    	// Verifica configuração cielo
    	$model_configuracao = new Admin_Model_Configuracoes();
    	$config_geral = $model_configuracao->fetchRow(array('idconfiguracao = 1'));
    	if($config_geral) {
    		if($config_geral->cielo_ativo == 1) {
    			if($config_geral->cielo_ambiente == "producao") {
    				if(!empty($config_geral->cielo_loja_producao) && !empty($config_geral->cielo_chave_producao)) {
    					$this->_ENDERECO 	= "https://ecommerce.cielo.com.br/servicos/ecommwsec.do";
    					$this->_LOJA 		= trim($config_geral->cielo_loja_producao);
    					$this->_LOJA_CHAVE 	= trim($config_geral->cielo_chave_producao);
    				}else{
    					die("Parâmetros incorretos, verifique configuração da Cielo em produção");
    				}
    			}else{
    				if(!empty($config_geral->cielo_loja_teste) && !empty($config_geral->cielo_chave_teste)) {
    					$this->_ENDERECO 	= "https://qasecommerce.cielo.com.br/servicos/ecommwsec.do";
    					$this->_LOJA 		= trim($config_geral->cielo_loja_teste);
    					$this->_LOJA_CHAVE 	= trim($config_geral->cielo_chave_teste);
    				}else{
    					die("Parâmetros incorretos, verifique configuração da Cielo em teste");
    				}
    			}
    		}else{
    			die("Sistema inativo, verifique configuração da Cielo");
    		}
    	}else{
    		die("Ocorreu um erro, verifique configuração da Cielo");
    	}
    }

    public function init() {
        session_start();
    }

    // Envia requisição
    public function httprequest($paEndereco, $paPost) {
        $sessao_curl = curl_init();
        curl_setopt($sessao_curl, CURLOPT_URL, $paEndereco);

        curl_setopt($sessao_curl, CURLOPT_FAILONERROR, true);

        //  CURLOPT_SSL_VERIFYPEER
        //  verifica a validade do certificado
        // mudar para true depois
        curl_setopt($sessao_curl, CURLOPT_SSL_VERIFYPEER, false);
        //  CURLOPPT_SSL_VERIFYHOST
        //  verifica se a identidade do servidor bate com aquela informada no certificado
        curl_setopt($sessao_curl, CURLOPT_SSL_VERIFYHOST, 2);

        //  CURLOPT_SSL_CAINFO
        //  informa a localização do certificado para verificação com o peer
        curl_setopt($sessao_curl, CURLOPT_CAINFO, getcwd() .
                "/ssl/VeriSignClass3PublicPrimaryCertificationAuthority-G5.crt");
        curl_setopt($sessao_curl, CURLOPT_SSLVERSION, 4);

        //  CURLOPT_CONNECTTIMEOUT
        //  o tempo em segundos de espera para obter uma conexão
        curl_setopt($sessao_curl, CURLOPT_CONNECTTIMEOUT, 10);

        //  CURLOPT_TIMEOUT
        //  o tempo máximo em segundos de espera para a execução da requisição (curl_exec)
        curl_setopt($sessao_curl, CURLOPT_TIMEOUT, 40);

        //  CURLOPT_RETURNTRANSFER
        //  TRUE para curl_exec retornar uma string de resultado em caso de sucesso, ao
        //  invés de imprimir o resultado na tela. Retorna FALSE se há problemas na requisição
        curl_setopt($sessao_curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($sessao_curl, CURLOPT_POST, true);
        curl_setopt($sessao_curl, CURLOPT_POSTFIELDS, $paPost);

        $resultado = curl_exec($sessao_curl);

        curl_close($sessao_curl);

        if ($resultado) {
            return $resultado;
        } else {
            return curl_error($sessao_curl);
        }
    }

    // Monta URL de retorno
    public function ReturnURL() {
        $pageURL = 'http';

        // protocolo https
        if ($_SERVER["SERVER_PORT"] == 443) {
            $pageURL .= 's';
        }

        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"], 0);
        }
        // ALTERNATIVA PARA SERVER_NAME -> HOST_HTTP

        $file = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);

        $ReturnURL = str_replace($file, "retorno.php", $pageURL);

        return $ReturnURL;
    }

    // Geradores de XML
    private function XMLHeader() {
        return '<?xml version="1.0" encoding="' . $this->_ENCODING . '" ?>';
    }

    private function XMLDadosEc() {
        $msg = '<dados-ec>' . "\n      " .
	                '<numero>'
	                	. $this->dadosEcNumero .
	                '</numero>' . "\n      " .
	                '<chave>'
	                	. $this->dadosEcChave .
	                '</chave>' . "\n   " .
                '</dados-ec>';

        return $msg;
    }

    private function XMLDadosPortador() {
        $msg = '<dados-portador>' . "\n      " .
                '<numero>'
                	. $this->dadosPortadorNumero .
                '</numero>' . "\n      " .
                '<validade>'
                	. $this->dadosPortadorVal .
                '</validade>' . "\n      " .
                '<indicador>'
                	. $this->dadosPortadorInd .
                '</indicador>' . "\n      " .
                '<codigo-seguranca>'
                	. $this->dadosPortadorCodSeg .
                '</codigo-seguranca>' . "\n   ";

        // Verifica se Nome do Portador foi informado
        if ($this->dadosPortadorNome != null && $this->dadosPortadorNome != "") {
            $msg .= '<nome-portador>'
                    	. $this->dadosPortadorNome .
                    '</nome-portador>' . "\n   ";
        }

        $msg .= '</dados-portador>';

        return $msg;
    }

    private function XMLDadosCartao() {
        $msg = '<dados-cartao>' . "\n      " .
                '<numero>'
                	. $this->dadosPortadorNumero .
                '</numero>' . "\n      " .
                '<validade>'
                	. $this->dadosPortadorVal .
                '</validade>' . "\n      " .
                '<indicador>'
                	. $this->dadosPortadorInd .
                '</indicador>' . "\n      " .
                '<codigo-seguranca>'
                	. $this->dadosPortadorCodSeg .
                '</codigo-seguranca>' . "\n   ";

        // Verifica se Nome do Portador foi informado               
        if ($this->dadosPortadorNome != null && $this->dadosPortadorNome != "") {
            $msg .= '<nome-portador>'
                    	. $this->dadosPortadorNome .
                    '</nome-portador>' . "\n   ";
        }

        $msg .= '</dados-cartao>';

        return $msg;
    }

    private function XMLDadosPedido() {
        $this->dadosPedidoData = date("Y-m-d") . "T" . date("H:i:s");
        $msg = '<dados-pedido>' . "\n      " .
                '<numero>'
                	. $this->dadosPedidoNumero .
                '</numero>' . "\n      " .
                '<valor>'
                	. $this->dadosPedidoValor .
                '</valor>' . "\n      " .
                '<moeda>'
                	. $this->dadosPedidoMoeda .
                '</moeda>' . "\n      " .
                '<data-hora>'
                	. $this->dadosPedidoData .
                '</data-hora>' . "\n      ";
        if ($this->dadosPedidoDescricao != null && $this->dadosPedidoDescricao != "") {
            $msg .= '<descricao>'
                    	. $this->dadosPedidoDescricao .
                    '</descricao>' . "\n      ";
        }
        $msg .= '<idioma>'
                	. $this->dadosPedidoIdioma .
                '</idioma>' . "\n   " .
                '</dados-pedido>';

        return $msg;
    }

    private function XMLFormaPagamento() {
        $msg = '<forma-pagamento>' . "\n      " .
	                '<bandeira>'
	                	. $this->formaPagamentoBandeira .
	                '</bandeira>' . "\n      " .
	                '<produto>'
	                	. $this->formaPagamentoProduto .
	                '</produto>' . "\n      " .
	                '<parcelas>'
	                	. $this->formaPagamentoParcelas .
	                '</parcelas>' . "\n   " .
               '</forma-pagamento>';

        return $msg;
    }

    private function XMLUrlRetorno() {
        $msg = '<url-retorno>' . $this->urlRetorno . '</url-retorno>';

        return $msg;
    }

    private function XMLAutorizar() {
        $msg = '<autorizar>' . $this->autorizar . '</autorizar>';

        return $msg;
    }

    private function XMLCapturar() {
        $msg = '<capturar>' . $this->capturar . '</capturar>';

        return $msg;
    }

    // Envia Requisição
    public function Enviar($vmPost, $transacao) {
        //$this->logger->logWrite("ENVIO: " . $vmPost, $transacao);
        // ENVIA REQUISIÇÃO SITE CIELO
        $vmResposta = $this->httprequest($this->_ENDERECO, "mensagem=" . $vmPost);
        //$this->logger->logWrite("RESPOSTA: " . $vmResposta, $transacao);

        $this->VerificaErro($vmPost, $vmResposta);

        return simplexml_load_string($vmResposta);
    }

    // Requisições
    public function RequisicaoTransacao($incluirPortador) {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-transacao id="' . md5(date("YmdHisu")) . '" versao="' . $this->_VERSAO . '">' . "\n   "
                . $this->XMLDadosEc() . "\n   ";
        if ($incluirPortador == true) {
            $msg .= $this->XMLDadosPortador() . "\n   ";
        }
        $msg .= $this->XMLDadosPedido() . "\n   "
                . $this->XMLFormaPagamento() . "\n   "
                . $this->XMLUrlRetorno() . "\n   "
                . $this->XMLAutorizar() . "\n   "
                . $this->XMLCapturar() . "\n";

        $msg .= '</requisicao-transacao>';

        $objResposta = $this->Enviar($msg, "Transacao");

        return $objResposta;
    }

    public function RequisicaoTid() {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-tid id="' . md5(date("YmdHisu")) . '" versao ="' . $this->_VERSAO . '">' . "\n   "
                	. $this->XMLDadosEc() . "\n   "
                	. $this->XMLFormaPagamento() . "\n" .
                '</requisicao-tid>';

        $objResposta = $this->Enviar($msg, "Requisicao Tid");

        return $objResposta;
    }

    public function RequisicaoAutorizacaoPortador() {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-autorizacao-portador id="' . md5(date("YmdHisu")) . '" versao ="' . $this->_VERSAO . '">' . "\n"
	                . '<tid>' . $this->tid . '</tid>' . "\n   "
	                . $this->XMLDadosEc() . "\n   "
	                . $this->XMLDadosCartao() . "\n   "
	                . $this->XMLDadosPedido() . "\n   "
	                . $this->XMLFormaPagamento() . "\n   "
	                . '<capturar-automaticamente>false</capturar-automaticamente>' . "\n" .
	                //. '<capturar-automaticamente>' . $this->capturar . '</capturar-automaticamente>' . "\n" .
                '</requisicao-autorizacao-portador>';

        $objResposta = $this->Enviar($msg, "Autorizacao Portador");
        return $objResposta;
    }

    public function RequisicaoAutorizacaoTid() {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-autorizacao-tid id="' . md5(date("YmdHisu")) . '" versao="' . $this->_VERSAO . '">' . "\n  "
                	. '<tid>' . $this->tid . '</tid>' . "\n  "
                	. $this->XMLDadosEc() . "\n" .
                '</requisicao-autorizacao-tid>';

        $objResposta = $this->Enviar($msg, "Autorizacao Tid");
        return $objResposta;
    }

    public function RequisicaoCaptura($PercentualCaptura, $anexo) {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-captura id="' . md5(date("YmdHisu")) . '" versao="' . $this->_VERSAO . '">' . "\n   "
                	. '<tid>' . $this->tid . '</tid>' . "\n   "
                	. $this->XMLDadosEc() . "\n   "
                . '<valor>' . $PercentualCaptura . '</valor>' . "\n";
        if ($anexo != null && $anexo != "") {
            $msg .= '   <anexo>' . $anexo . '</anexo>' . "\n";
        }
        $msg .= '</requisicao-captura>';

        $objResposta = $this->Enviar($msg, "Captura");

        return $objResposta;
    }

    public function RequisicaoCancelamento() {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-cancelamento id="' . md5(date("YmdHisu")) . '" versao="' . $this->_VERSAO . '">' . "\n   "
                	. '<tid>' . $this->tid . '</tid>' . "\n   "
                	. $this->XMLDadosEc() . "\n" .
                '</requisicao-cancelamento>';

        $objResposta = $this->Enviar($msg, "Cancelamento");
        return $objResposta;
    }

    public function RequisicaoConsulta() {
        $msg = $this->XMLHeader() . "\n" .
                '<requisicao-consulta id="' . md5(date("YmdHisu")) . '" versao="' . $this->_VERSAO . '">' . "\n   "
                	. '<tid>' . $this->tid . '</tid>' . "\n   "
                	. $this->XMLDadosEc() . "\n" .
                '</requisicao-consulta>';

        $objResposta = $this->Enviar($msg, "Consulta");
        return $objResposta;
    }

    // Transforma em/lê string
    public function ToString() {
        $msg = $this->XMLHeader() .
                '<objeto-pedido>'
                . '<tid>' . $this->tid . '</tid>'
                . '<status>' . $this->status . '</status>'
                . $this->XMLDadosEc()
                . $this->XMLDadosPedido()
                . $this->XMLFormaPagamento() .
                '</objeto-pedido>';

        return $msg;
    }

    public function FromString($Str) {
        $DadosEc = "dados-ec";
        $DadosPedido = "dados-pedido";
        $DataHora = "data-hora";
        $FormaPagamento = "forma-pagamento";

        $XML = simplexml_load_string($Str);

        $this->tid = $XML->tid;
        $this->status = $XML->status;
        $this->dadosEcChave = $XML->$DadosEc->chave;
        $this->dadosEcNumero = $XML->$DadosEc->numero;
        $this->dadosPedidoNumero = $XML->$DadosPedido->numero;
        $this->dadosPedidoData = $XML->$DadosPedido->$DataHora;
        $this->dadosPedidoValor = $XML->$DadosPedido->valor;
        $this->formaPagamentoProduto = $XML->$FormaPagamento->produto;
        $this->formaPagamentoParcelas = $XML->$FormaPagamento->parcelas;
    }

    // Traduz cógigo do Status
    public function getStatus() {
        $status;

        switch ($this->status) {
            case "0": $status = "Criada";
                break;
            case "1": $status = "Em andamento";
                break;
            case "2": $status = "Autenticada";
                break;
            case "3": $status = "Não autenticada";
                break;
            case "4": $status = "Autorizada";
                break;
            case "5": $status = "Não autorizada";
                break;
            case "6": $status = "Capturada";
                break;
            case "8": $status = "Não capturada";
                break;
            case "9": $status = "Cancelada";
                break;
            case "10": $status = "Em autenticação";
                break;
            default: $status = "n/a";
                break;
        }

        return $status;
    }

    function VerificaErro($vmPost, $vmResposta) {
        $error_msg = null;

        try {
            if (stripos($vmResposta, "SSL certificate problem") !== false) {
                throw new Exception("CERTIFICADO INVÁLIDO - O certificado da transação não foi aprovado", "099");
            }

            $objResposta = simplexml_load_string($vmResposta, null, LIBXML_NOERROR);
            if ($objResposta == null) {
                throw new Exception("HTTP READ TIMEOUT - o Limite de Tempo da transação foi estourado", "099");
            }
        } catch (Exception $ex) {
            $error_msg = "     Código do erro: " . $ex->getCode() . "\n";
            $error_msg .= "     Mensagem: " . $ex->getMessage() . "\n";

            // Gera página HTML
            echo '<html><head><title>Erro na transação</title></head><body>';
            echo '<span style="color:red;, font-weight:bold;">Ocorreu um erro em sua transação!</span>' . '<br />';
            echo '<span style="font-weight:bold;">Detalhes do erro:</span>' . '<br />';
            echo '<pre>' . $error_msg . '<br /><br />';
            //echo "     XML de envio: " . "<br />" . htmlentities($vmPost);
            echo '</pre><p><center>';
            echo '<input type="button" value="Retornar" onclick="javascript:if(window.opener!=null){window.opener.location.reload();' .
            'window.close();}else{window.location.href=' . "'pedido/';" . '}" />';
            echo '</center></p></body></html>';
            $error_msg .= "     XML de envio: " . "\n" . $vmPost;

            // Dispara o erro
            die($error_msg);

            return true;
        }

        if ($objResposta->getName() == "erro") {
            $error_msg = "     Código do erro: " . $objResposta->codigo . "\n";
            $error_msg .= "     Mensagem: " . utf8_decode($objResposta->mensagem) . "\n";
            // Gera página HTML
            echo '<html><head><title>Erro na transação</title></head><body>';
            echo '<span style="color:red;, font-weight:bold;">Ocorreu um erro em sua transação!</span>' . '<br />';
            echo '<span style="font-weight:bold;">Detalhes do erro:</span>' . '<br />';
            echo '<pre>' . $error_msg . '<br /><br />';
            //echo "     XML de envio: " . "<br />" . htmlentities($vmPost);
            echo '</pre><p><center>';
            echo '<input type="button" value="Retornar" onclick="javascript:if(window.opener!=null){window.opener.location.reload();' .
            'window.close();}else{window.location.href=' . "'pedido/';" . '}" />';
            echo '</center></p></body></html>';
            $error_msg .= "     XML de envio: " . "\n" . $vmPost;

            // Dispara o erro
            //trigger_error($error_msg, E_USER_ERROR);
        }
    }

    // Grava erros no arquivo de log
    function Handler($eNum, $eMsg, $file, $line, $eVars) {
        $logFile = "../logs/log.log";
        $e = "";
        $Data = date("Y-m-d H:i:s (T)");

        $errortype = array(
            E_ERROR => 'ERROR',
            E_WARNING => 'WARNING',
            E_PARSE => 'PARSING ERROR',
            E_NOTICE => 'RUNTIME NOTICE',
            E_CORE_ERROR => 'CORE ERROR',
            E_CORE_WARNING => 'CORE WARNING',
            E_COMPILE_ERROR => 'COMPILE ERROR',
            E_COMPILE_WARNING => 'COMPILE WARNING',
            E_USER_ERROR => 'ERRO NA TRANSACAO',
            E_USER_WARNING => 'USER WARNING',
            E_USER_NOTICE => 'USER NOTICE',
            E_STRICT => 'RUNTIME NOTICE',
            E_RECOVERABLE_ERROR => 'CATCHABLE FATAL ERROR'
        );

        $e .= "**********************************************************\n";
        $e .= $eNum . " " . $errortype[$eNum] . " - ";
        $e .= $Data . "\n";
        $e .= "     ARQUIVO: " . $file . "(Linha " . $line . ")\n";
        $e .= "     MENSAGEM: " . "\n" . $eMsg . "\n\n";

        error_log($e, 3, $logFile);

        exit();
    }
	
    // Retorno da Cielo - código LR de resposta
    // Retornos existentes no pdf Manual do Desenvolvedor
    public function Retornolr($codlr) {
    	if($codlr != "") {
    		$arraylr = array();
    		$arraylr['erro'] = "";
    		
	    	// Código de retornos LR
	    	switch ($codlr) {
	    		case "00":
	    			$arraylr['lr'] 			= "00";
	    			$arraylr['definicao'] 	= "Transação autorizada";
	    			$arraylr['significado'] = "Transação nacional aprovada com sucesso";
	    			$arraylr['acao'] 		= "-";
	    			break;
	    		case "01":
	    			$arraylr['lr'] 			= "01";
	    			$arraylr['definicao'] 	= "Transação referida pelo banco emissor";
	    			$arraylr['significado'] = "Referida pelo banco emissor";
	    			$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
	    			break;
	    		case "04":
	    			$arraylr['lr'] 			= "04";
	    			$arraylr['definicao'] 	= "Transação não autorizada";
	    			$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
	    			$arraylr['acao'] 		= "Oriente o portador a refazer a transação";
	    			break;
    			case "05":
    				$arraylr['lr'] 			= "05";
    				$arraylr['definicao'] 	= "Transação não autorizada";
    				$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "06":
    				$arraylr['lr'] 			= "06";
    				$arraylr['definicao'] 	= "Tente novamente";
    				$arraylr['significado'] = "Falha na autorização";
    				$arraylr['acao'] 		= "Oriente o portador a refazer a transação";
    				break;
    			case "07":
    				$arraylr['lr'] 			= "07";
    				$arraylr['definicao'] 	= "Cartão com restrição";
    				$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "08":
    				$arraylr['lr'] 			= "08";
    				$arraylr['definicao'] 	= "Código de segurança inválido";
    				$arraylr['significado'] = "Código de segurança incorreto";
    				$arraylr['acao'] 		= "Oriente o portador a refazer a transação digitando o código de segurança corretamente";
    				break;
    			case "11":
    				$arraylr['lr'] 			= "11";
    				$arraylr['definicao'] 	= "Transação autorizada";
    				$arraylr['significado'] = "Transação internacional aprovada com sucesso";
    				$arraylr['acao'] 		= "";
    				break;
    			case "13":
    				$arraylr['lr'] 			= "13";
    				$arraylr['definicao'] 	= "Valor inválido";
    				$arraylr['significado'] = "Valor inválido";
    				$arraylr['acao'] 		= "Oriente o portador a refazer a transação digitando o valor correto";
    				break;
    			case "14":
    				$arraylr['lr'] 			= "14";
    				$arraylr['definicao'] 	= "Cartão inválido";
    				$arraylr['significado'] = "Digitação incorreta do número do cartão";
    				$arraylr['acao'] 		= "Oriente o portador a verificar o número do cartão e digitar novamente";
    				break;
    			case "15":
    				$arraylr['lr'] 			= "15";
    				$arraylr['definicao'] 	= "Banco emissor indisponível";
    				$arraylr['significado'] = "Banco emissor indisponível";
    				$arraylr['acao'] 		= "Oriente o portador a aguardar alguns instantes e tentar novamente";
    				break;
    			case "21":
    				$arraylr['lr'] 			= "21";
    				$arraylr['definicao'] 	= "Cancelamento não efetuado";
    				$arraylr['significado'] = "Cancelamento não localizado no banco emissor";
    				$arraylr['acao'] 		= "O estabelecimento deve entrar em contato com a Central de Relacionamento Cielo";
    				break;
    			case "41":
    				$arraylr['lr'] 			= "41";
    				$arraylr['definicao'] 	= "Cartão com restrição";
    				$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "51":
    				$arraylr['lr'] 			= "51";
    				$arraylr['definicao'] 	= "Saldo insuficiente";
    				$arraylr['significado'] = "Saldo insuficiente";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "54":
    				$arraylr['lr'] 			= "54";
    				$arraylr['definicao'] 	= "Cartão vencido";
    				$arraylr['significado'] = "Cartão vencido";
    				$arraylr['acao'] 		= "Oriente o portador a verificar o vencimento do cartão e digitar novamente";
    				break;
    			case "57":
    				$arraylr['lr'] 			= "57";
    				$arraylr['definicao'] 	= "Transação não permitida";
    				$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "60":
    				$arraylr['lr'] 			= "60";
    				$arraylr['definicao'] 	= "Transação não autorizada";
    				$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "62":
    				$arraylr['lr'] 			= "62";
    				$arraylr['definicao'] 	= "Transação não autorizada";
    				$arraylr['significado'] = "Existe algum tipo de restrição no cartão";
    				$arraylr['acao'] 		= "Oriente o portador a contatar o banco emissor do cartão";
    				break;
    			case "78":
    				$arraylr['lr'] 			= "78";
    				$arraylr['definicao'] 	= "Cartão não foi desbloqueado pelo portador";
    				$arraylr['significado'] = "Cartão não foi desbloqueado pelo portador";
    				$arraylr['acao'] 		= "Oriente o portador a desbloquear o cartão junto ao emissor do cartão";
    				break;
    			case "82":
    				$arraylr['lr'] 			= "82";
    				$arraylr['definicao'] 	= "Erro no cartão";
    				$arraylr['significado'] = "Cartão inválido";
    				$arraylr['acao'] 		= "Oriente o portador a verificar o número do cartão e digitar novamente";
    				break;
    			case "91":
    				$arraylr['lr'] 			= "91";
    				$arraylr['definicao'] 	= "Banco fora do ar";
    				$arraylr['significado'] = "Banco emissor indisponível";
    				$arraylr['acao'] 		= "Oriente o portador a aguardar alguns instantes e tentar novamente";
    				break;
    			case "96":
    				$arraylr['lr'] 			= "96";
    				$arraylr['definicao'] 	= "Tente novamente";
    				$arraylr['significado'] = "Falha no envio da autorização";
    				$arraylr['acao'] 		= "Oriente o portador a aguardar alguns instantes e tentar novamente";
    				break;
    			case "AA":
    				$arraylr['lr'] 			= "AA";
    				$arraylr['definicao'] 	= "Tempo excedido";
    				$arraylr['significado'] = "Timeout na comunicação com o banco emissor";
    				$arraylr['acao'] 		= "Oriente o portador a aguardar alguns instantes e tentar novamente";
    				break;
    			case "AC":
    				$arraylr['lr'] 			= "AC";
    				$arraylr['definicao'] 	= "Use função débito";
    				$arraylr['significado'] = "Cartão de débito tentando utilizar produto crédito";
    				$arraylr['acao'] 		= "Oriente o portador a utilizar o cartão de débito (Visa ou MasterCard)";
    				break;
    			case "GA":
    				$arraylr['lr'] 			= "GA";
    				$arraylr['definicao'] 	= "Transação referida pela Cielo";
    				$arraylr['significado'] = "Referida pela Cielo";
    				$arraylr['acao'] 		= "Oriente o portador a aguardar alguns instantes e tentar novamente";
    				break;
	    		default:
	    			$arraylr['lr'] 			= "número de erro não encontrado";
	    			$arraylr['definicao'] 	= "Transação com erro";
	    			$arraylr['significado'] = "Transação com erro";
	    			$arraylr['acao'] 		= "Transação com erro";
	    	}
    	}else{
    		$arraylr = array();
    		$arraylr['erro'] = "Código LR não existente";
    	}
    	
    	return $arraylr;
    }
}