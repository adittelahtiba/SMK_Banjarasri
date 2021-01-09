$(document).ready(function () {
    var tautan = document.getElementById('tautan');
    // var kodejurusan2 = document.getElementById('kodejurusan2');
    // var tahunajaran2 = document.getElementById('tahunajaran2');
    var jumlah_tahun = document.getElementById('jumlah_tahun');
    var jumlah_tahun2 = document.getElementById('jumlah_tahun2');
    var analisis = document.getElementById('analisis');
    var pangsapasar = document.getElementById('pangsapasar');
    var penyerapan = document.getElementById('penyerapan');
    var simulasi = document.getElementById('simulasi');
    var kdrasio = document.getElementById('kdrasio');

    if (simulasi) {
        simulasi.addEventListener('input', function () {
            // console.log(simulasi.value);
            var xhr = new XMLHttpRequest()

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tabelsimulasi.innerHTML = xhr.responseText;
                }
            }

            xhr.open('GET', tautan.value + 'Analisis/tabelsimulasi/' + simulasi.value + '/' + kdrasio.value, true);
            xhr.send();
        })
    }




    if (analisis) {

        $('.tblsimpananalisis').attr('disabled', false);

        pangsapasar.addEventListener('input', function () {
            // console.log(pangsapasar.value);
            var xhr = new XMLHttpRequest()

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tabelpangsapasar.innerHTML = xhr.responseText;
                }
            }

            xhr.open('GET', tautan.value + 'Analisis/pasarperusahaan/' + pangsapasar.value + '/' + penyerapan.value, true);
            xhr.send();
        })
        penyerapan.addEventListener('input', function () {
            // console.log(penyerapan.value);
            var xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tabelpangsapasar.innerHTML = xhr.responseText;
                }
            }
            xhr.open('GET', tautan.value + 'Analisis/pasarperusahaan/' + pangsapasar.value + '/' + penyerapan.value, true);
            xhr.send();
        })
    }

    if (jumlah_tahun) {
        jumlah_tahun.addEventListener('input', function () {
            console.log(jumlah_tahun.value)
            var xhr = new XMLHttpRequest()

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tabelpersen.innerHTML = xhr.responseText;
                }
            }
            xhr.open('GET', tautan.value + 'Dashboard/tabelpersen/' + jumlah_tahun.value, true);
            xhr.send();
        })
    }

    if (jumlah_tahun2) {
        jumlah_tahun2.addEventListener('input', function () {
            console.log(jumlah_tahun2.value)

            var xhr = new XMLHttpRequest()

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    tabelpersen.innerHTML = xhr.responseText;
                }
            }
            xhr.open('GET', tautan.value + 'Analisis/tabelpersen/' + jumlah_tahun2.value, true);
            xhr.send();
        })
    }

    var windowH = $(window).height();

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > windowH) {
            $("#myBtn").css('display', 'none');
        } else {
            $("#myBtn").css('display', 'flex');
        }
    });

    // $('#myBtn').on("click", function () {
    //     $('html, body').animate({ scrollTop: dokumentH }, 300);
    // });

    // if (kodejurusan2 && tahunajaran2) {

    //     kodejurusan2.addEventListener('input', function () {
    //         console.log(kodejurusan2.value);
    //         var xhr = new XMLHttpRequest()

    //         xhr.onreadystatechange = function () {
    //             if (xhr.readyState == 4 && xhr.status == 200) {
    //                 tabelsituasi.innerHTML = xhr.responseText;
    //             }
    //         }
    //         xhr.open('GET', tautan.value + 'Situasialumni/tabelsituasi/' + kodejurusan2.value + '/' + tahunajaran2.value, true);
    //         xhr.send();
    //     })

    //     tahunajaran2.addEventListener('input', function () {
    //         console.log(tahunajaran2.value);
    //         var xhr = new XMLHttpRequest()

    //         xhr.onreadystatechange = function () {
    //             if (xhr.readyState == 4 && xhr.status == 200) {
    //                 tabelsituasi.innerHTML = xhr.responseText;
    //             }
    //         }
    //         xhr.open('GET', tautan.value + 'Situasialumni/tabelsituasi/' + kodejurusan2.value + '/' + tahunajaran2.value, true);
    //         xhr.send();
    //     })
    // }

});