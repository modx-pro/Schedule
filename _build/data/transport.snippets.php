<?php
/**
 * Add snippets to build
 * 
 * @package schedule
 * @subpackage build
 */
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
	'id' => 0,
	'name' => 'Schedule',
	'description' => 'Example of displays schedule records',
	'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.schedule.php'),
),'',true,true);
$properties = include $sources['build'].'properties/properties.schedule.php';
$snippets[0]->setProperties($properties);
unset($properties);

$snippets[1]= $modx->newObject('modSnippet');
$snippets[1]->fromArray(array(
	'id' => 0,
	'name' => 'getResourceTitle',
	'description' => 'Output filter that gets pagetitle of specified resource',
	'snippet' => getSnippetContent($sources['source_core'].'/elements/snippets/snippet.gettitle.php'),
),'',true,true);

return $snippets;