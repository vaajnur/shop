$(function() {
    /* For demo purposes */
    var demo = $("<div />").css({
        position: "fixed",
        top: "150px",
        right: "0",
        background: "rgba(0, 0, 0, 0.7)",
        "border-radius": "5px 0px 0px 5px",
        padding: "10px 15px",
        "font-size": "16px",
        "z-index": "999999",
        cursor: "pointer",
        color: "#ddd"
    }).html("<i class='fa fa-gear'></i>").addClass("no-print");

    var demo_settings = $("<div />").css({
        "padding": "10px",
        position: "fixed",
        top: "130px",
        right: "-200px",
        background: "#fff",
        border: "3px solid rgba(0, 0, 0, 0.7)",
        "width": "200px",
        "z-index": "999999"
    }).addClass("no-print");
    demo_settings.append(
            "<h4 style='margin: 0 0 5px 0; border-bottom: 1px dashed #ddd; padding-bottom: 3px;'>Layout Options</h4>"
            + "<div class='form-group no-margin'>"
            + "<div class='.checkbox'>"
            + "<label>"
            + "<input type='checkbox' onchange='change_layout();'/> "
            + "Fixed layout"
            + "</label>"
            + "</div>"
            + "</div>"
            );
    demo_settings.append(
            "<h4 style='margin: 0 0 5px 0; border-bottom: 1px dashed #ddd; padding-bottom: 3px;'>Skins</h4>"
            + "<div class='form-group no-margin'>"
            + "<div class='.radio'>"
            + "<label>"
            + "<input name='skins' type='radio' onchange='change_skin(\"skin-black\");' /> "
            + "Black"
            + "</label>"
            + "</div>"
            + "</div>"

            + "<div class='form-group no-margin'>"
            + "<div class='.radio'>"
            + "<label>"
            + "<input name='skins' type='radio' onchange='change_skin(\"skin-blue\");' checked='checked'/> "
            + "Blue"
            + "</label>"
            + "</div>"
            + "</div>"
            );

    demo.click(function() {
        if (!$(this).hasClass("open")) {
            $(this).css("right", "200px");
            demo_settings.css("right", "0");
            $(this).addClass("open");
        } else {
            $(this).css("right", "0");
            demo_settings.css("right", "-200px");
            $(this).removeClass("open")
        }
    });

    $("body").append(demo);
    $("body").append(demo_settings);
});

function change_layout() {
    $("body").toggleClass("fixed");
    fix_sidebar();
}
function change_skin(cls) {
    $("body").removeClass("skin-blue skin-black");
    $("body").addClass(cls);
}
/* **************************************************************************** add by ainur */
$(".fa, .glyphicon, .hover-tooltip").tooltip()


$(".table-bordered").dataTable({
    //"bPaginate": true,
    //"bLengthChange": false,
    //"bFilter": false,
    "bSort": true,
    "bInfo": true,
    "bAutoWidth": false,
    "iDisplayLength": 25,
    //"bStateSave": true,
    //"bCollapse": true,
    /*"aaData": [
        ['Trident', 'Internet Explorer 4.0', 'Win 95+', 4, 'X'],
        ['Trident', 'Internet Explorer 5.0', 'Win 95+', 5, 'C'],
        ],
    "aoColumns": [
        { "sTitle": "Engine" },
        { "sTitle": "Browser" },
        { "sTitle": "Platform" },
        { "sTitle": "Version" },
        { "sTitle": "Grade" }
    ],*/
    //"aoColumnDefs": 0,
    //"aoColumnDefs": [
    //    { "bSortable": false, "aTargets": [ ".th_image" ] },
        //{ "asSorting": [ "desc" ], "aTargets": [ 0, 1, 2, 3 ] },
    //]
})

