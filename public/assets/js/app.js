/*
 * Bootstrap Growl - Notifications popups
 */
function notify(message, type) {
    $.growl(
        {
            message: message,
        },
        {
            type: type,
            allow_dismiss: true,
            label: "Cancel",
            className: "btn-xs",
            placement: {
                from: "bottom",
                align: "left",
            },
            delay: 4000,
            animate: {
                enter: "animated bounceIn",
                exit: "animated bounceOut",
            },
            offset: {
                x: 20,
                y: 20,
            },
            spacing: 5,
        }
    );
}

function gd(year, month, day) {
    return new Date(year, month - 1, day).getTime();
}

$(window).load(function () {
    if ($(".tab-nav li.active") && $(".tab-nav li.active").get(0)) {
        $(".tab-nav li.active").get(0).scrollIntoView({
            block: "center",
        });
    }

    if ($("#growl-alert").val() && $("#growl-alert").val() !== "") {
        notify($("#growl-alert").val(), "success");
    }

    if ($("#growl-warning").val() && $("#growl-warning").val() !== "") {
        notify($("#growl-warning").val(), "warning");
    }
});

$(document).ready(function () {
    /*-----------------------------------------------------------
        Waves
    -----------------------------------------------------------*/
    Waves.attach(".btn:not(.btn-icon):not(.btn-float)");
    Waves.attach(".btn-icon, .btn-float", ["waves-circle", "waves-float"]);
    Waves.init();

    $("body").on("click", "[data-ma-action]", function (e) {
        e.preventDefault();

        var $this = $(this);
        var action = $(this).data("ma-action");

        switch (action) {
            /*-------------------------------------------
                Sidebar Open/Close
            ---------------------------------------------*/
            case "sidebar-open":
                var target = $this.data("ma-target");
                var backdrop = '<div data-ma-action="sidebar-close" class="ma-backdrop" />';

                $("body").addClass("sidebar-toggled");
                $("#header, #header-alt, #main").append(backdrop);
                $this.addClass("toggled");
                $(target).addClass("toggled");

                break;

            case "sidebar-close":
                $("body").removeClass("sidebar-toggled");
                $(".ma-backdrop").remove();
                $(".sidebar, .ma-trigger").removeClass("toggled");

                break;

            /*-------------------------------------------
                Profile Menu Toggle
            ---------------------------------------------*/
            case "profile-menu-toggle":
                $this.parent().toggleClass("toggled");
                $this.next().slideToggle(200);

                break;

            /*-------------------------------------------
                Mainmenu Submenu Toggle
            ---------------------------------------------*/
            case "submenu-toggle":
                $this.next().slideToggle(200);
                $this.parent().toggleClass("toggled");

                break;

            /*-------------------------------------------
                Top Search Open/Close
            ---------------------------------------------*/
            //Open
            case "search-open":
                $("#header").addClass("search-toggled");
                $("#top-search-wrap input").focus();

                break;

            //Close
            case "search-close":
                $("#header").removeClass("search-toggled");

                break;

            /*-------------------------------------------
                Fullscreen Browsing
            ---------------------------------------------*/
            case "fullscreen":
                //Launch
                function launchIntoFullscreen(element) {
                    if (element.requestFullscreen) {
                        element.requestFullscreen();
                    } else if (element.mozRequestFullScreen) {
                        element.mozRequestFullScreen();
                    } else if (element.webkitRequestFullscreen) {
                        element.webkitRequestFullscreen();
                    } else if (element.msRequestFullscreen) {
                        element.msRequestFullscreen();
                    }
                }

                //Exit
                function exitFullscreen() {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }

                launchIntoFullscreen(document.documentElement);

                break;

            /*-------------------------------------------
                Login Window Switch
            ---------------------------------------------*/
            case "login-switch":
                var loginblock = $this.data("ma-block");
                var loginParent = $this.closest(".lc-block");

                loginParent.removeClass("toggled");

                setTimeout(function () {
                    $(loginblock).addClass("toggled");
                });

                break;

            /*-------------------------------------------
                Change Header Skin
            ---------------------------------------------*/
            case "change-skin":
                var skin = $this.data("ma-skin");
                $("[data-ma-theme]").attr("data-ma-theme", skin);

                break;
        }
    });
});
/*----------------------------------------------------------
    Detect Mobile Browser
-----------------------------------------------------------*/
if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
    $("html").addClass("ismobile");
}

