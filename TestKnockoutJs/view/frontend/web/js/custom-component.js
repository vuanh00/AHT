define(['jquery', 'uiComponent', 'ko'], function ($, Component, ko) {
        'use strict';
        return Component.extend({
            defaults: {
                template: 'AHT_TestKnockoutJs/knockout-test'
            },
            initialize: function () {
                this.customerName = ko.observable('');
                this.customerData = ko.observable('');
                this._super();
            },
 
            addNewCustomer: function () {
                this.customerName(this.customerData());
                // this.customerData('');
            }
        });
    }
);