<?php

class ScheduleGetListProcessor extends modObjectGetListProcessor {
	public $classKey = 'ShRecord';
	public $defaultSortField = 'id';
	public $defaultSortDirection  = 'DESC';
	public $renderers = '';
	
	public function prepareQueryBeforeCount(xPDOQuery $c) {
		if ($resource = $this->getProperty('resource')) {
			$c->where(array('resource' => $resource));
		}
		if ($date_start = $this->getProperty('date_start')) {
			$c->where(array('date_start:>=' => $date_start));
		}
		if ($date_end = $this->getProperty('date_end')) {
			$c->where(array('date_end:<=' => $date_end));
		}
		return $c;
	}

	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		if ($tmp_arr = json_decode($array['data'], true)) {
			$array['data'] = $tmp_arr;
		}
		$array['data'] = $this->modx->getChunk($this->modx->Schedule->config['render_data_tpl'], $array['data']);
		$array['data'] = preg_replace('/\[\[(.*)\]\]/', '', $array['data']);
		
		return $array;
	}
	
}

return 'ScheduleGetListProcessor';