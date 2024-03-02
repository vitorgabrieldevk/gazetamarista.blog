<?php

/**
 * Controlador
 *
 * @name Admin_ClientesController
 */
class Admin_ClientesController extends gazetamarista_Controller_Action {
	/**
	 * Armazena o model padrão da tela
	 *
	 * @access protected
	 * @name $_model
	 * @var Admin_Model_Clientes
	 */
	protected $_model = NULL;

	/**
	 * Inicializa o controlador
	 * 
	 * @name init
	 */
	public function init() {
		// Inicializa o model da tela
		$this->_model = new Admin_Model_Clientes();
		
		// Continua o carregamento do controlador
		parent::init();
	}

	/**
     * Hook para ser executado antes do insert
     *
     * @access protected
     * @name doBeforeInsert
     * @param array $data Vetor com os valores à serem inseridos
     * @return array
     */
    protected function doBeforeInsert($data)
	{
        // Data
        // if(empty($data['data']))
        // {
           $data['data'] = date("Y-m-d H:i:s");
        // }

		return $data;
	}

    /**
     * Hook para listagem
     *
     * @name doBeforeList
     * @param Zend_Db_Table_Select
     * @return Zend_Db_Table_Select
     */
    public function doBeforeList($select) {
        // Busca os parametros
        $data_inicial       = $this->_request->getParam("data_inicial", "");
        $data_inicial       = implode("-", array_reverse(explode("-", $data_inicial)));
        $data_final         = $this->_request->getParam("data_final", "");
        $data_final         = implode("-", array_reverse(explode("-", $data_final)));

        // Monta a query
        $select
	        ->from("Zend_clientes", array("*"))
			->order("data DESC"); 

        // Verifica os campos da data
        if (($data_inicial != "") && ($data_final != ""))
        {
            $select->where("CAST(data AS DATE) BETWEEN '" . $data_inicial . "' AND '" . $data_final . "'");
            $this->view->filtro_data_inicial = $data_inicial;
            $this->view->filtro_data_final = $data_final;
        }   
        elseif ($data_inicial != "")
        {
            $select->where("CAST(data AS DATE) >= ?", $data_inicial);
            $this->view->filtro_data_inicial = $data_inicial;
        }
        elseif ($data_final != "")
        {
            $select->where("CAST(data AS DATE) <= ?", $data_final);
            $this->view->filtro_data_final = $data_final;
        }

        // Monta a URL
        $url = "";
        $url .= ($data_inicial != "") ? "/data_inicial/" . $data_inicial : "";
        $url .= ($data_final != "") ? "/data_final/" . $data_final : "";

        // Assina na viu os parâmetros de pesquisa
        $this->view->parametros = $url;
    
        // Continua a execução
        return $select;
    }

}