<html>
    <head>
        
</head>
<body>
    <form id="form2" action="/Src/ajax5tz.php?action=2" method="POST">
            имя
        </label>
        <input type="text" name="NAME_MY_AN" placeholder="Введите имя">
        <label>
            номер телефона
        </label>
        <input type="text" name="PHONE_MY_AN" placeholder="Введите телефон">
        <label>
            email
        </label>
        <input type="text" name="EMAIL_MY_AN" placeholder="Введите email">
        <label>
            комментарий
        </label>
        <input type="text" name="COMMMENT_MY_AN" placeholder="Коментарий">
        <input type="hidden" name="STATUS_MY_AN" value="57230590"><!--первый этап-->
        <input type="submit" value="Отправить">
    </form>
    <script type="text/javascript">
    (function(d, w, k) {
        w.introvert_callback = function() {
            try {
                w.II = new IntrovertIntegration(k);
            } catch (e) {console.log(e)}
        };

        var n = d.getElementsByTagName("script")[0],
            e = d.createElement("script");

        e.type = "text/javascript";
        e.async = true;
        e.src = "https://api.yadrocrm.ru/js/cache/"+ k +".js";
        n.parentNode.insertBefore(e, n);
    })(document, window, '3363f0c5');
    </script>
</body>
</html>