$(document).ready(function () {
  $('#companyId').select2({
    tags:true,
    placeholder: "Our Registered Companies. Be one of them",
    allowClear: true
  });
  $('#appId').select2({
    placeholder: "CHOOSE OUR SOFTWARE APPLICATIONS"
  });
    var floatlabels = new FloatLabels('form', {
        // options go here,
        customEvent: null,
        customLabel: null,
        customPlaceholder: null,
        exclude: '.no-label',
        inputRegex: /email|number|password|search|tel|text|url/,
        prefix: 'fl-',
        prioritize: 'label',
        requiredClass: 'required',
        style: 1,
        transform: 'input, select, textarea',

    });
    var options = {"particles":{"number":{"value":400,"density":{"enable":true,"value_area":800}},"color": {"value": ["#BD10E0","#B8E986","#50E3C2","#FFD300","#E86363"]},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":3},"image":{"src":"img/github.svg","width":70,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":2,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":1.5782952832645452,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"repulse"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":false};
particlesJS("particle", options);
    //Register
    $(":input").inputmask();
    $('.response-div,.la-response-div').hide();
    $('.response-close,.la-response-close').click(function(){
      $('.response-div,.la-response-div').hide();
    });

    $('.btn-loader,.la-btn-loader').hide();
    var base_url = $('#base_url').val();
    $('body').on('click','.ca-btn',function(e){
      e.preventDefault();
      var firstname = $('#firstName').val();
      var lastname = $('#lastName').val();
      var mobile = $('#mobile').val();
      var password = $('#password').val();
      var email = $('#email').val();
      if(firstname == '' || lastname == '' || mobile == '' || password == '' || email == ''){
          $('.response-message').text('PLEASE FILL ALL FIELDS');
          $('.response-message').addClass('text-danger');
          $('.response-div').show();
      }else{
        var formdata = {
          "email":$('#email').val(),
          "password":$('#password').val(),
          "firstName":$('#firstName').val(),
          "lastName":$('#lastName').val(),
          "companyName":$('#companyName').val(),
          "canAddYN":$('#canAddYN').val(),
          "userType":$('#userType').val(),
          "createdBy":parseInt($('#createdBy').val()),
          "appId":$('#appId').val()
        };
        $.ajax({
          url:base_url+'api/user/register',
          type:'POST',
          data:JSON.stringify(formdata),
          beforeSend:function(){
            $('.btn-loader').show();
            $('.btn-text').text('PROCESSING');
            $('.ca-btn').attr('disabled',true);
          },
          error: function(xhr, httpStatusMessage, customErrorMessage) {
            if(xhr.status == false){
              alert(customErrorMessage);
            }
          },success:function(result){
            // console.log(result);
            if(result.status == true){
              $('.btn-loader').hide();
              $('.btn-text').text('GET STARTED NOW');
              $('.ca-btn').attr('disabled',false);
              $('.response-message').text(result.message);
              $('.response-message').addClass('text-success');
              $('.response-div').show();
              $("#appId").val('').trigger('change')
              $('#registerForm').trigger('reset');
              // $.toaster({ priority : 'success', message : result.message});
            }else if(result.status == false){
              $('.btn-loader').hide();
              $('.btn-text').text('GET STARTED NOW');
              $('.ca-btn').attr('disabled',false);
              $('.response-message').text(result.message);
              $('.response-message').addClass('text-danger');
              $('.response-div').show();
              // $.toaster({ priority : 'danger', message : result.message});
            }
          }
        });
      }
    });
    var vizytor_base_url = $('#vizytor_base_url').val();
    //Login
    $('body').on('click','.la-btn',function(e){
      e.preventDefault();
      var password = $('#password').val();
      var email = $('#email').val();
      if(password == '' || email == ''){
          $('.la-response-message').text('PLEASE FILL ALL FIELDS');
          $('.la-response-message').addClass('text-danger');
          $('.la-response-div').show();
      }else{
        var formdata = {
          "email":$('#email').val(),
          "password":$('#password').val()
        };
        $.ajax({
          url:base_url+'api/user/web/login',
          type:'POST',
          data:JSON.stringify(formdata),
          beforeSend:function(){
            $('.la-btn-loader').show();
            $('.la-btn-text').text('PROCESSING');
            $('.la-btn').attr('disabled',true);
          },
          error: function(xhr, httpStatusMessage, customErrorMessage) {
            if(xhr.status == false || xhr.status == 400){
              alert(customErrorMessage);
            }
          },success:function(result){
            console.log(result);
            if(result.status == true){
              $('.la-btn-loader').hide();
              $('.la-btn-text').text('LOGIN');
              $('.la-btn').attr('disabled',false);
              $('.la-response-message').text(result.message);
              $('.la-response-message').addClass('text-success');
              $('.la-response-div').show();
              $('#loginForm').trigger('reset');
              window.location.href = 'apps';
              // $.toaster({ priority : 'success', message : result.message});
            }else if(result.status == false){
              $('.la-btn-loader').hide();
              $('.la-btn-text').text('LOGIN');
              $('.la-btn').attr('disabled',false);
              $('.la-response-message').text(result.message);
              $('.la-response-message').addClass('text-danger');
              $('.la-response-div').show();
              // $.toaster({ priority : 'danger', message : result.message});
            }
          }
        });
      }
    });
    //Get All Companies
    $.ajax({
      url:base_url+'api/company/getall',
      type:'GET',
      success:function(result,status,xhr){
        // console.log(result);
        var companydata = result.data;
        companydata.forEach(function(obj){
          var optlist = `<option value="${obj.id}">${obj.name}</option>`;
          $('#companyId').append(optlist);
        }); 
      }
    });
    //Get All Apps
    $.ajax({
      url:base_url+'api/apps/getall',
      type:'GET',
      success:function(result,status,xhr){
        // console.log(result);
        var appdata = result.data;
        appdata.forEach(function(obj){
          var optlist = `<option value="${obj.appId}">${obj.appName}</option>`;
          $('#appId').append(optlist);
        }); 
      }
    });
});