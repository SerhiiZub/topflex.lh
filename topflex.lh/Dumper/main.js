/**
 * Created by serg on 09.06.17.
 */


function openbox(id){
    var display = id.style.display;
    if(display=='none'){
        id.style.display='block';
    }else{
        id.style.display='none';
    }
}

function showDumpInfo() {
    console.log(this);
}
function printLog(data) {
//            var data =
    var myWindow = window.open("", "MsgWindow", "width=600,height=600");
    myWindow.document.write(JSON.parse(data));
}
