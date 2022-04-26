function fill_searchMonitors(Value){
  $('#searchMonitors').val(Value);  

  $('#displayMonitors').hide();
}
function fill_searchLaptops(Value){
  $('#searchLaptops').val(Value);  

  $('#displayLaptops').hide();
}
function fill_searchHeadsets(Value){
  $('#searchHeadsets').val(Value);  

  $('#displayHeadsets').hide();
}
function fill_searchDesktops(Value){
  $('#searchDesktops').val(Value);  

  $('#displayDesktops').hide();
}
function fill_searchUPS(Value){
  $('#searchUPS').val(Value);  

  $('#displayUPS').hide();
}
function fill_searchKeyboards(Value){
  $('#searchKeyboards').val(Value);  

  $('#displayKeyboards').hide();
}
function fill_searchMice(Value){
  $('#searchMice').val(Value);  

  $('#displayMice').hide();
}
function fill_searchDockingStations(Value){
  $('#searchDockingStations').val(Value);  

  $('#displayDockingStations').hide();
}
function fill_searchPrinters(Value){
  $('#searchPrinters').val(Value);  

  $('#displayPrinters').hide();
}
function fill_searchUsers(Value){
  $('#searchUsers').val(Value);  

  $('#displayUsers').hide();
}
function fill_searchRegisteredDevices(Value){
  $('#searchRegisteredDevices').val(Value);  

  $('#displayRegisteredDevices').hide();
}
function fill_searchUnregisteredDevices(Value){
  $('#searchUnregisteredDevices').val(Value);  

  $('#displayUnregisteredDevices').hide();
}



// ----------------- FOR SHOWING MONITORS -----------------------//

$(document).ready(function(){
  // on pressing a key in the "searchbox" in "view.tables.php" file. call this function
  $("#searchMonitors").keyup(function(){

    //assigning searchMonitor box value to javascript variable tagID as "tagID".
    var tagID = $('#searchMonitors').val();
    // console.log("tagID is " + tagID + ".");

    //validating if tagID is empty
    if(tagID != ""){

      $.ajax({
        //ajax type is post
        type: "POST",

        //data will be sent to "class.filter-all-monitors.php".
        url: "../class.views/load-tables/load.all-monitors.php",

        //Data that will be sent to "load.all-monitors.php".
        data: {
          //assigning value of "tagID" to into "search" variable
          search: tagID
        },

        //if result is found, this function will be called
        success: function(html){
          //assigning result to displayMonitors div in "view.tables.php"
          $("#displayMonitors").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        //ajax type is post
        type: "POST",

        //data will be sent to "class.filter-all-monitors.php".
        url: "../class.views/load-tables/load.all-monitors.php",

        //Data that will be sent to "load.all-monitors.php".
        data: {
          load: 1
        },

        //if result is found, this function will be called
        success: function(html){
          //assigning result to displayMonitors div in "view.tables.php"
          $("#displayMonitors").html(html).show();
        }
      })
    }

  })
  

  $.ajax({
    //ajax type is post
    type: "POST",

    //data will be sent to "load.-monitors.php".
    url: "../class.views/load-tables/load.all-monitors.php",

    //Data that will be sent to "load.all-monitors.php".
    data: {
      load: 1
    },

    //if result is found, this function will be called
    success: function(html){
      //assigning result to displayMonitors div in "view.tables.php"
      $("#displayMonitors").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING LAPTOPS -----------------------//


$(document).ready(function(){
  $("#searchLaptops").keyup(function(){

    var tagID = $('#searchLaptops').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-laptops.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayLaptops").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-laptops.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayLaptops").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-laptops.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayLaptops").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING HEADSETS -----------------------//


$(document).ready(function(){
  $("#searchHeadsets").keyup(function(){

    var tagID = $('#searchHeadsets').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-headsets.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayHeadsets").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-headsets.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayHeadsets").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-headsets.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayHeadsets").html(html).show();
    }
  })

})




















































// ----------------- FOR SHOWING DESKTOPS -----------------------//


$(document).ready(function(){
  $("#searchDesktops").keyup(function(){

    var tagID = $('#searchDesktops').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-desktops.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayDesktops").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-desktops.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayDesktops").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-desktops.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayDesktops").html(html).show();
    }
  })

})

// ----------------- FOR SHOWING UPSs -----------------------//


$(document).ready(function(){
  $("#searchUPS").keyup(function(){

    var tagID = $('#searchUPS').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-UPS.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayUPS").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-UPS.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayUPS").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-UPS.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayUPS").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING KEYBOARDS -----------------------//


$(document).ready(function(){
  $("#searchKeyboards").keyup(function(){

    var tagID = $('#searchKeyboards').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-keyboards.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayKeyboards").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-keyboards.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayKeyboards").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-keyboards.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayKeyboards").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING MICE -----------------------//


$(document).ready(function(){
  $("#searchMice").keyup(function(){

    var tagID = $('#searchMice').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-mice.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayMice").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-mice.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayMice").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-mice.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayMice").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING DOCKING STATIONS -----------------------//


$(document).ready(function(){
  $("#searchDockingStations").keyup(function(){

    var tagID = $('#searchDockingStations').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-dockingstations.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayDockingStations").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-dockingstations.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayDockingStations").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-dockingstations.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayDockingStations").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING PRINTERS -----------------------//


$(document).ready(function(){
  $("#searchPrinters").keyup(function(){

    var tagID = $('#searchPrinters').val();

    if(tagID != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-printers.php",

        data: {
          search: tagID
        },

        success: function(html){
          $("#displayPrinters").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-printers.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayPrinters").html(html).show();
        }
      })
    }

  })
  // ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-printers.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayPrinters").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING USERS -----------------------//


$(document).ready(function(){
  $("#searchUsers").keyup(function(){

    var name = $('#searchUsers').val();

    if(name != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-users.php",

        data: {
          search: name
        },

        success: function(html){
          $("#displayUsers").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.all-users.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayUsers").html(html).show();
        }
      })
    }

  })
  //  ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.all-users.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayUsers").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING REGISTERED DEVICES -----------------------//


$(document).ready(function(){
  $("#searchRegisteredDevices").keyup(function(){

    var name = $('#searchRegisteredDevices').val();

    if(name != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.registered-devices.php",

        data: {
          search: name
        },

        success: function(html){
          $("#displayRegisteredDevices").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.registered-devices.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayRegisteredDevices").html(html).show();
        }
      })
    }

  })
  //  ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.registered-devices.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayRegisteredDevices").html(html).show();
    }
  })

})


// ----------------- FOR SHOWING UNREGISTERED DEVICES -----------------------//


$(document).ready(function(){
  $("#searchUnregisteredDevices").keyup(function(){

    var name = $('#searchUnregisteredDevices').val();

    if(name != ""){

      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.unregistered-devices.php",

        data: {
          search: name
        },

        success: function(html){
          $("#displayUnregisteredDevices").html(html).show();
        }
      })
    }else{ //search box is empty
      console.log("empty field");
      $.ajax({
        type: "POST",

        url: "../class.views/load-tables/load.unregistered-devices.php",

        data: {
          load: 1
        },

        success: function(html){
          $("#displayUnregisteredDevices").html(html).show();
        }
      })
    }

  })
  //  ---------------------------------------

  $.ajax({
    type: "POST",

    url: "../class.views/load-tables/load.unregistered-devices.php",

    data: {
      load: 1
    },

    success: function(html){
      $("#displayUnregisteredDevices").html(html).show();
    }
  })

})


































