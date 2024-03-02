<?php

/**
 * Classe de consulta de fraude da Clearsale
 * 
 * @name gazetamarista_Fraudes_Clearsale
 */
class gazetamarista_Fraudes_Clearsale extends gazetamarista_Fraudes_Abstract {
	
    /**
     * Armazena o nome da integração
     *
     * @access protected
     * @name $_name
     * @var string
     */
    protected $_name = "Clearsale";
	
    /**
     * Armazena o endereço do gateway
     * 
     * @access private
     * @name $_gateway
     * @var string
     */
    // Ambiente de teste - homologação
	private $_gateway 			= "http://homologacao.clearsale.com.br/integracaov2/service.asmx/SendOrders";
	private $_gateway_check		= "http://homologacao.clearsale.com.br/integracaov2/service.asmx/CheckOrderStatus";
	private $_gateway_f 		= "http://homologacao.clearsale.com.br/integracaov2/service.asmx/GetOrderStatus";
	private $_gateway_package 	= "http://homologacao.clearsale.com.br/integracaov2/service.asmx/GetPackageStatus";
	
    // Ambiente de produção
    //private $_gateway 			= "http://integracao.clearsale.com.br/service.asmx/SendOrders";
    //private $_gateway_check		= "http://www.clearsale.com.br/integracaov2/service.asmx/CheckOrderStatus";
    //private $_gateway_f 			= "http://integracao.clearsale.com.br/service.asmx/GetOrderStatus";
	//private $_gateway_package 	= "http://integracao.clearsale.com.br/service.asmx/GetPackageStatus";
	
    /**
     * Inicializa a classe de pagamento
     *
     * @name init
     */
    public function init() {
        
    }
	
