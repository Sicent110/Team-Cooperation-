
function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "-";
    var seperator2 = ":";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
            + " " + date.getHours() + seperator2 + date.getMinutes()
            // + seperator2 + date.getSeconds();
    return currentdate;
} 


function findParent(ele, selector){
    var cur = ele;
}

function getTask(this_obj){
    var DOM=document.getElementsByClassName("dropdown");
    var ps = this_obj.parentsUntil(DOM);
    var p = ps.last();
    var task_content = p.find('textarea').val();

    var member_tags = p.find('input[type="checkbox"]');

    // var as = p.find('.add-actor');
    // var actorids = [];
    // for(var i=0;i<as.length;i++){
    //     var atag = as[i];
    //     actorids.push($(atag).attr('userid'));
    // }
    // actorids.push(2);

    var actorids = [];
    for(var i=0;i<member_tags.length;i++){
        var member_tag = member_tags[i];
        if (member_tag.checked){
            // console.log(member_tag)
            actorids.push(member_tag.value);
        }
    }

    return {
        'task_content': task_content,
        'actorids': actorids,
    }

}

function wipePlaceholder(){
    $(".button_pop_task_menu").next().find("textarea").innerHTML= "";

}

function modal_task_init(){
    // $(".modal_task").attr("onclick", getNowFormatDate());
}
function call_picker(){
    $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii'});
}


function setNoticeReaded(noticeId){
    $("#" + noticeId).slideUp();
    event.stopPropagation();
}
function get_now_stamp(){
    var timestamp = Date.parse(new Date());
    return timestamp/1000;
}
function str2stamp(strtime){
    var date = new Date(strtime);
    return date.getTime()/1000;

}

