<html>
    <head>
        <link href="/Src/js/styles/glDatePicker.default.css" rel="stylesheet" type="text/css">
        <link href="/Src/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class=wrapper>
            <img class="loader" src="/Src/images/progressbar.jpg"/>
            <form>
                <input type="text" id="mydate" gldp-id="mydate" />
                <div gldp-el="mydate"
                    style="width:400px; height:300px; position:absolute; top:70px; left:100px;">
                </div>
            </form>
        </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="/Src/js/glDatePicker.js"></script>

    <script type="text/javascript">
        $(window).load(function()
        {
            $.ajax({
                url: '/Src/ajax.php',
                method: 'get',
                dataType: 'json',
                data:{
                    N:5
                },
                success: function(dataObj){
                    $(".loader").addClass("hidden");
                    if(dataObj.result=="success")
                    {
                        console.log(dataObj);
                        data = dataObj.data;
                        let dates = [];
                        for(let key in data)
                        {
                            if(data[key]!==false)
                                dates.push({date:new Date(key)}); 
                        }
                        $('input').glDatePicker({
                            "selectableDates":dates
                        });
                    }
                    else
                    {
                        alert(dataObj.data)
                    }
                }
            });
        });
    </script>
</body>
</html>