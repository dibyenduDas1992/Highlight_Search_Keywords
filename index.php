<html>
    <head>
        <script type="text/javascript" src="jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $("#search_text").focus();

                $("#search_text").keyup(function () {
//                    $("#search_result").html($(this).val());
                    var value = $(this).val();
                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        async: true,
                        data: {sText: value},
                        success: function (reply) {
                            $("#search_result").html(reply);
                        }
                    });
                });
            });
        </script>
        <link rel="icon" href="search-icone-8222-128.ico">
        <style type="text/css">
            .search_text{
                height:30px;
                width: 250px;
                font-size: 15px;
            }
            .search_result{
                margin-top: 1%;
                padding-top: 10px;
                height: 85%;
                overflow-y: auto;
            }
            .input{
                height: 10%;
                width: 300px;
                padding-right: 2px;
            }
            .search_img{
                float: right;
                width: 40px;
                height: 70%;
                margin-top: -7px;
                padding-left: 3px;
            }
        </style>
    </head>
    <body>
        <div>
            <div class="input">
                <img src="search-icone-8222-128.png" class="search_img">
                <input type="text" id="search_text" class="search_text" placeholder="Search Test">
            </div>
        </div>
        <div id="search_result" class="search_result">

        </div>
    </body>
</html>
