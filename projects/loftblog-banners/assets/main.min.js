$(window).ready(function(){
  var app = {

        init: function () {
            this.listen();
            this.updateCSSResult();
            this.updateHtmlResult();
        },

        listen: function () {
            $('#border-radius').on('change', $.proxy(this.changeBorderRadius, this));
            $('#border-width').on('change', $.proxy(this.changeBorderWidth, this));
            $('#button-text').on('keyup', $.proxy(this.changeText, this));
            $('#result_form').on('submit', app.sendForm);
        },

        preview: $('.button-preview'),

        //Changing border-radius
        changeBorderRadius: function() {
            var newBorderRadius = $('#border-radius').val();
            this.preview.css(
                'border-radius', newBorderRadius + 'px'
            );
            this.updateCSSResult();
        },

        //Changing border-size
      changeBorderWidth: function() {
            var newBorderWidth = $('#border-width').val();
          this.preview.css(
              'border-width', newBorderWidth + 'px'
          );
          console.log(newBorderWidth);
            this.updateCSSResult();
        },

        //Changing text
      changeText: function() {
            this.preview.text($('#button-text').val());
            this.updateHtmlResult();
        },

        //Update result
      updateCSSResult: function() {
          var borderRadius = this.preview.css('border-top-left-radius'),
              borderWidth = this.preview.css('border-width'),
              cssResult = $('#cssResult');

          cssResult.text(
              '.button-preview {\n' +
              'border-width: '          + borderRadius + ';\n' +
              'border-size: '           + borderWidth + ';\n' +
              'background: '           + '#E0E0E0' + ';\n' +
              'color: '           + '#2B3B6D' + ';\n' +
              'padding: '           + '3px 10px' + ';\n' +
              'border-color: '           + borderWidth + ';\n' +
              'font-size: '           + '18px' + ';\n' +
              '}'
          );

        },

      //Динамическое изменение html textarea
      updateHtmlResult: function(){
          var htmlCodeResultArea = $('#htmlResult');

          htmlCodeResultArea.text(
              '<button class="button-preview">'+ $('#button-text').val() +'</button>'
          );
      },

      sendForm: function(){

        //Send form start
          var htmlResult = $('#htmlResult').html()+' ';
          var cssResult = $('#cssResult');
          var senderEmail = $('#sender-email');

          var data = 'htmlResult=' + encodeURIComponent(htmlResult) + '&cssResult=' + encodeURIComponent(cssResult.html()) + '&senderEmail=' + senderEmail.val();

          $.ajax({

              url: "send_email.php",
              type: "POST",
              data: data,
              cache: false,

              success: function(html) {
                  $('#send-form').attr('value', 'Okay, sent! Check your mail.');
              }
          });

          return false;
        //Send form finish
      }

    }

    app.init();
});
