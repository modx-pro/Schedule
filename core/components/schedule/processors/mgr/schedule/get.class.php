<?php

class ShRecordGetProcessor extends modObjectGetProcessor {
    public $classKey = 'ShRecord';
    public $languageTopics = array('schedule:default');
    public $objectType = 'schedule.record';

	public function beforeOutput() {
		$data = $this->object->get('data');
		$data = json_decode($data, 1);
		foreach ($data as $k => $v) {
			$this->object->set('data_'.$k, $v);
		}
	}

}

return 'ShRecordGetProcessor';