    /**
     * Efetua a verificação da fraude
     *
     * @name analise
     * @return boolean
     */
    public function analise() {
        session_start();
		
        //Recupera os dados do cliente   
        $params = $this->_request->getParams();
		
        // Tipo do pagamento
        $tipo_pagamento = "1"; //1 - cartão; 2 - boleto
        
        // Bandeiras
        // 1 - Diners; 2 - Mastercard; 3 - Visa; 4 - Outros; 5 - American Express; 6 - Hipercard; 7 - Aura
        if($this->_pedido->idmetodo_pagamento == 1140) {
            // 1140 - Mastercard
            $bandeira = 2;
        }elseif($this->_pedido->idmetodo_pagamento == 1130) {
        	// 1130 - Visa
        	$bandeira = 3;
        }elseif($this->_pedido->idmetodo_pagamento == 2020) {
            // 2020 - Diners
            $bandeira = 1;
        }elseif($this->_pedido->idmetodo_pagamento == 2030) {
        	// 1130 - Amex
        	$bandeira = 5;
        }else{
            // Outros (Elo)
            $bandeira = 4;
        }
		
        // Ajusta o telefone de pagamento
        $tmp = explode(" ", $this->_pedido->telefone_pagamento);
        $ddd_telefone = str_replace("(", "", str_replace(")", "", trim($tmp[0])));
        $telefone = str_replace("-", "", trim($tmp[1]));
        
        if($ddd_telefone == "" || $telefone == "") {
        	$ddd_telefone = "43";
        	$telefone = "33373800";
        }
        
        // Ip
        $endereco_ip = $this->_pedido->endereco_ip;
        
        if($endereco_ip == "::1") {
        	$endereco_ip = "187.18.124.240";
        }
        
        // Ajusta o celular de pagamento
        $tmp = explode(" ", $this->_pedido->celular_pagamento);
        $ddd_celular = str_replace("(", "", str_replace(")", "", trim($tmp[0])));
        $celular = str_replace("-", "", trim($tmp[1]));
        
        $documento_pagamento = str_replace(".", "", str_replace("-", "", $this->_pedido->documento_pagamento));
        $data = str_replace(" ", "T", $this->_pedido->data_criacao);
        $dataNascimento = $this->_pedido->data_nascimento . "T00:00:00";
		
        $id_unico = session_id();
		
        // Model de Produtos do pedido
        $model = new Admin_Model_Pedidosprodutos();
        
        // Seleciona Produtos do pedido
        $select = $model->select()
        	->from(array('pp' => 'pedidos_produtos'))
        	->join(array('p' => 'produtos'), 'p.idproduto = pp.idproduto')
        	->where('pp.idpedido = ?', $this->_pedido->idpedido)
        	->setIntegrityCheck(false);
        
        // Fetch All produtos
        $pedidoItens = $model->fetchAll($select);
		
        // XML
        $var2['entityCode'] = $this->_config->codigo;
        $var2['xml'] = "<ClearSale>
                            <Orders>
                            <Order>
                                <ID>{$this->_pedido->idpedido}</ID>
                                <FingerPrint>
                                	<SessionID>{$id_unico}</SessionID>
                                </FingerPrint>
                                <Date>{$data}</Date>
                                <Email>{$this->_pedido->email_pagamento}</Email>
                                <ShippingPrice>{$this->_pedido->valor_frete}</ShippingPrice>
                                <TotalItems>" . ($this->_pedido->valor_pedido - $this->_pedido->valor_frete) . "</TotalItems>
                                <TotalOrder>{$this->_pedido->valor_pedido}</TotalOrder>
                                <QtyInstallments>{$this->_pedido->parcelas}</QtyInstallments>
                                <IP>{$endereco_ip}</IP>
                                
                                <BillingData>
                                    <ID>{$this->_pedido->idcliente}</ID>
                                    <Type>1</Type>
                                    <LegalDocument1>{$documento_pagamento}</LegalDocument1>
                                    <Name>{$this->_pedido->nome_pagamento} {$this->_pedido->sobrenome_pagamento}</Name>
                                    <BirthDate>{$dataNascimento}</BirthDate>
                                    <Email>{$this->_pedido->email_pagamento}</Email>
                                    <Gender>{$this->_pedido->sexo}</Gender>
                                    <Address>
                                        <Street>{$this->_pedido->endereco_entrega}</Street>
                                        <Number>{$this->_pedido->numero_entrega}</Number>
                                        <Comp>{$this->_pedido->complemento_entrega}</Comp>
                                        <County>{$this->_pedido->bairro_entrega}</County>
                                        <City>{$this->_pedido->cidade_entrega}</City>
                                        <State>{$this->_pedido->estado_entrega}</State>
                                        <ZipCode>{$this->_pedido->cep_entrega}</ZipCode>
                                    </Address>
                                    <Phones>
                                        <Phone>
                                            <Type>4</Type> 
                                            <DDD>{$ddd_telefone}</DDD>
                                            <Number>{$telefone}</Number>
                                        </Phone>
                                    </Phones>
                                </BillingData>
								
                                <ShippingData>
                                    <ID>{$this->_pedido->idcliente}</ID>
                                    <Type>1</Type>
                                    <LegalDocument1>{$documento_pagamento}</LegalDocument1>
                                    <Name>{$this->_pedido->destinatario_entrega}</Name>
                                    <BirthDate>{$dataNascimento}</BirthDate>
                                    <Email>{$this->_pedido->email_pagamento}</Email>
                                    <Gender>{$this->_pedido->sexo}</Gender>
                                    <Address>
                                        <Street>{$this->_pedido->endereco_entrega}</Street>
                                        <Number>{$this->_pedido->numero_entrega}</Number>
                                        <Comp>{$this->_pedido->complemento_entrega}</Comp>
                                        <County>{$this->_pedido->bairro_entrega}</County>
                                        <City>{$this->_pedido->cidade_entrega}</City>
                                        <State>{$this->_pedido->estado_entrega}</State>
                                        <Country>Brasil</Country>
                                        <ZipCode>{$this->_pedido->cep_entrega}</ZipCode>
                                    </Address>
                                    <Phones>
                                        <Phone>
                                            <Type>4</Type> 
                                            <DDD>{$ddd_telefone}</DDD>
                                            <Number>{$telefone}</Number>
                                        </Phone>
                                    </Phones>
                                </ShippingData>
                                
                                <Payments>
                                    <Payment>
                                        <Date>{$data}</Date>
                                        <Amount>{$this->_pedido->valor_pedido}</Amount>
                                        <PaymentTypeID>1</PaymentTypeID>
                                        <QtyInstallments>{$this->_pedido->parcelas}</QtyInstallments>
                                        <CardNumber>{$params['numeroCartao']}</CardNumber>
                                        <CardType>{$bandeira}</CardType> 
                                        <Address>
                                            <Street>{$this->_pedido->endereco_pagamento}</Street>
                                            <Number>{$this->_pedido->numero_pagamento}</Number>
                                            <Comp>{$this->_pedido->complemento_pagamento}</Comp>
                                            <County>{$this->_pedido->bairro_pagamento}</County>
                                            <City>{$this->_pedido->cidade_pagamento}</City>
                                            <State>{$this->_pedido->estado_pagamento}</State>
                                            <ZipCode>{$this->_pedido->cep_pagamento}</ZipCode>
                                        </Address>
                                    </Payment>
                                </Payments>
                            <Items>";
        					
        // Produtos individuais
        foreach($pedidoItens as $item) {
            $var2['xml'] .= "
							<Item>
								<ID>{$item->idproduto}</ID>
								<Name>{$item->titulo}</Name>
								<ItemValue>{$item->preco_venda}</ItemValue>
								<Qty>" . (int) $item->quantidade . "</Qty>
							</Item>
						";
        }

        $var2['xml'] .= "</Items>
                            </Order>
                            </Orders>
                            </ClearSale>";
        
        try {
            // Faz a requisição para a análise
            $client = new Zend_Http_Client();
            $client->setUri($this->_gateway);
            $client->setParameterPost($var2);
            $response = $client->request("POST");

            $xml = $response->getBody();
            $result_body = simplexml_load_string($xml);
            
        } catch (Exception $e) {
            $param['codigo_erro'] = $e->getCode();
            $param['mensagem_erro'] = $e->getMessage();
            $param['trace_erro'] = $e->getTrace();
            $param['params_erro'] = $this->_request->getParams();
            
            // Salva o log da transação
            $this->status(10, json_encode($param), $e->getMessage());

            // Retorna o erro
            return FALSE;
        }
		
        // Faz o parse do retorno
        preg_match_all("/<Status>(.*?)<\/Status>/", $result_body, $result);

        // Zend_Debug::dump($result);exit;
        /*
          Exemplo de retorno:
          <?xml version="1.0" encoding="utf-8"?><ClearID><PackageStatus><TransactionID>5d9fa097-9dd5-47dc-9a80-871ad3e9e4c2</TransactionID><StatusCode>0</StatusCode><Message>OK</Message><Pedidos><Pedido><ID>433</ID><Score>48.7000</Score><Status>RPA</Status><URLQuestionario /></Pedido></Pedidos></PackageStatus></ClearID>
         */

        // Se não retornou resultado insere registro com status em andamento de análise manual
        if ($result[1][0] == NULL) {
            // Salva o log da transação
            $this->status(15, json_encode($param), $result_body);

            // Retorna o erro
            return FALSE;
        }
		
        // Verifica o nivel da fraude
        switch ($result[1][0]) {
            case "RPM":
            case "SUS":
            case "CAN":
            case "FRD":
            case "RPA":
            case "RPP":
                // status = suspeita de fraude
                $status = 10;
                $return = FALSE;
                break;

            case "AMA":
            case "NVO":
            case "ERR":
                // status = aguardar nova análise
                $status = 15;
                $return = FALSE;
                break;

            case "APA":
            case "APM":
            case "PEN":
                // status = em andamento
                $status = 1;
                $return = TRUE;
                break;
        }
        
        // Salva o log da transação
        $this->status($status, json_encode($result_body), $result_body);
		
        // Retorna o resultado da consulta
        return $return;
    }
    
