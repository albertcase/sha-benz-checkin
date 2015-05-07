;(function($){
    $(function(){
        LoadCount();
   		$(".submit_btn").on("click", function(){

           
            var file=$("#file").val();
            if(file==""||file=="请输入您的姓名"){
                $("#file").val("").addClass("error");
               	return false;   	
            }
            $(".loading").show();
            $.ajax({
                "url":"./Request.php",
                "type":"post",
                "data":{"model":"search","cardnum":file},
                "dataType":"json",
                "success":function(data){
                    $(".loading").hide();
                    if(data.code==1){
                        $("#msg").html("签到成功<br/>"+"用户名："+data.msg.name+"<br/>手机号："+data.msg.mobile+"<br/>类型："+data.msg.type);
                        $("#msg").css("color","#000");
                        $(".hello").html("您好，"+data.msg.name);
                        $(".tips").show();
                        $("#file").val("");
                        LoadCount();
                    }else{
                        $("#msg").html("<span class='space'>"+data.msg+"</span>");
                        $("#msg").css("color","#000");
                        $(".hello").html('');
                        $(".tips").show();
                        $("#file").val("");
                    }
                    
                    /*alert(data.msg);*/
                }
            });
        });
         $("#file").focus(function(){
            if($(this).attr('placeholder')=="请输入您的姓名"){
                $(this).val("");
                $(this).removeClass("error");
            }
        });
        /*$(".view_btn").on("click",function(){
        	window.location.href="view.php";
        });*/
        $(".search_btn").on("click",function(){
        	
            window.location.href="view.php?cardnum="+$("#content").val()+"&status="+$("#status").val()+"&type="+$("#type").val();
            
        });
        $(".check_btn").on("click",function(){
            
            window.location.href="view.php";
            
        });
        $(".confirm_btn").on("click",function(){
            $(".tips").hide();
        })
        $(".vistor").on("change",function(){
            
            $("#file").val($(this).val());
        })
        
  
    })
})(jQuery)


function LoadCount(){
    $.ajax({
        "url":"./Request.php",
        "type":"post",
        "data":{"model":"count"},
        "dataType":"json",
        "success":function(data){
            $("#count").html(data.msg)
        
        }
    });
}