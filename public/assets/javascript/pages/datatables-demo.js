
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

// DataTables Demo
// =============================================================

  // Testing for different output of fields for Stryker
  var customer_group = document.getElementById('customer_group').value;
  if (customer_group == 'Stryker Ireland') {
    //alert(customer_group );
    var DataTablesDemo =
/*#__PURE__*/
function () {
  function DataTablesDemo() {
    _classCallCheck(this, DataTablesDemo);

    this.init();
  }
    
  _createClass(DataTablesDemo, [{
    key: "init",
    value: function init() {
      // event handlers
      this.table = this.table();
      this.searchRecords();
      this.selecter();
      this.clearSelected();
      //this.table2(); // add buttons

      this.table.buttons().container().appendTo('#dt-buttons').unwrap();
    }
  }, {
  
    key: "table",
    value: function table() {
      return $('#myTable').DataTable({
        dom: "<'text-muted'Bi>\n        <'table-responsive'tr>\n        <'mt-4'p>",
        buttons: ['copyHtml5', {
          extend: 'print',
          autoPrint: false
        }],
        language: {
          paginate: {
            previous: '<i class="fa fa-lg fa-angle-left"></i>',
            next: '<i class="fa fa-lg fa-angle-right"></i>'
          }
        },
        autoWidth: false,
        ajax: 'assets/data/jimmy.json',
        
        deferRender: true,
        order: [7, 'desc'],
        columns: [{
          data: 'collections_key',
          className: 'col-checker align-middle',
          orderable: false,
          searchable: false
        }, {
          data: 'collections_customer_country',
          className: "hide_column"
        }, {
          data: 'collections_customer_number',
          className: 'align-left'
        }, {
          data: 'collections_customer_site',
          className: 'align-left'
        }, {
          data: 'collections_workorder',
          className: "hide_column"
        }, {
          data: 'Customer_Waste_Producer',
          className: "hide_column"
        }, {
          data: 'collections_address',
          className: 'align-middle'
        }, {
          data: 'Colletion_Date',
          className: 'align-left'
        }, {
          data: 'Order_Status',
          className: 'align-left'
        }, {
          data: 'Material_Description',
          className: 'align-left'
        }, {
          data: 'Material_Detail',
          className: 'align-left'
        }, {
          data: 'Quantity',
          className: 'align-left'
        }, {
          data: 'Unit_of_Measure',
          className: 'align-left'
        }, {
          data: 'collections_quantity_not_kg',
          className: 'align-left'
        }, {
          data: 'collections_not_kg_UOM',
          className: 'align-left'
        }, {
          data: 'Indication_of_Danger',
          className: 'align-left'
        }, {
          data: 'Currency',
          className: 'align-left'
        }, {
          data: 'EWC',
          className: 'align-left'
        }, {
          data: 'Treatment_Cost',
          className: 'align-left'
        }, {
          data: 'Transport_Cost',
          className: 'align-left'
        }, {
          data: 'Packaging_Cost',
          className: 'align-left'
        }, {
          data: 'Other_Cost',
          className: 'align-left'
        }, {
          data: 'Total_Cost',
          className: 'align-left'
        }, {
          data: 'Waste_Vendor',
          className: 'align-left'
        }, {
          data: 'Waste_Collector',
          className: 'align-left'
        }, {
          data: 'Treatment_Facility',
          className: 'align-left'
        }, {
          data: 'Treatment_Method_Detail',
          className: 'align-left'
        },         {
          data: 'Container_Quantity',
          className: 'align-left'
        }, {
          data: 'Container_Type',
          className: 'align-left'
        }, {
          data: 'RD_Codes_Treatment',
          className: 'align-left'
        }, {
          data: 'colletions_WTF_number',
          className: 'align-left'
        }, {
          data: 'TFS_Number',
          className: 'align-left'
        }, {
          data: 'collections_cert_scan',
          render: function(data, type) {
            if (type === 'display') {
                //let link = "http://datatables.net";
                var str = "this,is,an,example";
                // if (data == null) {

                // } else {
                //   return '<a href="download?file=' + data + '">' + data + '</a>';
                // }
                if (data == null) {

                } else {
                  var array = data.split(',');
                  var arr = [];
                  for(var i = 0; i < array.length; i++)
                  {
                  //return '<a href="download?file=' + array[i] + '">' + array[i] + '</a><br/>';
                  arr.push('<a href="collections/download?file=' + array[i] + '">' + array[i] + '</a><br/>');
                  }
                  return data = arr.join("");
                }
            }
             
            return data;
        }
        },
        {
          data: 'collections_key',
          className: 'align-middle text-right',
          orderable: false,
          searchable: false
        }],
        columnDefs: [{
          targets: 33,
          render: function render(data, type, row, meta) {
            return "<div class=\"custom-control custom-control-nolabel custom-checkbox\">\n            <input type=\"checkbox\" class=\"custom-control-input\" name=\"selectedRow[]\" id=\"p".concat(row.collections_key, "\" value=\"").concat(row.collections_key, "\">\n            <label class=\"custom-control-label\" for=\"p").concat(row.collections_key, "\"></label>\n          </div>");
          }
        },  {
          targets: 0,
          render: function render(data, type, row, meta) {
            var Country = document.getElementById("tempCountry").innerHTML;
            return "<a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/edit".concat(Country,"/".concat(data, "\"><i class=\"fa fa-pencil-alt\"></i></a>\n         <a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/delete/")).concat(data, "\" onclick=\"confirmation(event)\"><i class=\"far fa-trash-alt\"></i></a>");
          }
        }]
      });
    }
  }, {
    key: "searchRecords",
    value: function searchRecords() {
      var self = this;
      $('#table-search, #filterBy').on('keyup change focus', function (e) {
        var filterBy = $('#filterBy').val();
        var hasFilter = filterBy !== '';
        var value = $('#table-search').val(); // clear selected rows

        if (value.length && (e.type === 'keyup' || e.type === 'change')) {
          self.clearSelectedRows();
        } // reset search term


        self.table.search('').columns().search('').draw();

        if (hasFilter) {
          self.table.columns(filterBy).search(value).draw();
        } else {
          self.table.search(value).draw();
        }
      });
    }
  }, {
    key: "getSelectedInfo",
    value: function getSelectedInfo() {
      var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
      var $info = $('.thead-btn');
      var $badge = $('<span/>').addClass('selected-row-info text-muted pl-1').text("".concat($selectedRow, " selected")); // remove existing info

      $('.selected-row-info').remove(); // add current info

      if ($selectedRow) {
        $info.prepend($badge);
      }
    }
  }, {
    key: "selecter",
    value: function selecter() {
      var self = this;
      $(document).on('change', '#check-handle', function () {
        var isChecked = $(this).prop('checked');
        $('input[name="selectedRow[]"]').prop('checked', isChecked); // get info

        self.getSelectedInfo();
      }).on('change', 'input[name="selectedRow[]"]', function () {
        var $selectors = $('input[name="selectedRow[]"]');
        var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
        var prop = $selectedRow === $selectors.length ? 'checked' : 'indeterminate'; // reset props

        $('#check-handle').prop('indeterminate', false).prop('checked', false);

        if ($selectedRow) {
          $('#check-handle').prop(prop, true);
        } // get info


        self.getSelectedInfo();
      });
    }
  }, {
    key: "clearSelected",
    value: function clearSelected() {
      var self = this; // clear selected rows

      $('#myTable').on('page.dt', function () {
        self.clearSelectedRows();
      });
      $('#clear-search').on('click', function () {
        self.clearSelectedRows();
      });
    }
  }, {
    key: "clearSelectedRows",
    value: function clearSelectedRows() {
      $('#check-handle').prop('indeterminate', false).prop('checked', false).trigger('change');
    }
  }]);

  return DataTablesDemo;
}();
/**
 * Keep in mind that your scripts may not always be executed after the theme is completely ready,
 * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
 */


$(document).on('theme:init', function () {
  new DataTablesDemo();
});

//Below is table info for Abbott Ireland
  } else if (customer_group == 'Abbott Ireland') {
    //alert("Hello! I am an alert box!!");
    var DataTablesDemo =
/*#__PURE__*/
function () {
  function DataTablesDemo() {
    _classCallCheck(this, DataTablesDemo);

    this.init();
  }

  _createClass(DataTablesDemo, [{
    key: "init",
    value: function init() {
      // event handlers
      this.table = this.table();
      this.searchRecords();
      this.selecter();
      this.clearSelected();
      //this.table(); // add buttons

      this.table.buttons().container().appendTo('#dt-buttons').unwrap();
    }
  }, {
    key: "table",
    value: function table() {
      return $('#myTable').DataTable({
        dom: "<'text-muted'Bi>\n        <'table-responsive'tr>\n        <'mt-4'p>",
        buttons: ['copyHtml5', {
          extend: 'print',
          autoPrint: false
        }],
        language: {
          paginate: {
            previous: '<i class="fa fa-lg fa-angle-left"></i>',
            next: '<i class="fa fa-lg fa-angle-right"></i>'
          }
        },
        autoWidth: false,
        ajax: 'assets/data/jimmy.json',
      
        deferRender: true,
        order: [7, 'desc'],
        columns: [{
          data: 'collections_key',
          className: 'col-checker align-middle',
          orderable: false,
          searchable: false
        }, {
          data: 'collections_customer_country',
          className: "hide_column"
        }, {
          data: 'collections_customer_number',
          className: 'align-left'
        }, {
          data: 'collections_customer_site',
          className: 'align-left'
        }, {
          data: 'collections_workorder',
          className: "hide_column"
        }, {
          data: 'Customer_Waste_Producer',
          className: "hide_column"
        }, {
          data: 'collections_address',
          className: 'align-middle'
        }, {
          data: 'Colletion_Date',
          className: 'align-left'
        }, {
          data: 'Order_Status',
          className: 'align-left'
        }, {
          data: 'Material_Description',
          className: 'align-left'
        }, {
          data: 'Material_Detail',
          className: 'align-left'
        }, {
          data: 'Quantity',
          className: 'align-left'
        }, {
          data: 'Unit_of_Measure',
          className: 'align-left'
        }, {
          data: 'collections_quantity_not_kg',
          className: 'align-left'
        }, {
          data: 'collections_not_kg_UOM',
          className: 'align-left'
        }, {
          data: 'Indication_of_Danger',
          className: 'align-left'
        }, {
          data: 'ENVision_Description',
          className: 'align-left'
        }, {
          data: 'ENVision_Disposal',
          className: 'align-left'
        }, {
          data: 'EWC',
          className: 'align-left'
        }, {
          data: 'Waste_Vendor',
          className: 'align-left'
        }, {
          data: 'Waste_Collector',
          className: 'align-left'
        }, {
          data: 'Treatment_Facility',
          className: 'align-left'
        }, {
          data: 'Treatment_Method_Detail',
          className: 'align-left'
        },         {
          data: 'Container_Quantity',
          className: 'align-left'
        }, {
          data: 'RD_Codes_Treatment',
          className: 'align-left'
        }, {
          data: 'colletions_WTF_number',
          className: 'align-left'
        }, 
        {
          data: 'collections_key',
          className: 'align-middle text-right',
          orderable: false,
          searchable: false
        }],
        columnDefs: [{
          targets: 26,
          render: function render(data, type, row, meta) {
            return "<div class=\"custom-control custom-control-nolabel custom-checkbox\">\n            <input type=\"checkbox\" class=\"custom-control-input\" name=\"selectedRow[]\" id=\"p".concat(row.collections_key, "\" value=\"").concat(row.collections_key, "\">\n            <label class=\"custom-control-label\" for=\"p").concat(row.collections_key, "\"></label>\n          </div>");
          }
        },  {
          targets: 0,
          render: function render(data, type, row, meta) {
            var Country = document.getElementById("tempCountry").innerHTML;
            return "<a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/edit".concat(Country,"/".concat(data, "\"><i class=\"fa fa-pencil-alt\"></i></a>\n         <a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/delete/")).concat(data, "\" onclick=\"confirmation(event)\"><i class=\"far fa-trash-alt\"></i></a>");
          }
        }]
      });
    }
  }, {
    key: "searchRecords",
    value: function searchRecords() {
      var self = this;
      $('#table-search, #filterBy').on('keyup change focus', function (e) {
        var filterBy = $('#filterBy').val();
        var hasFilter = filterBy !== '';
        var value = $('#table-search').val(); // clear selected rows

        if (value.length && (e.type === 'keyup' || e.type === 'change')) {
          self.clearSelectedRows();
        } // reset search term


        self.table.search('').columns().search('').draw();

        if (hasFilter) {
          self.table.columns(filterBy).search(value).draw();
        } else {
          self.table.search(value).draw();
        }
      });
    }
  }, {
    key: "getSelectedInfo",
    value: function getSelectedInfo() {
      var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
      var $info = $('.thead-btn');
      var $badge = $('<span/>').addClass('selected-row-info text-muted pl-1').text("".concat($selectedRow, " selected")); // remove existing info

      $('.selected-row-info').remove(); // add current info

      if ($selectedRow) {
        $info.prepend($badge);
      }
    }
  }, {
    key: "selecter",
    value: function selecter() {
      var self = this;
      $(document).on('change', '#check-handle', function () {
        var isChecked = $(this).prop('checked');
        $('input[name="selectedRow[]"]').prop('checked', isChecked); // get info

        self.getSelectedInfo();
      }).on('change', 'input[name="selectedRow[]"]', function () {
        var $selectors = $('input[name="selectedRow[]"]');
        var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
        var prop = $selectedRow === $selectors.length ? 'checked' : 'indeterminate'; // reset props

        $('#check-handle').prop('indeterminate', false).prop('checked', false);

        if ($selectedRow) {
          $('#check-handle').prop(prop, true);
        } // get info


        self.getSelectedInfo();
      });
    }
  }, {
    key: "clearSelected",
    value: function clearSelected() {
      var self = this; // clear selected rows

      $('#myTable').on('page.dt', function () {
        self.clearSelectedRows();
      });
      $('#clear-search').on('click', function () {
        self.clearSelectedRows();
      });
    }
  }, {
    key: "clearSelectedRows",
    value: function clearSelectedRows() {
      $('#check-handle').prop('indeterminate', false).prop('checked', false).trigger('change');
    }
  }]);

  return DataTablesDemo;
}();
/**
 * Keep in mind that your scripts may not always be executed after the theme is completely ready,
 * you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
 */


$(document).on('theme:init', function () {
  new DataTablesDemo();
});

//Below is table info for Workspace
} else if (customer_group == 'Workspace') {
  //alert("Hello! I am an alert box!!");
  var DataTablesDemo =
/*#__PURE__*/
function () {
function DataTablesDemo() {
  _classCallCheck(this, DataTablesDemo);

  this.init();
}

_createClass(DataTablesDemo, [{
  key: "init",
  value: function init() {
    // event handlers
    this.table = this.table();
    this.searchRecords();
    this.selecter();
    this.clearSelected();
    //this.table2(); // add buttons

    this.table.buttons().container().appendTo('#dt-buttons').unwrap();
  }
}, {
  key: "table",
  value: function table() {
    return $('#myTable').DataTable({
      dom: "<'text-muted'Bi>\n        <'table-responsive'tr>\n        <'mt-4'p>",
      buttons: ['copyHtml5', {
        extend: 'print',
        autoPrint: false
      }],
      language: {
        paginate: {
          previous: '<i class="fa fa-lg fa-angle-left"></i>',
          next: '<i class="fa fa-lg fa-angle-right"></i>'
        }
      },
      autoWidth: false,
      ajax: 'assets/data/jimmy.json',
    
      deferRender: true,
      order: [7, 'desc'],
      columns: [{
        data: 'collections_key',
        className: 'col-checker align-middle',
        orderable: false,
        searchable: false
      }, {
        data: 'collections_customer_country',
        className: "hide_column"
      }, {
        data: 'collections_customer_number',
        className: 'align-left'
      }, {
        data: 'collections_customer_site',
        className: 'align-left'
      }, {
        data: 'collections_workorder',
        className: "hide_column"
      }, {
        data: 'Customer_Waste_Producer',
        className: "hide_column"
      }, {
        data: 'collections_address',
        className: 'align-middle'
      }, {
        data: 'Colletion_Date',
        className: 'align-left'
      }, {
        data: 'Order_Status',
        className: 'align-left'
      }, {
        data: 'Material_Description',
        className: 'align-left'
      }, {
        data: 'Material_Detail',
        className: 'hide_column'
      }, {
        data: 'Quantity',
        className: 'align-left'
      }, {
        data: 'Unit_of_Measure',
        className: 'align-left'
      }, {
        data: 'collections_quantity_not_kg',
        className: 'align-left'
      }, {
        data: 'collections_not_kg_UOM',
        className: 'align-left'
      }, {
        data: 'Indication_of_Danger',
        className: 'align-left'
      }, {
        data: 'EWC',
        className: 'align-left'
      }, {
        data: 'Waste_Vendor',
        className: 'align-left'
      }, {
        data: 'Waste_Collector',
        className: 'align-left'
      }, {
        data: 'Treatment_Facility',
        className: 'align-left'
      }, {
        data: 'Treatment_Method_Detail',
        className: 'align-left'
      },         {
        data: 'Container_Quantity',
        className: 'align-left'
      }, {
        data: 'RD_Codes_Treatment',
        className: 'align-left'
      }, {
        data: 'colletions_WTF_number',
        className: 'align-left'
      }, 
      {
        data: 'collections_key',
        className: 'align-middle text-right',
        orderable: false,
        searchable: false
      }],
      columnDefs: [{
        targets: 24,
        render: function render(data, type, row, meta) {
          return "<div class=\"custom-control custom-control-nolabel custom-checkbox\">\n            <input type=\"checkbox\" class=\"custom-control-input\" name=\"selectedRow[]\" id=\"p".concat(row.collections_key, "\" value=\"").concat(row.collections_key, "\">\n            <label class=\"custom-control-label\" for=\"p").concat(row.collections_key, "\"></label>\n          </div>");
        }
      },  {
        targets: 0,
        render: function render(data, type, row, meta) {
          var Country = document.getElementById("tempCountry").innerHTML;
          return "<a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/edit".concat(Country,"/".concat(data, "\"><i class=\"fa fa-pencil-alt\"></i></a>\n         <a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/delete/")).concat(data, "\" onclick=\"confirmation(event)\"><i class=\"far fa-trash-alt\"></i></a>");
        }
      }]
    });
  }
}, {
  key: "searchRecords",
  value: function searchRecords() {
    var self = this;
    $('#table-search, #filterBy').on('keyup change focus', function (e) {
      var filterBy = $('#filterBy').val();
      var hasFilter = filterBy !== '';
      var value = $('#table-search').val(); // clear selected rows

      if (value.length && (e.type === 'keyup' || e.type === 'change')) {
        self.clearSelectedRows();
      } // reset search term


      self.table.search('').columns().search('').draw();

      if (hasFilter) {
        self.table.columns(filterBy).search(value).draw();
      } else {
        self.table.search(value).draw();
      }
    });
  }
}, {
  key: "getSelectedInfo",
  value: function getSelectedInfo() {
    var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
    var $info = $('.thead-btn');
    var $badge = $('<span/>').addClass('selected-row-info text-muted pl-1').text("".concat($selectedRow, " selected")); // remove existing info

    $('.selected-row-info').remove(); // add current info

    if ($selectedRow) {
      $info.prepend($badge);
    }
  }
}, {
  key: "selecter",
  value: function selecter() {
    var self = this;
    $(document).on('change', '#check-handle', function () {
      var isChecked = $(this).prop('checked');
      $('input[name="selectedRow[]"]').prop('checked', isChecked); // get info

      self.getSelectedInfo();
    }).on('change', 'input[name="selectedRow[]"]', function () {
      var $selectors = $('input[name="selectedRow[]"]');
      var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
      var prop = $selectedRow === $selectors.length ? 'checked' : 'indeterminate'; // reset props

      $('#check-handle').prop('indeterminate', false).prop('checked', false);

      if ($selectedRow) {
        $('#check-handle').prop(prop, true);
      } // get info


      self.getSelectedInfo();
    });
  }
}, {
  key: "clearSelected",
  value: function clearSelected() {
    var self = this; // clear selected rows

    $('#myTable').on('page.dt', function () {
      self.clearSelectedRows();
    });
    $('#clear-search').on('click', function () {
      self.clearSelectedRows();
    });
  }
}, {
  key: "clearSelectedRows",
  value: function clearSelectedRows() {
    $('#check-handle').prop('indeterminate', false).prop('checked', false).trigger('change');
  }
}]);

return DataTablesDemo;
}();
/**
* Keep in mind that your scripts may not always be executed after the theme is completely ready,
* you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
*/


$(document).on('theme:init', function () {
new DataTablesDemo();
});

// Below is table info for everyone except Stryker, Abbott & Workspace
} else {
  //alert("Hello! I am an alert box!!");
  var DataTablesDemo =
/*#__PURE__*/
function () {
function DataTablesDemo() {
  _classCallCheck(this, DataTablesDemo);

  this.init();
}

_createClass(DataTablesDemo, [{
  key: "init",
  value: function init() {
    // event handlers
    this.table = this.table();
    this.searchRecords();
    this.selecter();
    this.clearSelected();
    //this.table2(); // add buttons

    this.table.buttons().container().appendTo('#dt-buttons').unwrap();
  }
}, {
  key: "table",
  value: function table() {
    return $('#myTable').DataTable({
      dom: "<'text-muted'Bi>\n        <'table-responsive'tr>\n        <'mt-4'p>",
      buttons: ['copyHtml5', {
        extend: 'print',
        autoPrint: false
      }],
      language: {
        paginate: {
          previous: '<i class="fa fa-lg fa-angle-left"></i>',
          next: '<i class="fa fa-lg fa-angle-right"></i>'
        }
      },
      autoWidth: false,
      ajax: 'assets/data/jimmy.json',
    
      deferRender: true,
      order: [7, 'desc'],
      columns: [{
        data: 'collections_key',
        className: 'col-checker align-middle',
        orderable: false,
        searchable: false
      }, {
        data: 'collections_customer_country',
        className: "hide_column"
      }, {
        data: 'collections_customer_number',
        className: 'align-left'
      }, {
        data: 'collections_customer_site',
        className: 'align-left'
      }, {
        data: 'collections_workorder',
        className: "hide_column"
      }, {
        data: 'Customer_Waste_Producer',
        className: "hide_column"
      }, {
        data: 'collections_address',
        className: 'align-middle'
      }, {
        data: 'Colletion_Date',
        className: 'align-left'
      }, {
        data: 'Order_Status',
        className: 'align-left'
      }, {
        data: 'Material_Description',
        className: 'align-left'
      }, {
        data: 'Material_Detail',
        className: 'align-left'
      }, {
        data: 'Quantity',
        className: 'align-left'
      }, {
        data: 'Unit_of_Measure',
        className: 'align-left'
      }, {
        data: 'collections_quantity_not_kg',
        className: 'align-left'
      }, {
        data: 'collections_not_kg_UOM',
        className: 'align-left'
      }, {
        data: 'Indication_of_Danger',
        className: 'align-left'
      }, {
        data: 'EWC',
        className: 'align-left'
      }, {
        data: 'Waste_Vendor',
        className: 'align-left'
      }, {
        data: 'Waste_Collector',
        className: 'align-left'
      }, {
        data: 'Treatment_Facility',
        className: 'align-left'
      }, {
        data: 'Treatment_Method_Detail',
        className: 'align-left'
      },         {
        data: 'Container_Quantity',
        className: 'align-left'
      }, {
        data: 'RD_Codes_Treatment',
        className: 'align-left'
      }, {
        data: 'colletions_WTF_number',
        className: 'align-left'
      }, 
      {
        data: 'collections_key',
        className: 'align-middle text-right',
        orderable: false,
        searchable: false
      }],
      columnDefs: [{
        targets: 24,
        render: function render(data, type, row, meta) {
          return "<div class=\"custom-control custom-control-nolabel custom-checkbox\">\n            <input type=\"checkbox\" class=\"custom-control-input\" name=\"selectedRow[]\" id=\"p".concat(row.collections_key, "\" value=\"").concat(row.collections_key, "\">\n            <label class=\"custom-control-label\" for=\"p").concat(row.collections_key, "\"></label>\n          </div>");
        }
      },  {
        targets: 0,
        render: function render(data, type, row, meta) {
          var Country = document.getElementById("tempCountry").innerHTML;
          return "<a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/edit".concat(Country,"/".concat(data, "\"><i class=\"fa fa-pencil-alt\"></i></a>\n         <a class=\"btn btn-sm btn-icon btn-secondary\" href=\"collections/delete/")).concat(data, "\" onclick=\"confirmation(event)\"><i class=\"far fa-trash-alt\"></i></a>");
        }
      }]
    });
  }
}, {
  key: "searchRecords",
  value: function searchRecords() {
    var self = this;
    $('#table-search, #filterBy').on('keyup change focus', function (e) {
      var filterBy = $('#filterBy').val();
      var hasFilter = filterBy !== '';
      var value = $('#table-search').val(); // clear selected rows

      if (value.length && (e.type === 'keyup' || e.type === 'change')) {
        self.clearSelectedRows();
      } // reset search term


      self.table.search('').columns().search('').draw();

      if (hasFilter) {
        self.table.columns(filterBy).search(value).draw();
      } else {
        self.table.search(value).draw();
      }
    });
  }
}, {
  key: "getSelectedInfo",
  value: function getSelectedInfo() {
    var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
    var $info = $('.thead-btn');
    var $badge = $('<span/>').addClass('selected-row-info text-muted pl-1').text("".concat($selectedRow, " selected")); // remove existing info

    $('.selected-row-info').remove(); // add current info

    if ($selectedRow) {
      $info.prepend($badge);
    }
  }
}, {
  key: "selecter",
  value: function selecter() {
    var self = this;
    $(document).on('change', '#check-handle', function () {
      var isChecked = $(this).prop('checked');
      $('input[name="selectedRow[]"]').prop('checked', isChecked); // get info

      self.getSelectedInfo();
    }).on('change', 'input[name="selectedRow[]"]', function () {
      var $selectors = $('input[name="selectedRow[]"]');
      var $selectedRow = $('input[name="selectedRow[]"]:checked').length;
      var prop = $selectedRow === $selectors.length ? 'checked' : 'indeterminate'; // reset props

      $('#check-handle').prop('indeterminate', false).prop('checked', false);

      if ($selectedRow) {
        $('#check-handle').prop(prop, true);
      } // get info


      self.getSelectedInfo();
    });
  }
}, {
  key: "clearSelected",
  value: function clearSelected() {
    var self = this; // clear selected rows

    $('#myTable').on('page.dt', function () {
      self.clearSelectedRows();
    });
    $('#clear-search').on('click', function () {
      self.clearSelectedRows();
    });
  }
}, {
  key: "clearSelectedRows",
  value: function clearSelectedRows() {
    $('#check-handle').prop('indeterminate', false).prop('checked', false).trigger('change');
  }
}]);

return DataTablesDemo;
}();
/**
* Keep in mind that your scripts may not always be executed after the theme is completely ready,
* you might need to observe the `theme:load` event to make sure your scripts are executed after the theme is ready.
*/


$(document).on('theme:init', function () {
new DataTablesDemo();
});
} 



