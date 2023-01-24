<script>
    function sendnotify(msg) {
        new Notify({
            status: 'success',
            title: msg,
            text: '',
            effect: 'fade',
            speed: 300,
            customClass: '',
            customIcon: '',
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 1,
            position: 'right top'
        })
    }
    $(document).ready(function() {
        $('.minus').click(function() {
            var $input = $(this).parent().find('input');
            var count = parseInt($input.val()) - 1;
            count = count < 1 ? 1 : count;
            $input.val(count);
            $input.change();
            return false;
        });
        $('.plus').click(function() {
            var $input = $(this).parent().find('input');
            $input.val(parseInt($input.val()) + 1);
            $input.change();
            return false;
        });
    });



    function displayaddon(cartId, productId, mealType) {
        console.log(mealType);
        $.ajax({
            url: '/app/addonlist/' + productId + '/' + mealType + '/' + cartId,
            type: "get",
            success: function(data) {
                console.log(data);
                if (data['status'] == "success") {
                    if (data['addonlist'][0]) {
                        document.getElementById('addonmodalbtn').click();
                        str = '';
                        data['addonlist'].forEach(element => {
                            if (data['cartexist'] == element['id']) {
                                str += '<tr>\
                                        <td>\
                                            <div class="d-block text-center">\
                                                <input class="form-check-input border-dark ms-0" checked value="' + element['id'] + '" type="radio" name="addonval" id="addonval">\
                                            </div>\
                                        </td>\
                                        <td>' + element['description'] + ' (' + element['quantity'] + ' ' + element['unit'] + ')</td>\
                                        <td>&#8377 ' + element['price'] + '</td>\
                                    </tr>'
                            } else {
                                str += '<tr>\
                                        <td>\
                                            <div class="d-block text-center">\
                                                <input class="form-check-input border-dark ms-0"  value="' + element['id'] + '" type="radio" name="addonval" id="addonval">\
                                            </div>\
                                        </td>\
                                        <td>' + element['description'] + ' (' + element['quantity'] + ' ' + element['unit'] + ')</td>\
                                        <td>&#8377 ' + element['price'] + '</td>\
                                    </tr>'
                            }


                        });
                        document.getElementById('addonhiddenpid').value = productId;
                        document.getElementById('addondisplay').innerHTML = str;
                    } else {
                        addtocart(productId);
                    }
                } else if (data['status'] == "login") {
                    // window.location.href = "/app/login";
                    var url = window.location.href;
                    localStorage.setItem("url", url);
                    window.location.href = "/app/login"
                }
            }
        });
    }

    function addonaddtocart() {
        pid = document.getElementById('addonhiddenpid').value;
        addtocart(pid);

    }

    function addtocart(productId) {
        if (document.querySelector('input[name="addonval"]:checked')) {
            addonval = document.querySelector('input[name="addonval"]:checked').value;
        } else {
            addonval = 0;
        }

        console.log(productId);
        console.log(addonval);
        $.ajax({
            url: '/app/addtocart/' + productId + '/' + addonval,
            type: "get",
            success: function(data) {
                console.log(data);
                if (data['status'] == "success") {
                    $('#addonmodal').modal('hide');
                    sendnotify(data['message']);
                    loadcart();
                    $('#badgeforcart').load(location.href + ' #badgeforcart');
                } else if (data['status'] == "login") {
                    window.location.href = "/app/login";
                }
            }
        });
    }
</script>