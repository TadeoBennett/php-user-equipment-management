//--------------------NAVBAR LINK ITEM ACTIVE STATES---------------------------//
  //changing the links and title between the sign up and sign in pages
  const content = document.querySelector('main');

  if (content.classList.contains('main-tables')) { //=---------------tables
    document.title = "Tables";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("tableslink");
    element.classList.add("active", "bg-gradient-primary");
  } else if (content.classList.contains('main-profile')) { //=---------------profile
    document.title = "Profile";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("profilelink");
    element.classList.add("active", "bg-gradient-primary");
  } else if (content.classList.contains('main-adddevice')) { //=---------------add device
    document.title = "Add Device";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("adddevicelink");
    element.classList.add("active", "bg-gradient-primary");
  } else if (content.classList.contains('main-editdevice')) { //=---------------edit device
    document.title = "Edit Device";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("editdevicelink");
    element.classList.add("active", "bg-gradient-primary");
  } else if (content.classList.contains('main-adduser')) { //=---------------add user
    document.title = "Add User";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("adduserlink");
    element.classList.add("active", "bg-gradient-primary");
  } else if (content.classList.contains('main-edituser')) { //=---------------edit user
    document.title = "Edit User";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("edituserlink");
    element.classList.add("active", "bg-gradient-primary");
  }else if (content.classList.contains('main-notifications')) { //=---------------edit user
    document.title = "Notifications";

    var element = document.querySelectorAll('.nav-link');
    element.forEach(item => {
      item.classList.remove('active');
    });

    var element = document.getElementById("notificationslink");
    element.classList.add("active", "bg-gradient-primary");
  }

