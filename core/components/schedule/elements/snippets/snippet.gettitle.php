<?php
if ($res = $modx->getObject('modResource', $input)) {
	return $res->get('pagetitle');
}