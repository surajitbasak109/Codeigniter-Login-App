(function () {
   $('#password').keyup(function() {
      // set password variable
      var pswd = $(this).val();

      //validate the length
      if ( pswd.length < 6  ) {
         $('#length').removeClass('valid').addClass('invalid');
      } else {
         $('#length').removeClass('invalid').addClass('valid');
      }

      //validate letter
      if ( pswd.match(/[a-z]/)  ) {
          $('#letter').removeClass('invalid').addClass('valid');
      } else {
          $('#letter').removeClass('valid').addClass('invalid');
      }

      //validate capital letter
      if ( pswd.match(/[A-Z]/)  ) {
          $('#capital').removeClass('invalid').addClass('valid');
      } else {
          $('#capital').removeClass('valid').addClass('invalid');
      }

      //validate number
      if ( pswd.match(/\d/)  ) {
          $('#number').removeClass('invalid').addClass('valid');
      } else {
          $('#number').removeClass('valid').addClass('invalid');
      }

   }).focus(function() {
          $('#pswd_info').show();
   }).blur(function() {
          $('#pswd_info').hide();
   });

   $('#passconf').keyup(function() {
      // set password variable
      var pswdconf = $(this).val();
      var pswd = $('#password').val();

      //validate the length
      if (pswdconf != pswd) {
         $('#match').text('Password not matched.').removeClass('valid').addClass('invalid');
      } else {
         $('#match').text('Password matched.').removeClass('invalid').addClass('valid');
      }
   }).focus(function() {
          $('#pswdconf_info').show();
   }).blur(function() {
          $('#pswdconf_info').hide();
   });

   $('.select2').select2();
})();