    /**
     * Efetua a checagem do status da fraude
     *
     * @name checkstatus
     * @return boolean
     */
    public function checkstatus() {
    	session_start();
    	
    	// XML
    	$var2['entityCode'] 		= $this->_config->codigo;
    	$var2['pedidoIDCliente'] 	= $this->_pedido->idpedido;
    	
    	try {
    		// Faz a requisição para a recuperação do status (CheckOrderStatus)
    		$client = new Zend_Http_Client();
    		$client->setUri($this->_gateway_check);
    		$client->setParameterPost($var2);
    		$response = $client->request("POST");
    		 
    		$xml = $response->getBody();
    		$result_body = simplexml_load_string($xml);
    	}catch (Exception $e) {
    		$param['codigo_erro'] = $e->getCode();
    		$param['mensagem_erro'] = $e->getMessage();
    		$param['trace_erro'] = $e->getTrace();
    		$param['params_erro'] = $this->_request->getParams();
    		
    		// Retorna o erro
    		return FALSE;
    	}
    	
    	// Faz o parse do retorno
    	preg_match_all("/<Score>(.*?)<\/Score>/", $result_body, $result_score);
    	preg_match_all("/<Status>(.*?)<\/Status>/", $result_body, $result_status);
    	
    	// Verifica o nivel da fraude
    	switch ($result_status[1][0]) {
    		case "RPM":
    		case "SUS":
    		case "CAN":
    		case "FRD":
    		case "RPA":
    		case "RPP":
    			// status = suspeita de fraude
    			$status = 10;
    			$return = FALSE;
    			
    			// Salva o log da transação
    			$this->status($status, json_encode($result_body), $result_body);
    			
    			break;
    			 
    		case "AMA":
    		case "NVO":
    		case "ERR":
    			// status = aguardar nova análise
    			$status = 15;
    			$return = FALSE;
    			break;
    			 
    		case "APA":
    		case "APM":
    		case "PEN":
    			// status = em andamento
    			$status = 1;
    			$return = TRUE;
    			
    			// Salva o log da transação
    			$this->status($status, json_encode($result_body), $result_body);
    			
    			break;
    	}
    	
    	// Retorna o resultado da consulta
    	return $return;
    }
    
