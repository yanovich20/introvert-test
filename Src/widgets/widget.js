widgetNameIntr = function() {
    var widget = this;
    this.code = null;

    this.yourVar = {};
    this.yourFunc = function() {};

    // вызывается один раз при инициализации виджета, в этой функции мы вешаем события на $(document)
    this.bind_actions = function(){
        //пример $(document).on('click', 'selector', function(){});
    };

    // вызывается каждый раз при переходе на страницу
    this.render = function() {
        let cell = $(".pipeline_status.pipeline_cell:not(.h-hidden)")[2];
        if(!cell)
            return;
        let line = $(cell).find(".pipeline_status__head_line");
        if(line.length === 0)
            return;
        let color = line[0].style.background;
        $(cell).find(".pipeline_status__head_title").css("color",color);
        setTimeout(function(){
            console.log("debug");
            $(cell).find(".pipeline_status__head_info__count").css("color",color);
            $(cell).find(".pipeline_status__head_info__sum").css("color",color);
        },15000);
    };

    // вызывается один раз при инициализации виджета, в этой функции мы загружаем нужные данные, стили и.т.п
    this.init = function(){
/*       let cell = $(".pipeline_status.pipeline_cell:not(.h-hidden)")[2];
        if(!cell)
            return;
        let line = $(cell).find(".pipeline_status__head_line");
        if(line.length === 0)
            return;
        let color = line[0].style.background;
        console.log("color is");
        console.log("color",color);
        $(cell).find(".pipeline_status__head_title").css("color",color);
        $(cell).find(".pipeline_status__head_info__count").css("color",color);
        $(cell).find(".pipeline_status__head_info__sum").css("color",color); */
        
    };

    // метод загрузчик, не изменяется
    this.bootstrap = function(code) {
        widget.code = code;
        // если frontend_status не задан, то считаем что виджет выключен
        // var status = yadroFunctions.getSettings(code).frontend_status;
        var status = 1;

        if (status) {
            widget.init();
            widget.render();
            widget.bind_actions();
            $(document).on('widgets:load', function () {
                widget.render();
            });
        }
    }
};
// создание экземпляра виджета и регистрация в системных переменных Yadra
// widget-name - ИД и widgetNameIntr - уникальные названия виджета
yadroWidget.widgets['widget-name'] = new widgetNameIntr();
yadroWidget.widgets['widget-name'].bootstrap('widget-name');
