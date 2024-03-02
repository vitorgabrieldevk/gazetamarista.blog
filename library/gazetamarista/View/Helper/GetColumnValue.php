<?php 

class gazetamarista_View_Helper_GetColumnValue {
	
	/**
	 * Busca o valor da coluna, buscando o valor caso seja o valor de uma tabela relacionada
	 * 
	 * @name GetColumnValue
	 * @param Zend_Db_Table_Row
	 * @param string $field Nome da coluna
	 * @return string
	 */
	public function GetColumnValue($row, $field) {
		//
		$model = $row->getTable();

		// Busca o valor do campo
        $value = $row->$field;
		
		// Busca a classe referencia da coluna
		$reference_table = $model->getAutocomplete($field);
		$reference_table = $reference_table['model'];
		if($reference_table != NULL && !empty($value)) {
			// Instancia a classe model
			$referece_model = new $reference_table();
			
			// Busca table name
            $tablename = $referece_model->getTableName();

			// Busca primary key
			$primarykey_column = current($referece_model->getPrimaryField());

			// Busca a coluna descrição
			$description_column = $referece_model->getDescription();

			// Busca o valor (findParentRow)
			//$value = $row->findParentRow($reference_table)->$description_column;

			// Busca o valor (select - fetchRow)
            $select_reference = $referece_model->select()->from($tablename, array($description_column))->where($primarykey_column . " = " . (int)$value);
            $value = $referece_model->fetchRow($select_reference)->$description_column;
		}
		
		// Busca a descrição da tabela
		$columns = $model->describeTable();
		
		// Verifica o tipo do campo
		switch($columns[$field]['DATA_TYPE']) {
			case "decimal":
			case "float8":
				// Formata o valor
				$value = number_format($value, $columns[$field]['SCALE'], ",", ".");
				break;
				
			case "date":
			case "timestamp":
				// Remove a parte da hora
				$values = explode(" ", $value);
				
				// Formata a data
				$data = implode("/", array_reverse(explode("-", $values[0])));
				
				// Verifica se a data existe
				if($data == "00/00/0000" || $data == "30/11/-0001") {
					$data = "--/--/----";
				}
				
				$value = $data;
				break;
				
			case "datetime":
				// Formata a data
				if($value != "") {
					$timestamp = strtotime($value);
					$value = date("d/m/Y H:i:s", $timestamp);
				}else{
					$value = "--";
				}

				if($value == "30/11/-0001 00:00:00") {
				    $value = "--";
                }
			
				break;
				
			case "tinyint":
			case "bool":
				if($value) {
					$value = "Sim";
				}
				else {
					$value = "Não";
				}
				break;
				
			default:
				if(strlen($value) == 0) {
					$value = "--";
				}
				break;
		}
		
		//
		return $value;
	}
}
