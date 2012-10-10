<?php
$modx->Schedule = $modx->getService('schedule','Schedule',$modx->getOption('schedule.core_path',null,$modx->getOption('core_path').'components/schedule/').'model/schedule/',$scriptProperties);
if (!($modx->Schedule instanceof Schedule)) return '';

$scriptProperties['render_data_tpl'] = $scriptProperties['tplCol.data'];
$response = $modx->runProcessor('mgr/schedule/getlist'
	,$scriptProperties
	,array('processors_path' => $modx->Schedule->config['processorsPath'])
);
if ($response->isError()) {
	return $modx->error->failure($response->getMessage());
}
$records = json_decode($response->response, 1);
$data = array();
foreach ($records['results'] as $v) {
	$data[$v['time']][$v['day']] = $v['data'];
}
ksort($data);

$rows = '';
foreach ($data as $k => $v) {
	$cols = '';
	for ($i = 1; $i <= 7; $i++) {
		if (isset($v[$i])) {
			$data = $v[$i];
		}
		else {$data = '';}
		
		$cols .= $modx->getChunk($tplCol, array('data' => $data));
	}
	$rows .= $modx->getChunk($tplRow, array('time' => $k, 'cols' => $cols));
}

$output = $modx->getChunk($tplOuter, array('rows' => $rows));
return $output;