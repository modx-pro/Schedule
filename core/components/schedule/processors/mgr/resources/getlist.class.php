<?php

require_once MODX_CORE_PATH . 'model/modx/processors/resource/getlist.class.php';

class shResourceGetListProcessor extends modResourceGetListProcessor  {
	public $defaultSortField = 'menuindex';

	public function prepareQueryBeforeCount(xPDOQuery $c) {

		$c->where(array('published' => 1, 'deleted' => 0));
		if ($parents = $this->getProperty('parents')) {
			$parents = explode(',',$parents);
			$in = array();
			foreach ($parents as $id) {
				$in = array_merge($in, $this->modx->getChildIds($id));
			}
			$c->where(array('parent:IN' => array_unique($in)));
		}
		if ($resources = $this->getProperty('resources')) {
			$resources = explode(',',$resources);
			$in = $out = array();
			foreach ($resources as $id) {
				if ($id > 0) {$in[] = $id;}
				else if ($id < 0) {$out[] = abs($id);}
			}
			if (!empty($in)) {$c->where(array('id:IN' => $in));}
			if (!empty($out)) {$c->where(array('id:NOT IN' => $out));}
		}
		if ($search = $this->getProperty('search')) {
			$c->where(array('pagetitle:LIKE' => "%$search%"));
		}
		
		return $c;
	}
	
	public function prepareRow(xPDOObject $object) {
		$array = $object->toArray();
		if ($tmp = $this->modx->getObject('modResource', $array['parent'])) {
			$array['parent'] = $tmp->get('pagetitle');
		}
		$array['url'] = $this->modx->makeUrl($array['id'],'','','full');
		return $array;
	}

}

return 'shResourceGetListProcessor';