<?php
/**
 * Loads system settings into build
 *
 * @package schedule
 * @subpackage build
 */
$settings = array();

$settings[0]= $modx->newObject('modSystemSetting');
$settings[0]->fromArray(array(
	'key' => 'schedule.form_fields'
	,'value' => '[{xtype:"schedule-combo-resources",fieldLabel:_("schedule.trainer"),name:"data_trainer",hiddenName:"data_trainer",anchor:"99%",allowBlank:false,baseParams:{action:"mgr/resources/getlist",parents:0}},{xtype:"schedule-combo-resources",fieldLabel:_("schedule.program"),name:"data_program",hiddenName:"data_program",anchor:"99%",allowBlank:false,baseParams:{action:"mgr/resources/getlist",parents:0}},{xtype:"schedule-combo-days",fieldLabel:_("schedule.day"),name:"day",anchor:"85%",allowBlank:false},{xtype:"timefield",fieldLabel:_("schedule.time"),name:"time",anchor:"85%",emptyText:_("schedule.select"),format:"H:i:s",editable:false,increment:60,minValue:"8AM",maxValue:"8PM",allowBlank:false},{xtype:"hidden",name:"data_color",id:"schedule-colorfield"},{xtype:"colorpalette",fieldLabel:_("schedule.color"),width:200,listeners:{select:function(palette,setColor){Ext.getCmp("schedule-colorfield").setValue(setColor)},beforerender:function(palette){varcolor=Ext.getCmp("schedule-colorfield").value;if(typeof(color)!="undefined"){palette.value=color;}}}},{xtype:"textarea",fieldLabel:_("description"),name:"data_desc",anchor:"99%"}]'
	,'xtype' => 'textarea'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[1]= $modx->newObject('modSystemSetting');
$settings[1]->fromArray(array(
	'key' => 'schedule.grid_resources_columns'
	,'value' => '[{header:_("id"),dataIndex:"id",sortable:true,width:70},{header:_("pagetitle"),dataIndex:"pagetitle",sortable:true,width:200},{header:_("parent"),dataIndex:"parent",width:250}]'
	,'xtype' => 'textfield'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[2]= $modx->newObject('modSystemSetting');
$settings[2]->fromArray(array(
	'key' => 'schedule.grid_resources_fields'
	,'value' => '["id","pagetitle","parent","url"]'
	,'xtype' => 'textarea'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[3]= $modx->newObject('modSystemSetting');
$settings[3]->fromArray(array(
	'key' => 'schedule.grid_schedules_columns'
	,'value' => '[{header:_("schedule.day"),dataIndex:"day",sortable:true,renderer:Schedule.renderDay,width:200},{header:_("schedule.time"),dataIndex:"time",sortable:true,width:150},{header:_("schedule.data"),dataIndex:"data",sortable:false,width:400}]'
	,'xtype' => 'textarea'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[4]= $modx->newObject('modSystemSetting');
$settings[4]->fromArray(array(
	'key' => 'schedule.grid_schedules_fields'
	,'value' => '["id","resource","day","date","time","data"]'
	,'xtype' => 'textarea'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[5]= $modx->newObject('modSystemSetting');
$settings[5]->fromArray(array(
	'key' => 'schedule.parents'
	,'value' => '0'
	,'xtype' => 'textfield'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[6]= $modx->newObject('modSystemSetting');
$settings[6]->fromArray(array(
	'key' => 'schedule.render_data_tpl'
	,'value' => 'tpl.Schedule.col.data.mgr'
	,'xtype' => 'textfield'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);

$settings[7]= $modx->newObject('modSystemSetting');
$settings[7]->fromArray(array(
	'key' => 'schedule.resources'
	,'value' => ''
	,'xtype' => 'textfield'
	,'namespace' => 'schedule'
	,'area' => ''
),'',true,true);


return $settings;