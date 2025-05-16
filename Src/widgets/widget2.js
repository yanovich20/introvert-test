widgetNameIntr = function () {
    var widget = this;
    this.code = null;

    this.yourVar = {};
       
    this.myNewContactProcessor = function(type){
        
        let contact=[];
        contact = $("input[data-type='" + type + "']:not(.proceeded)");
        contact.addClass("proceeded"); 
        
        contact.closest(".js-linked-with-actions").find(".js-tip-holder")
            .find(".js-tip-items").append(
                `<div class="tips-item js-tips-item js-cf-actions-item " data-type="search" data-id="" data-forced="" data-value="" data-suggestion-type="">
                  <span class="tips-icon-container">
                  <span class="tips-icon icon icon-inline icon-search"></span>
                </span>
               Загуглить
            </div>`
            );
        if(window.location.href.indexOf("contacts")!==-1||window.location.href.indexOf("companies")!==-1){
            let debug = contact.closest(".linked-form__multiple-container").on("click", ".js-linked-with-actions[data-pei-code='" + type + "'] .tips-item[data-type='search']", function () {
            window.open("http://letmegooglethat.com/?q=" + $(this).closest(".linked-form__field__value").find("input[data-type='" + type + "']").val(), "_blank");
            window.open("https://yandex.ru/search/?text=" + $(this).closest(".linked-form__field__value").find("input[data-type='" + type + "']").val(), "_blank");
        });
        }
        else{
           contact.closest(".linked-form__fields").on("click", ".js-linked-with-actions[data-pei-code='" + type + "'] .tips-item[data-type='search']", function () {
            window.open("http://letmegooglethat.com/?q=" + $(this).closest(".linked-form__field__value").find("input[data-type='" + type + "']").val(), "_blank");
            window.open("https://yandex.ru/search/?text=" + $(this).closest(".linked-form__field__value").find("input[data-type='" + type + "']").val(), "_blank");
        });
        }
    }
    // вызывается один раз при инициализации виджета, в этой функции мы вешаем события на $(document)
    this.bind_actions = function () {
        let self = this;
        $("body").on("click",".linked-form__field__link-wrapper",function(){
            self.myNewContactProcessor('phone');
            self.myNewContactProcessor('email');
        });
        this.myNewContactProcessor('phone');
        this.myNewContactProcessor('email');
    };

    // вызывается каждый раз при переходе на страницу
    this.render = function () {
      
    };

    // вызывается один раз при инициализации виджета, в этой функции мы загружаем нужные данные, стили и.т.п
    this.init = function () {

    };

    // метод загрузчик, не изменяется
    this.bootstrap = function (code) {
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
