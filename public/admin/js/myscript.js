//popupMsg of all type
function PupoMsg(title,msg,type,reload){
    swal(
       {title:title,
        text:msg,
        type:type,
        html:true,
        allowOutsideClick: false
       },
       function(){
        if(reload!="reload-no"){
          window.location.href=reload;
        }
       }
    );
}