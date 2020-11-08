function getsubcategory(value) {

    if (value != "") {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/getsubcategorybycategory',
            type: 'post',
            data: { id: value },
            success: function (response) {
                let html = '<option value="">নির্বাচন করুণ</option>';
                response.forEach(function (item) {
                    html += '<option value="' + item.id + '">' + item.name + '</option>';

                });

                $("#sub_category").html(html);

            }

        })
    } else {
        $("#sub_category").html('<option value="">নির্বাচন করুণ</option>');
    }
}