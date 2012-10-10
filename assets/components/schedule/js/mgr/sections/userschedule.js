Ext.onReady(function() {
    MODx.load({ xtype: 'schedule-page-userschedule'});
});

Schedule.page.userSchedule = function(config) {
    config = config || {};
    Ext.applyIf(config,{
		buttons: [{
			text: _('schedule.btnback'),
			id: 'schedule-btn-back',
			handler: function() {
				location.href = '?a=' + MODx.request.a + '&p=' + MODx.request.p;
			},
			scope: this
		}],
        components: [{
            xtype: 'schedule-panel-userschedule'
            ,renderTo: 'schedule-panel-userschedule-div'
			,uid: MODx.request.uid
        }]
    }); 
    Schedule.page.userSchedule.superclass.constructor.call(this,config);
};
Ext.extend(Schedule.page.userSchedule,MODx.Component);
Ext.reg('schedule-page-userschedule',Schedule.page.userSchedule);