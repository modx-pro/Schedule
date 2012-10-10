<?php
/**
 * The base class for Schedule.
 *
 * @package schedule
 */
class Schedule {
	function __construct(modX &$modx,array $config = array()) {
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('schedule.core_path',$config,$this->modx->getOption('core_path').'components/schedule/');
		$assetsUrl = $this->modx->getOption('schedule.assets_url',$config,$this->modx->getOption('assets_url').'components/schedule/');
		$connectorUrl = $assetsUrl.'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl
			,'cssUrl' => $assetsUrl.'css/'
			,'jsUrl' => $assetsUrl.'js/'
			,'imagesUrl' => $assetsUrl.'images/'

			,'connectorUrl' => $connectorUrl

			,'corePath' => $corePath
			,'modelPath' => $corePath.'model/'
			,'chunksPath' => $corePath.'elements/chunks/'
			,'chunkSuffix' => '.chunk.tpl'
			,'snippetsPath' => $corePath.'elements/snippets/'
			,'processorsPath' => $corePath.'processors/'
			,'templatesPath' => $corePath.'templates/'
			,'parents' => $modx->getOption('schedule.parents','',0)
			,'resources' => $modx->getOption('schedule.resources','',0)
			,'render_data_tpl' => $modx->getOption('schedule.render_data_tpl','','tpl.Schedule.data.row')
		),$config);
		
		$this->modx->addPackage('schedule',$this->config['modelPath']);
		$this->modx->lexicon->load('schedule:default');
	}

	/**
	 * Initializes Schedule into different contexts.
	 *
	 * @access public
	 * @param string $ctx The context to load. Defaults to web.
	 */
	public function initialize($ctx = 'web') {
		switch ($ctx) {
			case 'mgr':
				if (!$this->modx->loadClass('schedule.request.ScheduleControllerRequest',$this->config['modelPath'],true,true)) {
					return 'Could not load controller request handler.';
				}
				$this->request = new ScheduleControllerRequest($this);
				return $this->request->handleRequest();
			break;
			case 'connector':
				if (!$this->modx->loadClass('schedule.request.ScheduleConnectorRequest',$this->config['modelPath'],true,true)) {
					return 'Could not load connector request handler.';
				}
				$this->request = new ScheduleConnectorRequest($this);
				return $this->request->handle();
			break;
			default:
				/* if you wanted to do any generic frontend stuff here.
				 * For example, if you have a lot of snippets but common code
				 * in them all at the beginning, you could put it here and just
				 * call $schedule->initialize($modx->context->get('key'));
				 * which would run this.
				 */
			break;
		}
	}

}