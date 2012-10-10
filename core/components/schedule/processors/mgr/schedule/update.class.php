<?php

class ShRecordUpdateProcessor extends modObjectUpdateProcessor {
	public $classKey = 'ShRecord';
	public $languageTopics = array('schedule');
	public $permission = 'update_document';
	
	public function beforeSet() {
		$properties = $this->getProperties();
		$data = array();
		foreach ($properties as $k => $v) {
			if (empty($v)) {continue;}
			if (preg_match('/^data\_/i', $k)) {
				$k = str_replace('data_', '', $k);
				$data[$k] = $v;
			}
		}

		$this->setProperty('data', json_encode($data));

		return !$this->hasErrors();
	}
	
}

return 'ShRecordUpdateProcessor';