$(document).ready(function () {
    $("#alpha").on('change', function () {
        var alpha = document.getElementById("alpha").value;
//        var ip = 'http://localhost/skripsi/index.php/doubleperamalan/get_id_obat';
        console.log(alpha);
        $.ajax({
            data: 'alpha=' + alpha,
            type: 'POST',
            url: 'http://localhost/skripsi/index.php/doubleperamalan/get_id_obat',
            dataType: 'json',
            success: function (data) {
                console.log('masuk ajax'),
                console.log(data);
                var baris = '<option>- pilih obat -</option>';
                for (var i = 0; i < data.length; i++) {
                    baris +=
                            '<option value="' + data[i].id_obat + '"" >Obat ' + data[i].nama_obat + ' </option>';
                }
                $('#id_obat').html(baris);
            },
        });
    });
});
