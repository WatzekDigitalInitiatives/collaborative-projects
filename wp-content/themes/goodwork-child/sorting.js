jQuery(document).ready(function($) {

  //setup some CSS if we're looking at the project page
  var url = window.location.href;
  var host = window.location.host;
  if(url.indexOf('http://' + host + '/projects') != -1) {
    $( "#faculty" ).css( "text-align","center" );
    $( ".bio" ).hide();
    $( "h5" ).hide();
    $( ".rbTeam" ).removeClass( "clearfix");
    $( ".rbTeam" ).css({"display":"inline-block","padding":"10px","float":"none"});
    $( "#tagcloud" ).addClass( "hidden" );
    $( "#faculty" ).addClass( "hidden" );
    //$( "#items" ).css("display","block");
  }

  //show the tag cloud if sorting by tags
  $( "#sort_tags" ).click(function() {
    if ($( "#tagcloud" ).hasClass("hidden")){
      $( "#tagcloud" ).show();
      $( "#tagcloud" ).removeClass( "hidden" );
    }
    else {
      $( "#tagcloud" ).hide();
      $( "#tagcloud" ).addClass( "hidden" );
    }
  });

  //hide the tag cloud when a tag is chosen from the cloud
  $( "#tagcloud a" ).click(function() {
    $( "#tagcloud" ).hide();
  });

  //show the faculty list if sorting by faculty, and hide the items to save some space
  $( "#sort_faculty" ).click(function() {
    if ($( "#faculty" ).hasClass("hidden")){
      $( "#faculty" ).show();
      $( "#items" ).css( "display","none" );
      $( "#faculty" ).removeClass( "hidden" );
    }
    else {
      /*
      $( "#items" ).css( "display","block");
      $( "#faculty" ).hide();
      $( "#faculty" ).addClass( "hidden" );
      //window.location.href = "http://watzekdi.staging.wpengine.com/projects/";
      //$( "#items" ).show( "slow" );
      */

    }
  });

});
