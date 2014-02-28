<?php

App::uses('AuthComponent', 'Controller/Component');

class AppError {
	public static function handleError($code='', $description='', $file = null, $line = null, $context = null) {
		App::uses('Router', 'Routing');
		$request = Router::getRequest(true);
		
		if ($e = error_get_last()) {
			$code = $e['type'];
			$description = $e['message'];
			$file = $e['file'];
			$line = $e['line'];
		}
		
		if($code){
			if(in_array($code,array(E_STRICT,E_DEPRECATED,E_USER_DEPRECATED))){
				//Do nothing
				return true;
			}elseif(!in_array($code,array(E_WARNING,E_NOTICE,E_USER_WARNING,E_USER_NOTICE))){
				
				AppError::reportError('ERROR', $code, $description, $file, $line, $context);
				if(Configure::read('debug') < 1){
					echo '<meta http-equiv="refresh" content="0;URL=\''.Router::url(array('controller'=>'errors','action'=>'index'),true).'\'">';
					exit();
				}else{
					return ErrorHandler::handleError($code, $description, $file, $line, $context);
				}
			}else{ //Non important Errors
				AppError::reportError('WARNING', $code, $description, $file, $line, $context);
				
				return ErrorHandler::handleError($code, $description, $file, $line, $context);
			}
		}
		
		
	}
	
	public static function reportError($emailSubject, $code='', $description='', $file = null, $line = null, $context = null){
		
		if(Configure::read('environment') == 'localhost'){

			return true;
		}
		AppError::getArrayContextToPrint($context);
		
		App::uses('AlphaEmailComponent','Controller/Component');
		$email = new AlphaEmailComponent('smtp');
		$email->template('error_report','blank');
		$email->emailFormat('html');
		$email->subject('['.$_SERVER['SERVER_NAME'].'] '.$emailSubject.'     '.date('Y-m-d H:i:s'));
		$email->to(Configure::read('Developers.email'));
		//$email->from('info@alphasunandsport.com');
		$email->viewVars(array(
				'context' => $context,
				'code' => $code,
				'description' => $description,
				'file' => $file,
				'line' => $line,
				
				));
		$email->sendToQueue();
	}
	
	public static function getArrayContextToPrint(&$context){
		if(is_array($context)){
			foreach($context as $key => $value){
				AppError::getArrayContextToPrint($context[$key]);
				
			}
		}elseif(is_object($context)){
			$keyName = 'OBJECT:'.get_class($context);
			if(isset($context->useDbConfig)){
				$tmpObj[$keyName] = array();
				foreach($context as $key => $value){
					if(in_array($key,array('id','data','validationErrors')) || is_object($value)){
						$tmpObj[$keyName][$key] = $context->$key;
						AppError::getArrayContextToPrint($tmpObj[$keyName][$key]);
					}
				}
				$context = $tmpObj;
			}else{
				$context = $keyName;
			}
		}	
	}
}
