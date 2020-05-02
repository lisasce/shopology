var tbl = '';

tbl += '<table class="table table-hover col-12"';

tbl += '<thead>';
tbl += '<tr>';
tbl += '<th>Code</th>';
tbl += '<th>Details</th>';
tbl += '<th>Active</th>';
tbl += '<th>Amount</th>';
tbl += '<th>Options</th>';
tbl += '</thead>';

tbl += '<tbody>';

$.each(discounts, function(index, value) {
    tbl += '<tr row_id="' + value["discount_id"] + '">';
    tbl += '<td><div class="row_data" edit_type="click" col_name="codemsg">' + value['codemsg'] + '</div></td>';
    tbl += '<td><div class="row_data" edit_type="click" col_name="discountname">' + value['discountname'] + '</div></td>';
    tbl += '<td><div class="row_data" edit_type="click" col_name="activated">' + value['activated'] + '</div></td>';
    tbl += '<td><div class="row_data" edit_type="click" col_name="discount_amount">' + value['discount_amount'] + '</div></td>';

    tbl += '<td>';

    tbl += '<span class="btn_edit"> <a href="#" class="btn btn-link" row_id="' + value["discount_id"] + '"> Edit</a> </span>';
    //only show this button if edit button is clicked
    tbl += '<span class="btn_save"> <a href="#" class="btn btn-link" row_id="' + value["discount_id"] + '"> Save</a>| </span>';
    tbl += '<span class="btn_cancel"> <a href="#" class="btn btn-link" row_id="' + value["discount_id"] + '"> Cancel</a>| </span>';
    tbl += '<span class="btn_delete"> <a href="#" class="btn btn-link" row_id="' + value["discount_id"] + '"> Delete</a> </span>';

    tbl += '</td>';

    tbl += '</tr>';
});

tbl += '</tbody>';
tbl += '</table>';

//output table data
$(document).find('.tableDiscount').html(tbl);

$(document).find('.btn_save').hide();
$(document).find('.btn_cancel').hide();

//making div editable
$(document).on('click', '.row_data', function(event) {
    event.preventDefault();

    if ($(this).attr('edit_type') == 'button') {
        return false;
    }

    $(this).closest('div').attr('contenteditable', 'true');

    $(this).addClass('discount_edit').css('padding', '5px');

    $(this).focus();
});

//making all rows editable
$(document).on('click', '.btn_edit', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('row_id');

    tbl_row.find('.btn_save').show();
    tbl_row.find('.btn_cancel').show();

    //hiding edit button
    tbl_row.find('.btn_edit').hide();

    //making whole row editable
    tbl_row.find('.row_data')
        .attr('contenteditable', 'true')
        .attr('edit_type', 'button')
        .addClass('discount_edit')
        .css('padding', '3px')

    tbl_row.find('.row_data').each(function(index, val) {
        $(this).attr('original_entry', $(this).html());
    });
});

//cancel button
$(document).on('click', '.btn_cancel', function(event) {

    event.preventDefault();

    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('row_id');

    //hiding cancel+save buttons
    tbl_row.find('.btn_save').hide();
    tbl_row.find('.btn_cancel').hide();

    //show edit button
    tbl_row.find('.btn_edit').show();

    //making whole row editable(removing previously added class + padding)
    tbl_row.find('.row_data')
        .attr('edit_type', 'click')
        .removeClass('discount_edit')
        .css('padding', '')

    tbl_row.find('.row_data').each(function(index, val) {
        $(this).html($(this).attr('original_entry'));
    });
});

//save single field data
$(document).on('click', '.btn_save', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('row_id');


    //hide save and cacel buttons
    tbl_row.find('.btn_save').hide();
    tbl_row.find('.btn_cancel').hide();

    //show edit button
    tbl_row.find('.btn_edit').show();


    //make the whole row editable
    tbl_row.find('.row_data')
        .attr('edit_type', 'click')
        .removeClass('discount_edit')
        .css('padding', '')

    //--->get row data > start
    var arr = {};
    tbl_row.find('.row_data').each(function(index, val) {
        var col_name = $(this).attr('col_name');
        var col_val = $(this).html();
        arr[col_name] = col_val;
    });
    //--->get row data > end


    //use the "arr"	object for your ajax call
    $.extend(arr, { row_id: row_id });

    console.log(arr);

    $.post("../actions/discountEdit.php", { array: arr }).done(function(response) {
        console.log(response);
    });


    /*
        $.ajax({
            type: "POST",
            ulr: "./actions/discountEdit.php",
            data: { array: arr }
        });
    */
});

$(document).on('click', '.btn_delete', function(event) {
    event.preventDefault();
    var tbl_row = $(this).closest('tr');

    var row_id = tbl_row.attr('row_id');

    var arr = {};
    tbl_row.find('.row_data').each(function(index, val) {
        var col_name = $(this).attr('col_name');
        var col_val = $(this).html();
        arr[col_name] = col_val;
    });

    $.extend(arr, { row_id: row_id });

    $.post("../actions/discountDelete.php", { array: arr }).done(function(response) {
        console.log(response);
    });
});


// function discountVal() {
//     $.post("../actions/discountDetails.php", { }).done(function(response) {
//         console.log(response);
//     });
// }