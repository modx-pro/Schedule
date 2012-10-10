<?php
/**
 * Schedule Connector
 *
 * @package schedule
 */
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'config/'.MODX_CONFIG_KEY.'.inc.php';
require_once MODX_CONNECTORS_PATH.'index.php';

$corePath = $modx->getOption('schedule.core_path',null,$modx->getOption('core_path').'components/schedule/');
require_once $corePath.'model/schedule/schedule.class.php';
$modx->Schedule = new Schedule($modx);

$modx->lexicon->load('schedule:default');

/* handle request */
$path = $modx->getOption('processorsPath',$modx->Schedule->config,$corePath.'processors/');
$modx->request->handleRequest(array(
    'processors_path' => $path,
    'location' => '',
));