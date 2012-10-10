var Schedule = function(config) {
    config = config || {};
    Schedule.superclass.constructor.call(this,config);
};
Ext.extend(Schedule,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},combo:{},config: {},view: {}
});
Ext.reg('schedule',Schedule);

Schedule = new Schedule();