Schedule.panel.Home = function(config) {
	config = config || {};
	Ext.apply(config,{
		border: false
		,baseCls: 'modx-formpanel'
		,items: [{
			html: '<h2>'+_('schedule')+'</h2>'
			,border: false
			,cls: 'modx-page-header container'
		},{
			xtype: 'modx-tabs'
			,id: 'schedule-home-tabs'
			,bodyStyle: 'padding: 10px'
			,defaults: { border: false ,autoHeight: true }
			,border: true
			,activeItem: 0
			,hideMode: 'offsets'
			,items: [{
				title: _('schedule.resources')
				,items: [{
					html: _('schedule.resources_desc')
					,border: false
				},{
					xtype: 'schedule-grid-resources'
					,preventRender: true
				}]
			}]
		}]
	});
	Schedule.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(Schedule.panel.Home,MODx.Panel);
Ext.reg('schedule-panel-home',Schedule.panel.Home);





/****************************/
Schedule.renderDay = function(day) {
	days = [_('schedule.mon'),_('schedule.tue'),_('schedule.wed'),_('schedule.thu'),_('schedule.fri'),_('schedule.sat'),_('schedule.sun')];
	return days[day-1];
}

/****************************/
MODx.combo.days = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		name: 'day'
		,id: 'schedule-combo-days'
		,hiddenName: 'day'
		,displayField: 'day'
		,valueField: 'id'
		,fields: ['day','id']
		,emptyText: _('schedule.select')
		,mode: 'local'
        ,store: new Ext.data.SimpleStore({
            fields: ['day','id']
            ,data: [
				[_('schedule.mon'),1]
				,[_('schedule.tue'),2]
				,[_('schedule.wed'),3]
				,[_('schedule.thu'),4]
				,[_('schedule.fri'),5]
				,[_('schedule.sat'),6]
				,[_('schedule.sun'),7]
			]
        })
	});
	MODx.combo.days.superclass.constructor.call(this,config);
};
Ext.extend(MODx.combo.days,MODx.combo.ComboBox);
Ext.reg('schedule-combo-days',MODx.combo.days);


MODx.combo.resources = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		name: 'resource'
		,hiddenName: 'resource'
		,displayField: 'pagetitle'
		,valueField: 'id'
		,fields: ['id','pagetitle']
		,pageSize: 10
		,emptyText: _('schedule.select')
		,url: Schedule.config.connector_url
		,baseParams: {
			action: 'mgr/resources/getlist'
			,parents: 0
			,resources: 0
		}
	});
	MODx.combo.resources.superclass.constructor.call(this,config);
};
Ext.extend(MODx.combo.resources,MODx.combo.ComboBox);
Ext.reg('schedule-combo-resources',MODx.combo.resources);