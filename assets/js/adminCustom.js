

$(document).ready(function () {

    $('.delcat').click(function () {

        var id = $(this).data('id');
        var text = $(this).data('text');
        //console.log(id);
        $.ajax({
            type: 'POST',
            url: surl + 'admin/deleteCategory',
            data: {
                id: id,
                text: text
            },
            success: function (data) {
                var ndata = JSON.parse(data);
                if (ndata.return == true) {
                    $('.error').text(ndata.message);
                    $('.ccat' + id).fadeOut();
                }
                else if (ndata.return == false) {
                    $('.error').text(ndata.message);
                }
                else {
                    $('.error').text('something went wrong');
                }

            },
            error: function () {
                $('.error').text('something went wrong');
            }

        });

    });

    



    $('.add_spec').click(function () {

        console.log("woring .add spec");
        var sp_count = $('.sp_cn').length;
        var items = "";
        items += "<div class='form-group contspecvalue rmov" + sp_count + "'>";
        items += "<input type='text' name='sp_val[]' class='form-control sp_cn' placeholder='Spec value'>";
        items += "<a href='javascript:void(0)' class='remov_spec' data-id=" + sp_count + ">-</a>";
        items += "</div>";

        if (sp_count <= 5) {
            $('.htmlitem').append(items);
        }

    });

    $('body').on("click", ".remov_spec", function () {

        var crnt = $(this).data('id');
        $('.rmov' + crnt).remove();
    });




    $('.specnow').click(function () {

        var id = $(this).data('id');
        var text = $(this).data('text');
        //console.log(id);
        $.ajax({
            type: 'POST',
            url: surl + 'admin/deleteSpec',
            data: {
                id: id,
                text: text
            },
            success: function (data) {
                var ndata = JSON.parse(data);
                if (ndata.return == true) {
                    $('.error').text(ndata.message);
                    $('.dspec' + id).fadeOut();
                    $('.dspec' + id).remove();
                }
                else if (ndata.return == false) {
                    $('.error').text(ndata.message);
                }
                else {
                    $('.error').text('something went wrong');
                }

            },
            error: function () {
                $('.error').text('something went wrong');
            }

        });

    });




    $('.delpro').click(function () {

        var id = $(this).data('id');
        var text = $(this).data('text');
       
        $.ajax({
            type: 'POST',
            url: surl + 'admin/deleteProduct',
            data: {
                id: id,
                text: text
            },
            success: function (data) {
                var ndata = JSON.parse(data);
                if (ndata.return == true) {
                    $('.error').text(ndata.message);
                    $('.cpro' +id).fadeOut();
                }
                else if (ndata.return == false) {
                    $('.error').text(ndata.message);
                }
                else {
                    $('.error').text('something went wrong');
                }

            },
            error: function () {
                $('.error').text('something went wrong');
            }

        });

    });

    



});