    /**
     * Efetua a verificação do status da fraude
     *
     * @name getstatus
     * @return boolean
     */
    public function getstatus() {
    	session_start();
    	
    	// XML
    	$var2['entityCode'] = $this->_config->codigo;
    	$var2['orderID'] = $this->_pedido->idpedido;
    	
    	try {
    		// Faz a requisição para a recuperação do status
    		$client = new Zend_Http_Client();
    		$client->setUri($this->_gateway_f);
    		$client->setParameterPost($var2);
    		$response = $client->request("POST");
    	
    		$xml = $response->getBody();
    		$result_body = simplexml_load_string($xml);
    	} catch (Exception $e) {
    		$param['codigo_erro'] = $e->getCode();
    		$param['mensagem_erro'] = $e->getMessage();
    		$param['trace_erro'] = $e->getTrace();
    		$param['params_erro'] = $this->_request->getParams();
    		
    		// Salva o log da transação
    		$this->status(10, json_encode($param), $e->getMessage());
    	
    		// Retorna o erro
    		return FALSE;
    	}
    	
    	// Faz o parse do retorno
    	preg_match_all("/<Score>(.*?)<\/Score>/", $result_body, $result_score);	
    	preg_match_all("/<Status>(.*?)<\/Status>/", $result_body, $result_status);
    	
    	// Verifica o nivel da fraude
    	switch ($result_status[1][0]) {
    		case "RPM":
    		case "SUS":
    		case "CAN":
    		case "FRD":
    		case "RPA":
    		case "RPP":
    			// status = suspeita de fraude
    			$status = 10;
    			$return = FALSE;
    			break;
    	
    		case "AMA":
    		case "NVO":
    		case "ERR":
    			// status = aguardar nova análise
    			$status = 15;
    			$return = FALSE;
    			break;
    	
    		case "APA":
    		case "APM":
    		case "PEN":
    			// status = em andamento
    			$status = 1;
    			$return = TRUE;
    			break;
    	}
    	
    	// Retorna o resultado da consulta
    	return $return;
    }
}