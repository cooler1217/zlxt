
function redirect(){
  try{
    var frame = document.getElementById("site_url");
    if(getOs()=="MSIE"){
      frame.style.cssText="margin-top:-22px;margin-left:-12px;";
      var height= (parseInt(window.screen.height)-190).toString() + "px";
    }else{
      frame.style.cssText="margin-top:-8px;margin-left:-12px;";
      var height= (parseInt(window.screen.height)-160).toString() + "px";
    }
    var width = (window.screen.width).toString() + "px";
    frame.width = width;
    frame.height = height;
  }
  catch(err)
  {
    locationHref("redirect");
  }
}
try{
  if(closeADB){
    redirect();
  }
}catch(err){
  locationHref("no_advise");
}