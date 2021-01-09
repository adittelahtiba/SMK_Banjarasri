<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>Using css page breaks when converting HTML to PDF</title>

    <style type="text/css">
        body {
            margin: 0 0 20px 0;
            padding: 0;
        }

        .cover {
            margin-top: 150px;
        }

        h1 {
            margin: 0;
            padding: 20px 0 20px 0;
            font-size: 2em;
            font-weight: 700;
            text-align: center;
        }

        /*
		h2 {
			color: #77D312;
			text-align: center;
			font-size: 1.5em;
			margin-bottom: 65px;
		}

		h3 {
			color: #77D312;
		} */

        .container {
            margin: 0 auto;
            padding: 0 0px;
            width: 515px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .tdcover {
            position: relative;
            border: 2px solid;
            padding: 0px 20px;
            vertical-align: top;
        }

        .hrcover {
            position: relative;
            border: 1px solid;
        }

        .kiri {
            text-align: left;
        }

        /* img {
			margin: 5px auto;
			max-width: 100%;
		} */

        div {
            text-align: center;
        }

        .break-before {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
        }
    </style>

</head>

<body>
    <div class="cover">
        <img src="<?= base_url('assets2/img/'); ?>tutwuri.png" width="250px">
        <h1>
            LAPORAN<br>
            PENCAPAIAN KOMPETENSI PESERTA DIDIK<br>
            SEKOLAH MENENGAH KEJURUAN<br>
            (SMK)<br>
            BANJAR ASRI CIMAUNG<br>
        </h1>
        <br><br><br><br><br><br><br><br>
        <div class="container">
            <h2>Nama Peserta Didik</h2>
            <table>
                <tr>
                    <td class="tdcover">
                        <h2>Aditya Pangestu</h2>
                        <hr class="hrcover">
                        <h2>Nomor Induk : 10116256</h2>
                    </td>
                </tr>
            </table>
            <br>
            <br>
            <br>
            <h2>Nomor Induk Siswa Nasional</h2>
            <table>
                <tr>
                    <td class="tdcover">
                        <h2>10116256</h2>
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <br>
        <br>
        <br><br>
        <br>
        <br>
        <br>
        <H1>YAYASAN TRIKARYA PEMBANGUNANA BANJAR ASRI <BR> 2020
        </H1>
    </div>

    <!-- page 2 -->
    <div class="break-before cover">
        <h1>
            LAPORAN<br>
            PENCAPAIAN KOMPETENSI PESERTA DIDIK<br>
            SEKOLAH MENENGAH KEJURUAN<br>
            (SMK)
        </h1>
        <table class="kiri">
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td>SMK BANJAR ASRI CIMAUNG</td>
            <tr>
                <td>NPSN/NSS</td>
                <td>:</td>
                <td>20254602 / 40.2.02.08.39.062</td>
            <tr>
                <td>Alamat Sekolah</td>
                <td>:</td>
                <td>Jl. Gunung Puntang Km.01 Telp.(022)85933730 Cimaung Kab. Bandung 40374</td>
            <tr>
                <td>Kelurahan</td>
                <td>:</td>
                <td>CIMAUNG</td>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td>CIMAUNG</td>
            <tr>
                <td>Kabupaten/Kota</td>
                <td>:</td>
                <td>BANDUNG</td>
            <tr>
                <td>Provinsi</td>
                <td>:</td>
                <td>JAWA BARAT</td>
            <tr>
                <td>Website</td>
                <td>:</td>
                <td>-</td>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>trd_cmt@yahoo.co.id</td>
            </tr>
        </table>
    </div>

    <!-- page 3 -->
    <div class="break-before cover">
        <h1>
            KETERANGAN TENTANG DIRI PESERTA DIDIK
        </h1>
        <table class="kiri">
            <tr>
                <td>1.</td>
                <td>Nama Peserta Didik (Lengkap)</td>
                <td>:</td>
                <td><b>Aditya Pangestu</b></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>


            <tr>
                <td>2.</td>
                <td>Nomor Induk Siswa Nasional</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>3.</td>
                <td>Tempat/Tanggal Lahir</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>4.</td>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>5.</td>
                <td>Agama</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>6.</td>
                <td>Status Dalam Keluarga</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>7.</td>
                <td>Anak Ke</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>1.</td>
                <td>Nama Peserta Didik (Lengkap)</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>8.</td>
                <td>Alamat Peserta Didik</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>9.</td>
                <td>Nomor Telepon Rumah</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>10.</td>
                <td>Sekolah Asal</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>11.</td>
                <td>Diterima di Sekolah ini</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>Di Kelas</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>Pada Tanggal</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>12.</td>
                <td>Nama Orang TUa</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>a. Ayah</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>b. Ibu</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>13.</td>
                <td>Alamat Orang Tua</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>Nomor Telepon Rumah</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>14.</td>
                <td>Pekerjaan Orang TUa</td>
                <td>:</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>a. Ayah</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>b. Ibu</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>15.</td>
                <td>Nama Wali Peserta Didik</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>16.</td>
                <td>Alamat Wali Peserta Didik</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>Nomor Telepon Rumah</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

            <tr>
                <td>17.</td>
                <td>Pekerjaan Wali Peserta Didik</td>
                <td>:</td>
                <td>Bloom IZ</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <hr>
                </td>
            </tr>

        </table class="kiri">
    </div>
</body>

</html>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:700,300&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <title>Using css page breaks when converting HTML to PDF</title>

    <style type="text/css">
        body {
            margin: 0 0 20px 0;
            padding: 0;
        }

        .cover {
            margin-top: 150px;
        }

        h1 {
            margin: 0;
            padding: 20px 0 20px 0;
            font-size: 2em;
            font-weight: 700;
            text-align: center;
        }


        .container {
            margin: 0 auto;
            padding: 0 0px;
            width: 515px;
        }

        table {
            width: 100%;
            margin: auto;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .tdcover {
            position: relative;
            border: 2px solid;
            padding: 0px 20px;
            vertical-align: top;
        }

        .hrcover {
            position: relative;
            border: 1px solid;
        }

        .kiri {
            text-align: left;
        }

        .tengah {
            text-align: center;
        }

        /* img {
			margin: 5px auto;
			max-width: 100%;
		} */

        div {
            text-align: center;
        }

        .break-before {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
        }
    </style>

</head>
<div>
    <table class="kiri">
        <tr>
            <th>Nama Sekolah</th>
            <th>:</th>
            <th>SMK Banjar Asri Cimaung</th>

            <th></th>

            <th>Kelas</th>
            <th>:</th>
            <th>X TAV</th>
        <tr>
            <th>Alamat Sekolah</th>
            <th>:</th>
            <th>Jl. Gunung Puntang Km.01 Cimaung</th>

            <th></th>

            <th>Semester</th>
            <th>:</th>
            <th>1(Satu)</th>
        <tr>
            <th>Nama Siswa</th>
            <th>:</th>
            <th>Aditya Pangestu</th>

            <th></th>

            <th>Tahun Ajaran</th>
            <th>:</th>
            <th>2019 / 2020</th>
        <tr>
            <th>Nomor Induk</th>
            <th>:</th>
            <th>10116256</th>

            <th></th>

            <th>NISN</th>
            <th>:</th>
            <th>10116256</th>
        </tr>
    </table>
    <div class="kiri">
        <br>
        <b>A. Sikap</b>
        <table border="1">
            <tr>
                <th>Sikap Spiritual</th>
                <td>...</td>
            </tr>
            <tr>
                <th>Sikap Sosial</th>
                <td>...</td>
            </tr>
        </table>

        <br>
        <b>B. Pengetahuan dan Keterampilan</b>
        <table border="1" class="tengah">
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Mata Pelajaran</th>
                <th colspan="4">Pengetahuan</th>
                <th colspan="4">Keterampilan</th colspan="4">
            </tr>
            <tr>
                <th>KKM</th>
                <th>Angka</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
                <th>KKM</th>
                <th>Angka</th>
                <th>Predikat</th>
                <th>Deskripsi</th>
            </tr>
            <tr>
                <th colspan="10" class="kiri">Kelompok A (Muatan Nasional)</th>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <th colspan="10" class="kiri">Kelompok B (Muatan Kewilayahan)</th>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <th colspan="10" class="kiri">Kelompok Peminatan Kejuruan</th>
            </tr>
            <tr>
                <th colspan="10" class="kiri">C 1 Dasar Bidang Keahlian</th>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <th colspan="10" class="kiri">C 2 Dasar Program Keahlian</th>
            </tr>
            <tr>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
                <td>...</td>
            </tr>
            <tr>
                <th colspan="2"><i>Jumlah</i></th>
                <td colspan="2">100</td>
                <td colspan="2"></td>
                <td colspan="2">100</td>
                <th><i>Total</i></th>
                <td>....</td>
            </tr>
            <tr>
                <th colspan="2"><i>Rata-rata</i></th>
                <td colspan="2">100</td>
                <td colspan="2"></td>
                <td colspan="2">100</td>
                <th><i>Total</i></th>
                <td>....</td>
            </tr>
            <tr>
                <th colspan="2"><i>Peringkat</i></th>
                <td colspan="8">....</td>
            </tr>
        </table> <br>
        <b>C. Kunjungan Industri</b>
        <br>
        <b>D. Ekstrakurikuler</b>
        <br>
        <b>E. Prestasi</b>
        <br>
        <b>F. Kehadiran</b>
        <br>
        <b>G. Catatan Wali Kelas</b>
        <br>
        <b>H. Tanggapan Orang Tua Wali</b>
    </div>
</div>
</body>

</html>