                                                                     // Ajax for update image:

$(document).ready(function() {
    $('#form').on('submit', function(event) {
        event.preventDefault();
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
            url: 'upload.php',
            dataType: 'text',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(response) {
                // console.log(response);
                $('.cont').html(response);

            }
        });
    });
});

                                                                            // Ajax for delete images:

function remove(element,event) {
    event.preventDefault();
    var href;
    if (window.location.search)
    {
        href = element.search.replace('?', '&');
    } else
    {
        href = element.search;
    }
    var url_string = window.location.href + href;
    var url = new URL(url_string);
    var path = url.searchParams.get('path');
    $.ajax({
        url:"delete.php",
        type:"POST",
        data: {path: path},
        success:function(response)
        {
                $('.cont').html(response);
        }
    })

};


function form_rename(element, e) {
    e.preventDefault();
    var newname = element.children[0].value;
    var oldname = element.children[1].value;
    if (newname === "" || oldname === "" || newname === oldname )
    {
        element.children[0].classList.add("active");
        return false;
    }
    element.children[0].classList.remove("active");
    $.ajax({
        url:"rename.php",
        type:"POST",
        data: {oldname: oldname, newname: newname},
        success:function(response){
            element.children[0].value = response;
            element.children[1].value = response;
            element.children[4].href = "delete.php?path=compressed/" + response;
            console.log(response,"res");
            e.path.forEach(function(elem){
                if(elem.className == "card"){
                    elem.children[0].src = "compressed/" + response;
            }
            })
        }
    });
};



var hiddenInput;                                           // Ajax vor window click
window.onclick = function(e) {
{
    var path = e.path || e.composedPath && e.composedPath();
    e.path.forEach(function (elem)
    {
        if (elem.className == 'card-body')
        {
            hiddenInput = elem.children[0].children[1].value;
        }
    });
    var input = document.querySelectorAll(".myinput");
    input.forEach(function(elem) {
        elem.classList.remove("active");
        if (!path.includes(elem))
        {
            if (elem.value == "")
            {
                elem.value = hiddenInput;
            }
        }
    })
}};



/**
 * Created by Lenovo on 4/2/2019.
 */
