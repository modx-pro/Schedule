Schedule.grid.Resources = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		id: 'schedule-grid-resources'
		,url: Schedule.config.connector_url
		,baseParams: {
			action: 'mgr/resources/getlist'
			,parents: Schedule.config.parents
			,resources: Schedule.config.resources
		}
		,fields: Schedule.config.grid_resources_fields()
		,autoHeight: true
		,paging: true
		,remoteSort: true
		,columns: Schedule.config.grid_resources_columns()
		,tbar: ['->'
		,{
			xtype: 'textfield'
			,name: 'search'
			,id: 'resources-search'
			,emptyText: _('search')
			,listeners: {
				'change': {fn:this.search,scope:this}
				,'render': {fn:function(tf) {tf.getEl().addKeyListener(Ext.EventObject.ENTER,function() {this.search(tf);},this);},scope:this}
			}
		},{
			xtype: 'button'
			,id: 'resources-filter-clear'
			,text: _('filter_clear')
			,listeners: {'click': {fn: this.clearFilter, scope: this}}
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateSchedule(grid, e, row);
			}
		}
	});
	Schedule.grid.Resources.superclass.constructor.call(this,config);
};
Ext.extend(Schedule.grid.Resources,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
		var m = [];
		m.push({
			text: _('update')
			,handler: this.updateSchedule
		});
		m.push('-');
		m.push({
			text: _('view')
			,handler: this.viewResource
		});
		/*
		m.push({
			text: _('update')
			,handler: this.editResource
		});
		*/
		this.addContextMenuItem(m);
	}
	,updateSchedule: function(btn, e, row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}
		var res = this.menu.record.id;
		
		var tab = Ext.getCmp('resource-tab-'+res)
		if (typeof(tab) == 'undefined') {
			tab = Ext.getCmp('schedule-home-tabs').add({
				title: this.menu.record.pagetitle
				,id: 'resource-tab-'+res
				,closable: true
				,items: [{
					html: _('schedule.schedule_desc')
					,border: false
				},{
					xtype: 'schedule-grid-schedules'
					,id: 'schedule-grid-'+res
					,resource: res
				}]
			})
		}
		tab.show()
	}
	,viewResource: function(btn, e) {
		if (!this.menu.record || !this.menu.record.url) return false;
		window.open(this.menu.record.url);
	}
	,editResource: function(btn, e) {
		if (!this.menu.record || !this.menu.record.id) return false;
		window.open('?a=30&id=' + this.menu.record.id);
	}
	,search: function(tf,nv,ov) {
		this.getStore().setBaseParam('search',tf.getValue());
		this.getBottomToolbar().changePage(1);
		this.refresh();
	}
	,clearFilter: function() {
		this.getStore().baseParams = {
			action: 'mgr/resources/getlist',
			parent: MODx.request.p
		};
		Ext.getCmp('resources-search').reset();
		this.getBottomToolbar().changePage(1);
		this.refresh();
	}
});
Ext.reg('schedule-grid-resources',Schedule.grid.Resources);







Schedule.grid.Schedules = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		id: 'schedule-grid-schedules'
		,url: Schedule.config.connector_url
		,baseParams: {
			action: 'mgr/schedule/getlist'
			,resource: config.resource || 0
		}
		,fields: Schedule.config.grid_schedules_fields()
		,paging: true
		,anchor: '99%'
		,pageSize: Math.round(MODx.config.default_per_page / 2)
		,columns: Schedule.config.grid_schedules_columns()
		,tbar: [{
			text: _('create')
			,handler: this.addRecord
		}]
		,listeners: {
			rowDblClick: function(grid, rowIndex, e) {
				var row = grid.store.getAt(rowIndex);
				this.updateRecord(grid, e, row);
			}
		}
	});
	Schedule.grid.Schedules.superclass.constructor.call(this,config)
};
Ext.extend(Schedule.grid.Schedules,MODx.grid.Grid,{
	remove: function() {}	// Grid onremove fix

	,getMenu: function() {
		var m = [
			 {text: _('update'),handler: this.updateRecord}
			,'-'
			,{text: _('delete'),handler: this.deleteRecord}
		];
		this.addContextMenuItem(m);
		return true;
	}
	,addRecord: function(btn,e) {
		w = MODx.load({
			xtype: 'schedule-window-addrecord'
			,resource: this.config.resource
			,baseParams: {
				action: 'mgr/schedule/create'
				,resource: this.config.resource
			}
			,listeners: {
				'success': {fn:function() { this.refresh(); },scope:this}
				,'hide': {fn:function() { this.getEl().remove(); this.destroy();}}
			}
		});
		w.reset();
		w.setTitle(_('create')).show(e.target);
	}
	,updateRecord: function(btn,e, row) {
		if (typeof(row) != 'undefined') {this.menu.record = row.data;}

		MODx.Ajax.request({
			url: Schedule.config.connector_url
			,params: {
				action: 'mgr/schedule/get'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function(r) {
					var record = r.object;
					w = MODx.load({
						xtype: 'schedule-window-addrecord'
						,id: 'schedule-window-addrecord-'+this.menu.record.id
						,baseParams: {
							action: 'mgr/schedule/update'
							,id: this.menu.record.id
						}
						,listeners: {
							'success': {fn:function() { this.refresh(); },scope:this}
							,'hide': {fn:function() { this.getEl().remove(); this.destroy();}}
						}
					});
					var f = Ext.getCmp('schedule-window-addrecord-'+this.menu.record.id);
					f.reset();
					f.setValues(record)
					w.setTitle(_('update')).show(e.target);
				},scope:this}
			}
		});
	}
	,deleteRecord: function(btn,e) {
		if (!this.menu.record) return false;
		
		MODx.Ajax.request({
			url: Schedule.config.connector_url
			,params: {
				action: 'mgr/schedule/delete'
				,id: this.menu.record.id
			}
			,listeners: {
				'success': {fn:function() {
					this.refresh();
				},scope:this}
			}
		});
	}
});
Ext.reg('schedule-grid-schedules',Schedule.grid.Schedules);


Schedule.window.addRecord = function(config) {
	config = config || {};
	Ext.applyIf(config,{
		title: _('create')
		,url: Schedule.config.connector_url
		,baseParams: {
			action: 'mgr/schedule/create'
			,resource: config.resource
		}
		,width: 700
		,labelWidth: 200
		,modal: true
		,labelAlign: 'left'
		,fields: Schedule.config.form_fields()
	});
	
	Schedule.window.addRecord.superclass.constructor.call(this, config);
};
Ext.extend(Schedule.window.addRecord, MODx.Window);
Ext.reg('schedule-window-addrecord', Schedule.window.addRecord);