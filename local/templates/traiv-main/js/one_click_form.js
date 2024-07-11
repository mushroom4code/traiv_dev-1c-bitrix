/*(function(){

  $(document).ready(function() {
    $(getFormSelector()).submit(handleSubmit);
  });

  function handleSubmit(event){
    $(getFormSelector()).off('submit');
    event.preventDefault();
    loadResponseViaAjax();
  }

  function getFormSelector(){
    return "#callback-form";
  }

  function getFormAction(){
    return '/ajax/forms/one_click_form.php';
  }

  function fillFormBlock(data){
    $(getFormSelector()).html(data);
  }

  function loadResponseViaAjax() {
    var formData = $(getFormSelector()).serialize();
    var request = {};
    request.type = "POST";
    request.url = getFormAction();
    request.data = formData;
    request.success = function(response){
      fillFormBlock(response);
      $(getFormSelector()).submit(handleSubmit);
    };
    $.ajax(request);
  }

})();
*/