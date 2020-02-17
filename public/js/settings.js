$().ready(function () {
    $('form[data-name="settings-skills"]').on("submit", function (e) {
        let form = $(this);
        
        $.ajax(form.data("action"), {
            method  : form.prop('method'),
            dataType: "json",
            data    : form.serialize(),
            success : (res) => {
                if (res.status === "success") {
                    if (confirm("Запустить импорт данных?")) {
                        Parse.run();
                    }
                }
            },
            error   : (res) => {
            
            }
        });
        
        e.stopPropagation();
        e.preventDefault();
    });
    
    $('button[data-action="parse"]').on("click", () => {
        if (confirm("Запустить импорт данных?")) {
            Parse.run();
        }
    });
    
});