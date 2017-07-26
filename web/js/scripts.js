(function () {
   $('.my-messages .alert').on('close.bs.alert', function () {
      $(this);
      $.ajax({
         url: $(this).attr('datasrc'),
         dataType: "json"
      });
   });
})();

