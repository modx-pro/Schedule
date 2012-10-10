<?php
/**
 * @package schedule
 */

require_once dirname(__FILE__) . '/model/schedule/schedule.class.php';

abstract class ScheduleManagerController extends modExtraManagerController {
	public $Schedule;

	public function initialize() {
		$this->Schedule = new Schedule($this->modx);
		
		$this->modx->regClientCSS($this->Schedule->config['cssUrl'].'mgr.css');
		$this->modx->regClientStartupScript($this->Schedule->config['jsUrl'].'mgr/schedule.js');
		$this->modx->regClientStartupHTMLBlock('<script type="text/javascript">
		Ext.onReady(function() {
			Schedule.config = '.$this->modx->toJSON($this->Schedule->config).';
			Schedule.config.connector_url = "'.$this->Schedule->config['connectorUrl'].'";
			Schedule.config.form_fields = function() {return '.$this->modx->getOption('schedule.form_fields','','[]').'};
			Schedule.config.grid_resources_fields = function() {return '.$this->modx->getOption('schedule.grid_resources_fields','','[]').'};
			Schedule.config.grid_resources_columns = function() {return '.$this->modx->getOption('schedule.grid_resources_columns','','[]').'};
			Schedule.config.grid_schedules_fields = function() {return '.$this->modx->getOption('schedule.grid_schedules_fields','','[]').'};
			Schedule.config.grid_schedules_columns = function() {return '.$this->modx->getOption('schedule.grid_schedules_columns','','[]').'};
			Schedule.action = "'.(!empty($_REQUEST['a']) ? $_REQUEST['a'] : 0).'";
		});
		</script>');
		
		return parent::initialize();
	}
	public function getLanguageTopics() {
		return array('schedule:default');
	}
	public function checkPermissions() { return true;}
}
class IndexManagerController extends ScheduleManagerController {
	public static function getDefaultController() { return 'home'; }
}