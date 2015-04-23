;(function($){
    $(function(){
     
   		$(".submit_btn").on("click", function(){
            alert(1)
            var file=$("#file").val();
            if(file==""||file=="请输入您的姓名"){
                alert(1)
            	$.ajax({
                    "url":"./Request.php",
                    "type":"post",
                    "data":{"model":"search","cardnum":"123"},
                    "dataType":"json",
                    "success":function(data){
                        alert(data.code)
                    }
                });
            	return false;
            }
        });

        $(".view_btn").on("click",function(){
        	window.location.href="view.php";
        })  
  
    })
})(jQuery)