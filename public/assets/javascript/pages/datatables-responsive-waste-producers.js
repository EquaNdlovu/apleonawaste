"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// DataTables Demo
// =============================================================
var DataTablesResponsiveDemo =
/*#__PURE__*/
function () {
  function DataTablesResponsiveDemo() {
    _classCallCheck(this, DataTablesResponsiveDemo);

    this.init();
  }

  _createClass(DataTablesResponsiveDemo, [{
    key: "init",
    value: function init() {
      // event handlers
      this.table = this.table();
    }
  }, {
    key: "table",
    value: function table() {
      $('#dt-responsive').DataTable({
        ajax: 'assets/data/waste_producers.json',
        //ajax: 'http://localhost/apleonawaste/assets/data/customers.json',
        responsive: true,
        order: [[2, 'asc']],
        // RowGroup: {
        //   dataSrc: 2
        // },
        dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>\n        <'table-responsive'tr>\n        <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>",
        language: {
          paginate: {
            previous: '<i class="fa fa-lg fa-angle-left"></i>',
            next: '<i class="fa fa-lg fa-angle-right"></i>'
          }
        },
        deferRender: true,
        columns: [{
          data: 'waste_producer_key',
          orderable: false,
          searchable: false
        }, {
          data: 'waste_producer_name'
        }, {
          data: 'waste_producer_customer'
        }, {
          data: 'waste_producer_country'
        }],
        rowGroup: {
          dataSrc: [
              'waste_producer_customer'
          ]
      },
       columnDefs: [{
        targets: 0,
        render: function render(data, type, row, meta) {
          return "<a class=\"btn btn-sm btn-icon btn-secondary\" href=\"Waste_Producers/edit/".concat(data, "\"><i class=\"fa fa-pencil-alt\"></i></a>\n");
        },
        }]
      });
    }
  }]);

  return DataTablesResponsiveDemo;
}();
/**
 * Keep in mind that your scripts may not always be executed after the theme is completely ready,
 * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
 */


$(document).on('theme:init', function () {
  new DataTablesResponsiveDemo();
});