$(document).ready(function() { 
  for (i = 0; i < sessionStorage.length; i++) { // Get all previous selected values from the session
    $('#'+sessionStorage.key(i)).val(sessionStorage.getItem(sessionStorage.key(i)));
    if($(" option[value="+sessionStorage.getItem(sessionStorage.key(i))+" ]").attr('data-color') != '') { // Set bg color of square
      $(".square_text").css("background-color",$(" option[value="+sessionStorage.getItem(sessionStorage.key(i))+" ]").attr('data-color'));
    }
  } 

  var profileVals = [];
  arrangeProfileValues();
  $("select").on("change", function() {
      if($(" option[value="+$(this).val()+" ]").attr('data-color') != '') { // Set bg color of square
        $(".square_text").css("background-color",$(" option[value="+$(this).val()+" ]").attr('data-color'));
      }
      
      $('span option').unwrap(); 
      sessionStorage.setItem($(this).attr('id'), $(this).val());
      arrangeProfileValues();      
  });
  
  /* Desc: Hide and show the options depends on the config
     Config sample: 11-1:1,2&&3:8;12-1:3&&3:8;13-1:1,2&&3:9
    */
  function arrangeProfileValues() {
    
      $("[id^=configurator_hidden_item_]" ).each(function() {
          var hiddenItems = this.value.split(";");
          $.each( hiddenItems, function( index, value ){
            var optionVal = value.split("-");
            if(optionVal[0] > 0) {  
              profileVals[optionVal[0]] = optionVal[1] ;
            }
            
          });
      });

      $.each( profileVals, function( index, value ){
        if(value != undefined ) {
          hideIfNotValid (index, value);
        }            
      });
  }

  function hideIfNotValid(index, value) 
  {
    var valOptions =  value.split("&&");
    $.each( valOptions, function( optionsindex, optionsvalue ){
      var  configVals  =  optionsvalue.split(":"); 
        if( $.inArray( $('#configurator_item_'+configVals[0]+' option:selected').val(), configVals[1]  ) != -1) { 
        } else { // Hide the option if not valid
           if($(" option[value=" + index + "]").parent().get( 0 ).tagName != 'SPAN')
             $(" option[value=" + index + "]").wrap('<span class="configurator_Profile"/>');
        }
    });
    
  }
    
});