$(window).load(function () {
    /*----------------------------------------------------------
        Page Loader
     -----------------------------------------------------------*/
    if (!$("html").hasClass("ismobile")) {
        if ($(".page-loader")[0]) {
            setTimeout(function () {
                $(".page-loader").fadeOut();
            }, 500);
        }
    }
});

$(document).ready(function () {
    /*----------------------------------------------------------
        Text Field
    -----------------------------------------------------------*/
    //Add blue animated border and remove with condition when focus and blur
    if ($(".fg-line")[0]) {
        $("body").on("focus", ".fg-line .form-control", function () {
            $(this).closest(".fg-line").addClass("fg-toggled");
        });

        $("body").on("blur", ".form-control", function () {
            var p = $(this).closest(".form-group, .input-group");
            var i = p.find(".form-control").val();

            if (p.hasClass("fg-float")) {
                if (i.length == 0) {
                    $(this).closest(".fg-line").removeClass("fg-toggled");
                }
            } else {
                $(this).closest(".fg-line").removeClass("fg-toggled");
            }
        });
    }

    //Add blue border for pre-valued fg-flot text fields
    if ($(".fg-float")[0]) {
        $(".fg-float .form-control").each(function () {
            var i = $(this).val();

            if (!i.length == 0) {
                $(this).closest(".fg-line").addClass("fg-toggled");
            }
        });
    }

    /*-----------------------------------------------------------
        Waves
    -----------------------------------------------------------*/
    (function () {
        Waves.attach(".btn");
        Waves.attach(".btn-icon, .btn-float", ["waves-circle", "waves-float"]);
        Waves.init();
    })();

    /*-----------------------------------------------------------
        Link prevent
    -----------------------------------------------------------*/
    $("body").on("click", ".a-prevent", function (e) {
        e.preventDefault();
    });

    /*-----------------------------------------------------------
        Data Table Customization
    -----------------------------------------------------------*/
    if ($("#data-table-basic")[0]) {
        $("#data-table-basic").DataTable({
            order: [[0, "desc"]],

            language: {
                sDecimal: ",",
                sEmptyTable: "Δεν υπάρχουν δεδομένα στον πίνακα",
                sInfo: "Εμφανίζονται _START_ έως _END_ από _TOTAL_ εγγραφές",
                sInfoEmpty: "Δεν υπάρχουν εγγραφές",
                sInfoFiltered: "(φιλτραρισμένες από _MAX_ συνολικά εγγραφές)",
                sInfoPostFix: "",
                sInfoThousands: ".",
                sLengthMenu: "_MENU_ εγγραφές",
                sLoadingRecords: "Φόρτωση...",
                sProcessing: "Επεξεργασία...",
                sSearch: "Αναζήτηση:",
                sSearchPlaceholder: "Αναζήτηση",
                sThousands: ".",
                sUrl: "",
                sZeroRecords: "Δεν βρέθηκαν εγγραφές που να ταιριάζουν",
                oPaginate: {
                    sFirst: "Πρώτη",
                    sPrevious: "Προηγούμενη",
                    sNext: "Επόμενη",
                    sLast: "Τελευταία",
                },
                oAria: {
                    sSortAscending: ": ενεργοποιήστε για αύξουσα ταξινόμηση της στήλης",
                    sSortDescending: ": ενεργοποιήστε για φθίνουσα ταξινόμηση της στήλης",
                },
            },
        });
    }

    if ("standalone" in window.navigator && window.navigator.standalone) {
        // For iOS Apps
        $("a").on("click", function (e) {
            e.preventDefault();
            var new_location = $(this).attr("href");
            if (
                new_location != undefined &&
                new_location.substr(0, 1) != "#" &&
                $(this).attr("data-method") == undefined
            ) {
                window.location = new_location;
            }
        });
    }
});
