<?php
/**
 * Salva as alterações efetuadas no módulo default (Log de ações)
 *
 * @name gazetamarista_Logatualizacoes
 * @author Rossi - gazetamarista
 */
class gazetamarista_Logatualizacoes {
	
	/**
	 * Cria o log de atualização
	 *
	 */
	static public function salvaAtualizacao($usuario, $modulo, $action, $tabela, $data_antes, $data) {
		// Armazena as ações executadas

		if($data_antes) {
			$data_antes = json_encode($data_antes);
		}

		if($data) {
			$data = json_encode($data);
		}
			
		// Monta os dados
		$data_insert 						= array();
		$data_insert['idusuario'] 			= NULL;
		$data_insert['nomeusuario'] 		= $usuario;
		$data_insert['modulo'] 				= $modulo;
		$data_insert['tabela'] 				= $tabela;
		$data_insert['json_data_antes'] 	= $data_antes;
		$data_insert['json_data'] 			= $data;
		$data_insert['acao_executada'] 		= $action;
		$insert_data['browser_sistema']		= json_encode($_SERVER["HTTP_USER_AGENT"]);
		$data_insert['data_execucao'] 		= date("Y-m-d H:i:s");
		$insert_data['ip'] 					= $_SERVER['REMOTE_ADDR'];

		// Seta o model dos logs
		$model = new Admin_Model_Logs();
		try {
			$model->insert($data_insert);
		}
		catch(Exception $e) {
			//throw new Zend_Controller_Action_Exception($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * Cria o log de erro
	 *
	 */
	static public function salvaErro($mensagem=NULL, $parametros=NULL, $erro=NULL) {
		// Armazena o erro retornado

		// Monta os dados
		$data_insert 						= array();
		$data_insert['data_execucao'] 		= date("Y-m-d H:i:s");
		$data_insert['mensagem'] 			= $mensagem;
		$data_insert['parametros'] 			= $parametros;
		$data_insert['browser_sistema']		= json_encode($_SERVER["HTTP_USER_AGENT"]);
        $data_insert['idusuario']		    = NULL;
        $data_insert['trace'] 			    = $erro;
		$data_insert['ip'] 					= $_SERVER['REMOTE_ADDR'];

		// Seta o model dos erros
		$model = new Admin_Model_Erros();
		try {
			$model->insert($data_insert);
		}
		catch(Exception $e) {
			//throw new Zend_Controller_Action_Exception($e->getMessage(), $e->getCode());
		}
	}
}