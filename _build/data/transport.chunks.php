<?php
/**
 * Add chunks to build
 * 
 * @package schedule
 * @subpackage build
 */
$chunks = array();

$chunks[0]= $modx->newObject('modChunk');
$chunks[0]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Schedule.col',
	'description' => 'One column of table',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/schedule_col.chunk.tpl'),
),'',true,true);

$chunks[1]= $modx->newObject('modChunk');
$chunks[1]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Schedule.col.data',
	'description' => 'Chunk for templating one cell',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/schedule_col_data.chunk.tpl'),
),'',true,true);

$chunks[2]= $modx->newObject('modChunk');
$chunks[2]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Schedule.data.row',
	'description' => 'Chunk for templating additional data in record',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/schedule_data_row.chunk.tpl'),
),'',true,true);

$chunks[3]= $modx->newObject('modChunk');
$chunks[3]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Schedule.outer',
	'description' => 'Outer of schedule table',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/schedule_outer.chunk.tpl'),
),'',true,true);

$chunks[4]= $modx->newObject('modChunk');
$chunks[4]->fromArray(array(
	'id' => 0,
	'name' => 'tpl.Schedule.row',
	'description' => 'One table row',
	'snippet' => file_get_contents($sources['source_core'].'/elements/chunks/schedule_row.chunk.tpl'),
),'',true,true);


return $chunks;