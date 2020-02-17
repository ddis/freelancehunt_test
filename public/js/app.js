let App   = {
    getCookie(name) {
        let matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : null;
    },
    
    setCookie(name, value, options = {}) {
        
        options = {
            path: '/',
            // при необходимости добавьте другие значения по умолчанию
            ...options
        };
        
        if (options.expires instanceof Date) {
            options.expires = options.expires.toUTCString();
        }
        
        let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);
        
        for (let optionKey in options) {
            updatedCookie += "; " + optionKey;
            let optionValue = options[optionKey];
            if (optionValue !== true) {
                updatedCookie += "=" + optionValue;
            }
        }
    },
    
    _checkIsInstall() {
        let result = false;
        
        $.ajax("/install/check-install-system", {
            method  : "GET",
            dataType: "json",
            async   : false,
            success : function (res) {
                result = res.isInstalled;
            }
        });
        
        return result;
    }
};
let Parse = {
    run: () => {
        $.ajax("/import/start", {
            method  : "GET",
            dataType: "JSON",
            success : (res) => {
                if (res.status === "success") {
                
                }
            }
        });
        
        setTimeout(() => {
            Parse.showModal();
            Parse.check();
        }, 500);
    },
    
    showModal() {
        if ($("#parse-progress").length > 0) {
            $("#parse-progress").modal("show");
        } else {
            $.ajax("/dynamic/modals/import-progress", {
                method  : "GET",
                dataType: "json",
                success : (res) => {
                    $(".content").append(res.html);
                    $(".parse-progress").modal('show');
                }
            });
        }
    },
    
    hideModal() {
        if ($("#parse-progress").is(":visible")) {
            window.location.href = "/projects";
        }
        $("#parse-progress").modal("hide");
    },
    
    check: () => {
        $.ajax("/import/check", {
            method  : "GET",
            dataType: "json",
            success : (res) => {
                if (res.status === "success") {
                    Parse.hideModal();
                } else {
                    Parse.showModal();
                    setTimeout(() => {
                        Parse.check();
                    }, 1000);
                }
            }
        });
    }
};
// setCookie('user', 'John', {secure: true, 'max-age': 3600});

$().ready(function () {
    if (!App.getCookie("isInstalled") && !App._checkIsInstall()) {
        $.ajax("/dynamic/modals/install", {
            method  : "GET",
            dataType: "json",
            success : (res) => {
                $(".content").append(res.html);
                $(".modal").modal('show');
            }
        });
        
        $('.content').on("click", 'div[data-modal-name="install"] button', () => {
            let Promises = [];
            
            $('div[data-modal-name="install"] img').show();
            $('div[data-modal-name="install"] button').hide();
            
            $('div[data-modal-name="install"] form').each((i, value) => {
                let url  = $(value).data("action");
                let data = $(value).serialize();
                
                Promises.push(
                    new Promise((resolve, rejected) => {
                        $.ajax(url, {
                            method  : $(value).prop("method"),
                            data    : data,
                            dataType: "JSON",
                            dataType: "JSON",
                            success : (res) => {
                                if (res.status === "success") {
                                    resolve(res);
                                } else {
                                    res.formName = $(value).data("name");
                                    rejected(res);
                                }
                            },
                            error   : (res) => {
                                res.responseJSON.formName = $(value).data("name");
                                rejected(res.responseJSON);
                            }
                        });
                    })
                );
            });
            
            Promise.all(Promises).then(r => {
                $.ajax('/install/finish', {
                    method  : "POST",
                    dataType: "JSON",
                    success : (res) => {
                        if (res.status === "success") {
                            window.location.href = "/settings";
                        } else {
                            $('div[data-modal-name="install"] img').hide();
                            $('div[data-modal-name="install"] button').show();
                        }
                    },
                    error   : (res) => {
                        $('div[data-modal-name="install"] img').hide();
                        $('div[data-modal-name="install"] button').show();
                    }
                });
            }).catch(r => {
                let str = "";
                
                for (let index in r.error) {
                    str += r.error[index][0] + "\n";
                }
                
                if (str.length == 0) {
                    str = r.message;
                }
                
                alert(str);
                
                $('div[data-modal-name="install"] img').hide();
                $('div[data-modal-name="install"] button').show();
            });
        });
    }
    
    Parse.check();
});