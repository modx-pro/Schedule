<?php
class ScheduleHomeManagerController extends ScheduleManagerController {
	public function process(array $scriptProperties = array()) {}
	
	public function getPageTitle() { return $this->modx->lexicon('schedule'); }
	
	public function loadCustomCssJs() {
		$this->modx->regClientStartupScript($this->Schedule->config['jsUrl'].'mgr/widgets/resources.grid.js');
		$this->modx->regClientStartupScript($this->Schedule->config['jsUrl'].'mgr/widgets/home.panel.js');
		$this->modx->regClientStartupScript($this->Schedule->config['jsUrl'].'mgr/sections/home.js');
	}
	
	public function getTemplateFile() {
		return $this->Schedule->config['templatesPath'].'home.tpl';
	}
}