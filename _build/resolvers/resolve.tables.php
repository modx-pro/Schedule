<?php
/**
 * Resolve creating db tables
 *
 * @package schedule
 * @subpackage build
 */
if ($object->xpdo) {
	switch ($options[xPDOTransport::PACKAGE_ACTION]) {
		case xPDOTransport::ACTION_INSTALL:
			$modx =& $object->xpdo;
			$modelPath = $modx->getOption('schedule.core_path',null,$modx->getOption('core_path').'components/schedule/').'model/';
			$modx->addPackage('schedule',$modelPath);

			$manager = $modx->getManager();

			$manager->createObjectContainer('ShRecord');

			break;
		case xPDOTransport::ACTION_UPGRADE:
			break;
	}
}
return true;