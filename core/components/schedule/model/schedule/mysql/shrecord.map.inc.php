<?php
$xpdo_meta_map['ShRecord']= array (
  'package' => 'schedule',
  'version' => '1.1',
  'table' => 'schedule_shRecord',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'resource' => 0,
    'day' => 0,
    'time' => NULL,
    'date_start' => NULL,
    'date_end' => NULL,
    'data' => NULL,
  ),
  'fieldMeta' => 
  array (
    'resource' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'day' => 
    array (
      'dbtype' => 'tinyint',
      'precision' => '1',
      'phptype' => 'integer',
      'null' => false,
      'default' => 0,
    ),
    'time' => 
    array (
      'dbtype' => 'time',
      'phptype' => 'string',
      'null' => true,
    ),
    'date_start' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'date_end' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'data' => 
    array (
      'dbtype' => 'text',
      'phptype' => 'string',
      'null' => true,
    ),
  ),
);
