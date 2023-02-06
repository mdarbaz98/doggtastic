//product
$('#product_form').validate({
  rules: {
    pro_name: 'required',
    desc: 'required',
    strn: { required: true },
    prc: { required: true },
    disc: {
      required: true,
    },
    link: {
      required: true,
    },
    category: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {},
  submitHandler: function (form) {
    $.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (data.includes("inserted")) {
          var id = data.substr(8);
          window.location.href = "product_update.php?id=" + id + "&status=add";
        } else {
          alert("Enter Valid " + data);
          $('#' + data).focus();
        }

      },
    })
  },
})

$('#updateProduct').validate({
  rules: {
    pro_name: 'required',
    desc: 'required',
    prc: { required: true },
    disc: {
      required: true,
    },
    category: {
      required: true,
    },
    subcategory: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {},
  submitHandler: function (form) {
    $.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if(data=='updated'){
          alert("Product Updated")
          window.location.reload();
        }        
      },
    })
  },
});

$('#user_form').validate({
  rules: {
    name: 'required',
    username: 'required',
    pwd: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {},
  submitHandler: function (form) {
    $.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if(data == 'inserted'){
          alert("User Added Successfully")
          window.location.reload();
        }
      },
    })
  },
})

$('#Updateuser').validate({
  rules: {
    name: 'required',
    username: 'required',
    pwd: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {},
  submitHandler: function (form) {
    $.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if(data == 'updated'){
          alert("User Updated Successfully")
          window.location.reload();
        }
      },
    })
  },
})
//
$('#addCategory').validate({
  rules: {
    category: 'required',
    title: 'required',
    content: { required: true },
    slug: { required: true },
    cat_name: {
      required: true,
    },
    desc: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {
    title: 'Please Enter  Title',
    category: 'Please Select Category',
    img_id: 'Select Image',
  },
  submitHandler: function (form) {
    alert('validated form')
    $.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        alert(data)
        console.log(data)
      },
    })
  },
})
// update category
$('#updateCategory').validate({
  rules: {
    category: 'required',
    title: 'required',
    content: { required: true },
    slug: { required: true },
    cat_name: {
      required: true,
    },
    desc: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {
    title: 'Please Enter  Title',
    category: 'Please Select Category',
    img_id: 'Select Image',
  },
  submitHandler: function (form) {
    alert('update validated form')
    $.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        alert(data)
        console.log(data)
      },
    })
  },
})