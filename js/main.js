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
                        $("#msg").html("签到成功")
                        $("#msg").css("color","#00cc99");
                        $(".tips").slideDown("fast").fadeOut(5000);
                        $("#file").val("");
                    }else{
                        $("#msg").html(data.msg)
                        $("#msg").css("color","#f00000");
                        $(".tips").slideDown("fast").fadeOut(5000);
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
        	
            window.location.href="view.php?cardnum="+$("#content").val()+"&status="+$("#status").val();
            
        });
        
  
    })
})(jQuery)