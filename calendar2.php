<html>
    <head>
        <link type="text/css" rel="stylesheet" href="global.css"/>
        <script type="text/javascript" src="calendar.js"></script>
        <script type="text/javascript">
            function init() {
                calendar.set("date");
            }
        </script>
    </head>

    <body onload="init()">
        <form action="sent.php" method="get">
            <input type="text" name="date" id="date" placeholder="Choose a date">
            <input type="submit" value="Send" name="btnSubmit">
        </form>
        
    </body>
</html>