/* /////////////////////// TABS */
if(document.querySelector(".nav-tabs")) {
    var nav_tabs = document.querySelector(".nav-tabs").getElementsByClassName("tab-link"),
        nav_tabs_l = nav_tabs.length,
        nav_tabs_body = document.querySelector(".tab-content").getElementsByClassName("tab-pane")

    for (var i = 0; i < nav_tabs_l; i++) {
        nav_tabs[i].addEventListener("click", function (x) {
            return function () {
                localStorage.setItem("nav_tabs_active", x)
            }
        }(i))
        nav_tabs[i].addEventListener("dragend", function (x) {
            return function () {
                localStorage.setItem("nav_tabs_active", x)
            }
        }(i))
        if (localStorage.getItem("nav_tabs_active") != null) {
            nav_tabs[i].classList.remove("active")
            nav_tabs_body[i].classList.remove("active")
        }
    }
// on page reload
    var active_tab = localStorage.getItem("nav_tabs_active") || 0
    if (active_tab != null) {
        active_tab = ~~active_tab
        if (nav_tabs[active_tab] == undefined)
            active_tab = 0
        nav_tabs[active_tab].classList.add("active")
        nav_tabs_body[active_tab].classList.add("active")
    } else {
        nav_tabs[0].classList.add("active")
        nav_tabs_body[0].classList.add("active")
    }
// small gear in right of tabs
    document.querySelector(".edit-nav-tabs").addEventListener("click", function (ev) {
        ev.preventDefault()
    })
}
/* ////////////////////////// CHECKBOX IN MODAL */
$('.modal').on('show.bs.modal', function (e) {
    $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
        checkboxClass: 'icheckbox_minimal',
        radioClass: 'iradio_minimal'
    });
})
/* //////////////////////// ADD OPTION TO COMP FIELD ON CHANGE */
var option_input
$(".new-field-select").on("change", function(){
    var selected = $(this).find("option:selected").val()
    if(selected == "select" || selected == "radio" || selected == "select_multiple")
        $(".add-option-to-comp-block").removeClass("hidden")
    else
    if(!$(".add-option-to-comp-block").hasClass("hidden"))
        $(".add-option-to-comp-block").addClass("hidden")
    option_input = $(".add-option-option").eq(0).clone(true)
})
/* add option input else */
$(".add-option-to-comp-btn").on("click", function(ev){
    ev.preventDefault()
    option_input.clone(true).appendTo(".new-option-block")
})
/* remove option field */
$(".add-option-option .glyphicon-remove").on("click", function(){
    $(this).parent().remove()
})
/* ///////////////// ADD OPTION TO COMP FIELD ON CHANGE 2 */
var added
$(document).on("change", ".table .new-field-select", function(){
    var selected = $(this).find("option:selected").val()
    if(selected == "select" || selected == "radio" || selected == "select_multiple"){
        if(added == false || added == undefined) {
            $('<span class="opts-vals"></span><span class="opts-ids hidden"></span><span class="hover-tooltip btn btn-xs btn-success add-opt" title="добавить опцию">+</span><br>').appendTo($(this).parent().next())
            added = true
        }
    }else{
        $(this).parent().next().html('')
        added = false
    }
})

/* EDIT FORM IN COMPONENTS*/
$(".edit-component-field").on("click", function(ev){
    ev.preventDefault()
    var inps = $(".form-inline .form-control").clone() // pattern form
    /* *********************** send inputs */
    if($(this).hasClass("glyphicon-ok")){

        var paramed = $.param($(this).parent().parent().find("td").find(".form-control")),
            href = $(this).attr("href"),
            el = $(this)
        // SEND AJAX EDITED FIELDS
        ajax2(href, paramed, el)
        // REPLACE INPUTS WITH TEXT
        $(this).parent().parent().find("td").each(function (k, v) {
            if($(v).find(".form-control").length) {
                var width = $(v).width()
                // 1,2,3 JOIN VALIUES
                if (k <= 3) {
                    $(v).html($(v).find(".form-control").val())
                }
                // 4 - JOIN OPTIONS
                else if (k == 4) {
                    var ids1 =  [],
                        vals1 = []
                    // push in array
                    $(v).find(".form-control").each(function(k1, v1){
                        $(v1).next().remove()
                        $(v1).remove()
                    }).end().css("width", width)
                    // refresh innerhtml
                    $.get(href + "/refresh_info").done(function(data){
                        var opts = JSON.parse(data)
                        for(prop in opts) {
                            ids1.push(opts[prop]['id'])
                            vals1.push(opts[prop]['name'])
                        }
                        $(v).find(".opts-ids").html(ids1.join(','))
                        $(v).find(".opts-vals").html(vals1.join(','))
                    })
                }
            }
        })
        $(this).removeClass("glyphicon-ok").addClass("glyphicon-pencil")
    }else {/* ***********************  replace TEXT WITH inputs*/
        $(this).parent().parent().find("td").each(function (k, v) {
            var width = $(v).width(),
                text = $(v).text()
            // 1,2,3 FIELDS
            if (k != 0 && k <= 3) {
                $(inps[k - 1]).css("width", width).val(text)
                $(v).html(inps[k - 1])
            }
            // 4 - OPTIONS
            else if(k == 4 && $(v).find(".opts-vals").text().trim().length != 0){
                var opts = $(v).find(".opts-vals").text().split(','),
                    opts_ids = $(v).find(".opts-ids").text().split(',')
                for(prop in opts){
                    $(v).append(
                        "<input type='text' " +
                        "value='"+ opts[prop] +"' " +
                        "class='form-control edit-opt' " +
                        "name='option_name["+ opts_ids[prop] +"]' />" +
                        "<span data-id=\"" +opts_ids[prop] + "\" class=\"remove-opt btn btn-xs btn-danger\">-</span>"
                    )
                        .css("width", width)
                }
            }
        })
        $(this).removeClass("glyphicon-pencil").addClass("glyphicon-ok")
    }
})
/* ************** ADD OPTION ***** */
var width_td
$(document).on("click", ".add-opt" , function(){
    if(width_td == undefined)
        width_td = $(this).parent().width()
    $(this).parent().css("width", width_td)
    $(this).after(
        "<input type='text' " +
        "value='' " +
        "class='form-control edit-opt' " +
        "name='option_name_new[]' />" +
        "<span class=\"remove-opt btn btn-xs btn-danger\">-</span>"
    )
})
/* ********* REMOVE OPTION */
$(document).on("click", ".remove-opt", function(){
    var id = $(this).data("id")
    if(id) {
        $.get("/admin/componentsList/deleteOption/" + id)
            .done(function (data) {
                if (data == true) {
                }
            })
    }
    $(this).prev().remove()
    $(this).remove()
})
/* /////////////// EDIT ELEMENT ///////////////// */
$(".edit-element").on("click", function(ev){
    ev.preventDefault()
    var href = $(this).data("href"),
        target_modal_id = $(this).data("target")
    ajax1(href, target_modal_id)
})


