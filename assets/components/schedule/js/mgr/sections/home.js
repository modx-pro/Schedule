Ext.onReady(function() {
    MODx.load({ xtype: 'schedule-page-home'});
});

Schedule.page.Home = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        components: [{
            xtype: 'schedule-panel-home'
            ,renderTo: 'schedule-panel-home-div'
        }]
    }); 
    Schedule.page.Home.superclass.constructor.call(this,config);
};
Ext.extend(Schedule.page.Home,MODx.Component);
Ext.reg('schedule-page-home',Schedule.page.Home);