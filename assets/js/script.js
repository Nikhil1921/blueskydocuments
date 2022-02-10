(function($) {
    "use strict";
    $(".mobile-toggle").click(function() {
        if ($(".nav-menus").hasClass('open')) {
            $('#right_side_bar').removeClass('show');
            $('.form-control-plaintext').removeClass('open');
        }
        $(".nav-menus").toggleClass("open");
    });
    $(".mobile-search").click(function() {
        $(".form-control-plaintext").toggleClass("open");
    });
    $(".bookmark-search").click(function() {
        $(".form-control-search").toggleClass("open");
    });
    $(".filter-toggle").click(function() {
        $(".product-sidebar").toggleClass("open");
    });
    $(".toggle-data").click(function() {
        $(".product-wrapper").toggleClass("sidebaron");
    });
    $(".form-control-plaintext").keyup(function(e) {
        if (e.target.value) {
            $("body").addClass("offcanvas");
        } else {
            $("body").removeClass("offcanvas");
        }
    });
    $(".form-control-search").keyup(function(e) {
        if (e.target.value) {
            $(".page-wrapper").addClass("offcanvas-bookmark");
        } else {
            $(".page-wrapper").removeClass("offcanvas-bookmark");
        }
    });
})(jQuery);

$('.loader-wrapper').fadeOut('slow', function() {
    $(this).remove();
});

$(window).on('scroll', function() {
    if ($(this).scrollTop() > 600) {
        $('.tap-top').fadeIn();
    } else {
        $('.tap-top').fadeOut();
    }
});
$('.tap-top').click(function() {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

function toggleFullScreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) ||
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
        if (document.documentElement.requestFullScreen) {
            document.documentElement.requestFullScreen();
        } else if (document.documentElement.mozRequestFullScreen) {
            document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullScreen) {
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }
}
(function($, window, document, undefined) {
    "use strict";
    var $ripple = $(".js-ripple");
    $ripple.on("click.ui.ripple", function(e) {
        var $this = $(this);
        var $offset = $this.parent().offset();
        var $circle = $this.find(".c-ripple__circle");
        var x = e.pageX - $offset.left;
        var y = e.pageY - $offset.top;
        $circle.css({
            top: y + "px",
            left: x + "px"
        });
        $this.addClass("is-active");
    });
    $ripple.on(
        "animationend webkitAnimationEnd oanimationend MSAnimationEnd",
        function(e) {
            $(this).removeClass("is-active");
        });
})(jQuery, window, document);

$(".chat-menu-icons .toogle-bar").click(function() {
    $(".chat-menu").toggleClass("show");
});


// active link
if ($('input[name="error_msg"]').val() != '') {
    flash_msg("Error", $('input[name="error_msg"]').val(), "danger");
}
if ($('input[name="success_msg"]').val() != '') {
    flash_msg("Success", $('input[name="success_msg"]').val(), "success");
}

$("#checkall").click(function() {
    if (this.checked) {
        $(".check_class").prop("checked", true);
    } else {
        $(".check_class").prop("checked", false);
    }
});

$('#all-download').click(function() {
    $('input[name="docs[]"]:checked').each(function() {
        console.log(this.value);
        var element = document.createElement('a');
        element.setAttribute('href', this.value);
        element.setAttribute('download', $(this).data('name'));
        console.log(element)
        document.body.appendChild(element);
        element.click();
        document.body.removeChild(element);
    });
});

function flash_msg(title, message, type) {
    $.notify({
        title: title,
        message: message
    }, {
        type: type,
        allow_dismiss: false,
        newest_on_top: false,
        mouse_over: false,
        showProgressbar: false,
        spacing: 10,
        timer: 2000,
        placement: {
            from: 'top',
            align: 'center'
        },
        offset: {
            x: 30,
            y: 30
        },
        delay: 1000,
        z_index: 10000,
        animate: {
            enter: 'animated flash',
            exit: 'animated flash'
        }
    });
}

var script = {
    delete: function(id) {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $("#" + id).submit();
                } else {
                    return;
                }
            })
        return;
        /* swal({
                title: "Are you sure?",
                text: "Are you sure remove this item?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn btn-outline-danger",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: 'No',
                closeOnConfirm: false
            },
            function() {
                let form = $("#" + id);

            }); */
    }

};

if ($('.drop-target').length > 0) {

    var uploader, traverseFileTree, map = {};

    // replace by your plupload setup, this is just an example
    uploader = new plupload.Uploader({
        runtimes: 'html5',
        container: 'drop-target',
        drop_element: 'drop-target',
        browse_button: 'files',
        url: `${$('#base_url').val()}folders/upload-documents`,
        filters: {
            mime_types: [
                { title: "Image files", extensions: "jpg,jpeg,png,pdf" }
            ]
        },
        init: {
            PostInit: function() {
                document.getElementById('uploadfiles').onclick = function() {
                    uploader.start();
                    return false;
                };
            },
            BeforeUpload: function(up, file) {
                // send relativePath along
                if (map[file.name] !== undefined) {
                    var relativePath = map[file.name].shift();
                    up.setOption('multipart_params', {
                        relativePath: relativePath,
                        folder_id: $('input[name=folder_id]').val()
                    });
                    var remove = relativePath + file.name;
                    $('#' + remove.replaceAll(' ', '_').replace(/[&\/\\#, +()$~%.'":*?<>{}-]/g, '_')).remove();
                }
            }
        }
    });

    uploader.init();

    // all relative paths are built here
    traverseFileTree = function(item, path) {
        var dirReader = null;
        path = path || '';
        if (item.isFile) {
            item.file(function(file) {
                // careful here, could be several files of the same name
                // we assume files will be in the same order here than in plupload
                if (map[file.name] === undefined) {
                    map[file.name] = [];
                }
                map[file.name].push(path);
                const fileReader = new FileReader();
                fileReader.readAsDataURL(file);
                fileReader.addEventListener("load", function() {
                    var remove = path + file.name;
                    $('#view-docs').append(`<img class="col-3" id="${(remove).replaceAll(' ', '_').replace(/[&\/\\#, +()$~%.'":*?<>{}-]/g, '_')}" src="${this.result}" />`);
                });
            });
        } else if (item.isDirectory) {
            dirReader = item.createReader();
            dirReader.readEntries(function(entries) {
                var n = 0;
                for (n = 0; n < entries.length; n++) {
                    traverseFileTree(entries[n], path + item.name + "/");
                }
            });
        }
    };

    // bind another handler to the drop event to build an object representing the folder structure
    document.getElementById('drop-target').addEventListener('drop', function(e) {
        $('#view-docs').html('');
        var items = e.dataTransfer.items,
            n, item;

        for (n = 0; n < items.length; n++) {
            item = items[n].webkitGetAsEntry();
            if (item) {
                traverseFileTree(item);
            }
        }
    }, false);
}