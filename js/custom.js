/**
 * Created by Mv on 10/15/2017.
 */
update();
setInterval(update, 10000);

function update() {
    var complete_url=location.protocol + '//' + location.hostname + '/bse_nse.php';
    var url = '/bse_nse.php';
    $.ajax({
        type: "POST",
        url: complete_url,
        success: function (data) {
            var resp = $.parseJSON(data);
            $("#first_second_col").empty();
            $("#first_third_col").empty();
            $("#first_fourth_col").empty();
            var first_secondhtml = '';
            var first_thirdhtml = '';
            var first_fourthhtml = '';
            $.each(resp['nse_second_col'], function (key, val) {
                first_secondhtml += '<li>' + val.toLocaleString('en-IN');
                +'</li>';

            });
            $.each(resp['bse_second_col'], function (key, val) {
                first_thirdhtml += '<li>' + val.toLocaleString('en-IN');
                +'</li>';

            });
            $.each(resp['sum_second_col'], function (key, val) {
                first_fourthhtml += '<li>' + val.toLocaleString('en-IN');
                +'</li>';

            });
            $("#first_second_col").html(first_secondhtml);
            $("#first_third_col").html(first_thirdhtml);
            $("#first_fourth_col").html(first_fourthhtml);

            $("#second_second_col").empty();
            $("#second_third_col").empty();
            $("#second_fourth_col").empty();
            var second_secondhtml = '';
            var second_thirdhtml = '';
            var second_fourthhtml = '';
            $.each(resp['nse_third_col'], function (key, val) {
                second_secondhtml += '<li>' + val.toLocaleString('en-IN');
                +'</li>';

            });
            $.each(resp['bse_third_col'], function (key, val) {
                second_thirdhtml += '<li>' + val.toLocaleString('en-IN');
                +'</li>';

            });
            $.each(resp['sum_third_col'], function (key, val) {
                second_fourthhtml += '<li>' + val.toLocaleString('en-IN');
                +'</li>';

            });
            $("#second_second_col").html(second_secondhtml);
            $("#second_third_col").html(second_thirdhtml);
            $("#second_fourth_col").html(second_fourthhtml);

            $("#third_second_col").empty();
            $("#third_third_col").empty();
            $("#third_fourth_col").empty();
            var third_secondhtml = '';
            var third_thirdhtml = '';
            var third_fourthhtml = '';
            $.each(resp['nse_fourth_col'], function (key, val) {
                third_secondhtml += '<li>' + val + '</li>';

            });
            $.each(resp['bse_fourth_col'], function (key, val) {
                third_thirdhtml += '<li>' + val + '</li>';

            });
            $.each(resp['sum_fourth_col'], function (key, val) {
                third_fourthhtml += '<li>' + val.toFixed(2) + '</li>';

            });
            $("#third_second_col").html(third_secondhtml);
            $("#third_third_col").html(third_thirdhtml);
            $("#third_fourth_col").html(third_fourthhtml);

        }, error: function (e) {
            // alert("Might have network issue !! Please Try Again Later..");
        }

    });

}
