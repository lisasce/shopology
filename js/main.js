function confirmWindow(callback) {
    boot4.confirm({
        msg:"Are you sure you want to delete?\nThis action cannot be undone.",
        title:"Confirmation",
        callback:callback
    });
}

function removeWishlistItem(){
    let button = window.event.currentTarget;
    confirmWindow(function(result){
        if(result){
            $.post("wishlist.php", {"remove-wish": 1, "product_id": button.previousElementSibling.value}).done(function(){
                location.reload();
            });
        }
    });
}

function orderWindow(){
boot4.alert({
    msg:"Thank you for your order, see you soon! &#128512;",
    title:"Order confirmation",
    style: {
        // CSS styles here
    },
    callback:function() {
        // do something
    }
},"OK");
}

var map;
function initMap() {
    let maps = document.getElementsByClassName('map');
    let map ="";
    for (map of maps){
        var city = {
            lat: parseFloat(map.dataset.x),
            lng: parseFloat(map.dataset.y)
        };
        if ( isNaN(city.lat) || isNaN(city.lng)){
            map.style.display='none';

        }else{
            map = new google.maps.Map(map, {
                center: city,
                zoom: 8
            });
            var pinpoint = new google.maps.Marker({
                position: city,
                map: map
            });
        }
    }
}


function delBtnClick() {
    let link = $(this).data('href');
    confirmWindow(function (result) {
        if(result){
            location.assign(link);
        }
        // result depends on the button you click and returns true or false. if true you are redirected to the page with the action.
    });
}

$(document).ready(function(){
    $.ajaxSetup ({
        // Disable caching of AJAX responses
        cache: false
    });

    $(".delBtn").click(delBtnClick);

    $('#searchDiv').parent().parent().hide();

    var request;
    $("#input").keyup(function(){
        // Abort any pending request
        if (request) {
            request.abort();
        }
        var searchVal = $(this).val();
        if (searchVal != ""){

            $.get("../actions/searchBar.php?search="+searchVal,
                function(response){
                    $('#sidebarWrapper').addClass("invisible");
                    $('#standardPdtDisplay').hide();
                    $('#searchDiv').parent().parent().show();
                    $('#searchDiv').html(response);

                });
        }else{
            $('#sidebarWrapper').removeClass("invisible");
            $('#standardPdtDisplay').show();
            $('#searchDiv').parent().parent().hide();
        }
        });


    $("#changePW").click(function () {
        $("#checkOldPW").toggleClass("hiddenPW1");
    });


    $('#checkPWbtn').click(function(){
        let pwValue = $('#oldPassword').val();
        if(pwValue != '' && pwValue != undefined)
        {
            $.ajax({
                url: "../actions/hashPW.php",
                method: "POST",
                data: { pwValue},
                success: function (response) {
                    if (response == 1){
                        $("#newPW").toggleClass("hiddenPW2");
                        $('#pw_msg').html('');
                    }else{
                        $('#pw_msg').html('wrong');

                    }
                }
            })
        }});


    $("#addAddBtn").click(function () {
        $("#hiddenForm").toggleClass("hiddenForm");
    });

    $(".editBtnAddress").click(function () {
        $(this).parents(".justify-content-around").find("div:nth-of-type(2)").toggleClass("hiddenForm2");
    });

    $("#sidebar").mCustomScrollbar({
        theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });

    $('#userSelect').change(function(){
        let value = $(this).val();
        if(value != '')
        {
            $.get("../actions/changeRoleActiveStatus.php?user_id="+value,
                function(response){
                    let data = JSON.parse(response);
                    $("#role").val(data.role);
                    $('input[name=active][value='+data.active+']').prop("checked", true);
                });
        }
    });
    $('.updateSave').click(function(){
        let address_id = $(this).val();
        /*data is a set of values - object like, not just one, you target the name after the 'data-'*/

        // let objectData= {address_id:address_id};
        // objectData.coordy = $('#coordy' + address_id).val(); manual variante
        let objectData= $(this).parent().find('input').serialize();

        if(address_id != '' && address_id != undefined)
        {
            $.post("../actions/updateAddress.php",
                objectData + "&address_id=" + address_id,
                function(response){
                    console.log(response);
                    location.reload();
                    //page reload
                });
        }else{
            $.post("../actions/createAddress.php",
                objectData,
                function(response){
                    console.log(response);
                    location.reload();
             });
        }
    });



    $('#email').keyup(function(){
        var email = $(this).val();
        if(email != '')
        {
            $.ajax({
                url:"../actions/emailCheckAjax.php",
                method:"POST",
                data:{email:email},
                success:function(response){
                    $('#email_result').html(response);
                }
            });
        }
    });

    $('#passVerif').keyup(function(){
        var passVerif = $(this).val();
        var password = $('#password').val();
        if(passVerif !== '' && password !== "")
        {
            $.ajax({
                url:"../actions/passwordCheck.php",
                method:"POST",
                data:{pass:password,passVerif:passVerif},
                success:function(response){
                    $('#pw_result').html(response);
                }
            });
        }
    });

    $("#pdtSelect").change(function () {
        location.assign("update.php?id=" + $(this).val());
    });


    // ------------questions answers--------------

    $("#askBtn").click(function () {
        let value = $(this).data('url_id');
        let objectData= $('#question_msg').val();
        if(value != '')
        {
            $.post("../actions/askQuestion.php?id="+value,{question_msg: objectData},
                function(response){
                    console.log(response);
                    location.reload();
                });
        }
    });

    $(".answerBtn").click(function () {
        let value = $(this).data('quest_id');
        let objectData= $(this).prev().val();
        if(value != '')
        {
            $.post("../actions/addAnswer.php?id="+value,{answer_msg: objectData},
                function(response){
                    console.log(response);
                    location.reload();
                });
        }
    });

    $(".showAnswers").click(function () {
        $(this).parents('.alert').next().toggleClass("hiddenForm");

    });

    $("#changeIMG").click(function () {
        $("#user_img").toggleClass("hiddenForm");
    });


    $('.editBtn').click(function() {
        $(this).parent().nextUntil('emptyDivForUpdatingEntry').toggleClass("hiddenForm");
    });



    $(".updateQBtn").click(function () {
        let value = $(this).data('quest_id');
        let objectData = $(this).prev().val();

        if (value != '') {
            $.post("../actions/updateQuestion.php?id=" + value, {question_msg: objectData},
                function (response) {
                    console.log(response);
                    location.reload();
                });
        }
    });

    $(".updateABtn").click(function () {
        let value = $(this).data('ans_id');
        let objectData = $(this).prev().val();

        if (value != '') {
            $.post("../actions/updateAnswer.php?id=" + value, {answer_msg: objectData},
                function (response) {
                    console.log(response);
                    location.reload();
                });
        }
    });

    $(".updateRBtn").click(function () {
        let value = $(this).data('rev_id');
        let objectData = $(this).prev().val();

        if (value != '') {
            $.post("../actions/updateReview.php?id=" + value, {review_msg: objectData},
                function (response) {
                    console.log(response);
                    location.reload();
                });
        }
    });

});
