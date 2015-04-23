;(function($){
    $(function(){
     
   		$(".submit_btn").on("click", function(){
           
            var file=$("#file").val();
            if(file==""||file=="请输入您的姓名"){
                $("#file").val("").addClass("error");
               	return false;   	
            }

            $.ajax({
                "url":"./Request.php",
                "type":"post",
                "data":{"model":"search","cardnum":file},
                "dataType":"json",
                "success":function(data){
                    if(data.code==1){
                        $(".error_con").html("签到成功");
                    }
                    if(data.code==2){
                        $(".error_con").html("请填写必填项");
                    }
                    if(data.code==3){
                        $(".error_con").html("找不到该用户");
                    }
                    if(data.code==4){
                        $(".error_con").html("该用户已经签过到了");
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
        	
            window.location.href="view.php?cardnum="+$("#content").val();
            
        });
  
    })
})(jQuery)