/* ///////////////////// DRAG & DROP SECTION ///////// */
var div_menu = document.querySelector(".admin_sections_menu"),
    div_child = div_menu.childNodes,
    div_ch_length = div_child.length,
    parent_el,
    level
for(var i = 0;i< div_ch_length;i++){
    //div_child[i].childNodes[0].setAttribute("draggable", false)
    div_child[i].addEventListener("dragstart", function(handler){
    })
    div_child[i].addEventListener("dragleave", function(handler){
        handler.target.classList.remove("dragEnter")
    })
    div_child[i].addEventListener("dragover", function(handler){
    })
    div_child[i].addEventListener("dragenter", function(handler){
        parent_el = handler.target
        handler.target.classList.add("dragEnter")
    })
    div_child[i].addEventListener("drop", function(handler){
    })
    div_child[i].addEventListener("dragend", function(handler){
        console.log(handler)
        target_el = handler.target.tagName == "A" ? handler.target.parentNode : handler.target
        parent_el = parent_el.tagName == "A" ? parent_el.parentNode : parent_el
        var appended = parent_el.appendChild(target_el)
        if(appended.tagName) {
            /* ************** */
            target_id = target_el.getAttribute("data-id")
            parent_id = parent_el.getAttribute("data-id")

            console.log("parent is: " + parent_id)
            console.log("end is: " + target_id.length)

            //handler.target.classList.remove("dragOver")
            handler.target.classList.remove("dragEnter")
            //handler.target.classList.add("dragEnd")
            ajax3(target_id, parent_id)
        }
    })
}


// AJAX FOR EDIT COMPONENT
function ajax1(href, target_modal_id){
    $.ajax({
        url: href,
        type: "get",
        dataType: "text/html",
        beforeSend: function(){
          $(target_modal_id + " .modal-body").html('<span class="fa fa-spin fa-spinner"></span>')
        },
        success: function(data){
            $(target_modal_id + " .modal-body").html(data)
            /* стилизуем чекбокс */
            $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });
            //console.log("good", data)
        },
        error: function(xhr){
            $(target_modal_id + " .modal-body").html(xhr.responseText)
            /* стилизуем чекбокс */
            $("input[type='checkbox']:not(.simple), input[type='radio']:not(.simple)").iCheck({
                checkboxClass: 'icheckbox_minimal',
                radioClass: 'iradio_minimal'
            });
            //console.log("error", xhr.responseText)
        }
    })
}
/* //////////////////// FOR EDIT FIELD IN COMPONENT ******* */
function ajax2(href, paramed, el){
    $.ajax({
        url: href,
        data: paramed,
        type: "post",
        beforeSend: function(){
            el.append('<span class="fa fa-spin fa-spinner"></span>')
        },
        success: function(data){
            if(data == 1) {
                el.parent().parent().addClass("tr-success")
                setTimeout(function () {
                    el.parent().parent().removeClass("tr-success")
                }, 1000)
            }else{
                $(".box-title").eq(0).append("<div class='alert alert-danger'>" + data + "</div>")
            }
            el.find(".fa-spinner").remove()
        },
        error: function(xhr){
            el.parent().parent().addClass("tr-error")
            setTimeout(function(){
                el.parent().parent().removeClass("tr-error")
            }, 2000)
            el.find(".fa-spinner").remove()
            console.log(xhr.responseText)
        }
    })
}

/* ////////////// LEFT MENU DRAG & DROP ///////// */
function ajax3(target_id, parent_id){
    $.ajax({
        url: "/admin/leftmenuDD/drag/"+target_id + "/" + parent_id,
        type: "get",
        success: function(data){
            console.log(data)
        },
        error: function(xhr){
            console.log(xhr.responseText)
        }
    })
}
// *********************** confirm delete ainur
$(".delete_item").confirmModal();
/* /////////////////////////// SORTABLE COMP TABS **/
$(".nav-tabs").sortable({
    //axis:"x",
    containment: "parent"
})
$(".nav-tabs").on("sortstop", function(){
    var comp_ids = [],
        section_id = $(this).data("section_id"),
        href = "/admin/componentsSort/sort/"+section_id,
        data
    $(".nav-tabs .tab-link").each(function(){
        comp_ids.push($(this).data("id"))
    })
    if(comp_ids.length != 0){
        data = JSON.stringify(comp_ids)
        ajax4(href, data)
    }
})

/* ////////////////////////////////// ajax for sortable tabs */
function ajax4(href, data){
    $.ajax({
        url: href,
        type: "post",
        data: "comp_ids="+data,
        success: function(response){
            var a = JSON.parse(response)
        },
        error: function(xhr){

        }
    })
}