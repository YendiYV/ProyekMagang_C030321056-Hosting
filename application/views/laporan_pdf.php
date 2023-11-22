<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Cuti</title>
</head>

<body>
    <?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

    <?php

$id = 0;
foreach($cuti as $i)
:
$id++;
$id_cuti = $i['id_cuti'];
$id_user = $i['id_user'];
$nama_lengkap = $i['nama_lengkap'];
$alasan = $i['alasan'];
$nip = $i['nip'];
$proyek = $i['nama_proyek'];
$jabatan = $i['operator_level'];
$perihal_cuti = $i['perihal_cuti'];
$tgl_diajukan = $i['tgl_diajukan'];
$mulai = $i['mulai'];
$berakhir = $i['berakhir'];
$id_status_cuti1 = $i['id_status_cuti1'];
$id_status_cuti2 = $i['id_status_cuti2'];
$id_status_cuti3 = $i['id_status_cuti3'];
$days =$i['jumlah_hari'];
?>

   
     <p style=" color: #1ac6ff; margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:100%; font-size:12pt;"><span
            style="height:0pt; text-align:left; display:block; position:absolute; z-index:-1;"><img
                src="<?=base_url();?>assets/login/images/logo.jpg"
                width="160" height="74" alt="" class="fr-fir fr-dib fr-draggable"></span><strong><span
                style="font-family:'Times New Roman';">PLN TARAKAN CABANG KSKT CABANG UP2</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%; font-size:14pt;"><strong><span
                style="font-family:'Times New Roman';">PEMBANGKIT LISTRIK NEGERI</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%; font-size:12pt;"><strong><span
                style="font-family:'Times New Roman';">WILAYAH KALIMANTAN SELATAN & TENGAH</span></strong></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%;font-size:10pt"><span
            style="font-family:Arial;">Jl. Pangeran Hidayatullah No.22 Loktabat Utara,<br>Kec.Banjarbaru Utara. Kota Banjarbaru, Kalimantan Selatan, Kode Pos : 70714</span></p>
    <hr>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
            style="font-family:'Times New Roman';">&nbsp;</span></p>

        <p style="margin-top:0pt;margin-left:340pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="font-family:'Times New Roman';">Banjarbaru, <?= tgl_indo($tgl_diajukan)?></span>
    </p>
    <p style="margin-top:0pt; margin-left:300pt; margin-bottom:0pt; text-indent:36pt; text-align:justify; line-height:150%;">
        <span style="font-family:'Times New Roman';">Yth. Manajer PLN Cabang KSKT</span><br><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Di-Banjarbaru</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="font-family:'Times New Roman';">Nomor</span><span
            style="width:4.84pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">: &nbsp;<?=$id_cuti?></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="font-family:'Times New Roman';">Perihal</span><span
            style="width:4.84pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
            &nbsp;Pengajuan Cuti</span><span style="width:22.14pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span></p>
    <p
        style="margin-top:0pt; margin-left:36pt; margin-bottom:0pt; text-indent:36pt; text-align:justify; line-height:150%;">
        <span style="font-family:'Times New Roman';">&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';"> Karena <?=$perihal_cuti?></span><span
            style="width:1.09pt; text-indent:0pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; text-indent:0pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; text-indent:0pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; text-indent:0pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; text-indent:0pt; display:inline-block;">&nbsp;</span>
    </p>
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="width:6.02pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    </p>
    <p style="margin-top:0pt;margin-left:30pt;  margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="font-family:'Times New Roman';">Dengan Hormat</span><span
            style="width:4.84pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';"><br>
            Saya yang bertanda tangan di bawah ini,<br></span><span style="width:22.14pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;&nbsp;&nbsp;<br></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;Nama</span><span
            style="width:6.99pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
            <?=$nama_lengkap?></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;NIP</span><span
            style="width:16.3pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
            <?=$nip?></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;Proyek</span><span
            style="width:17.7pt; display:inline-block;">&nbsp;</span><span
            style="width:20pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
            <?=$proyek?></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span
            style="width:35.7pt; display:inline-block;">&nbsp;</span><span
            style="font-family:'Times New Roman';">&nbsp;Jabatan</span><span
            style="width:0pt; display:inline-block;">&nbsp;</span><span
            style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">: <?=$jabatan?></span></p>
    <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
            style="font-family:'Times New Roman';">&nbsp;</span></p>

        <p style="margin-top:0pt;margin-left:30pt; margin-bottom:0pt; text-align:justify; line-height:150%;">
                <span style="font-family:'Times New Roman';">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan ini saya mengajukan Permohonan Cuti selama <?=$days?> hari kerja, yaitu
                        terhitung mulai dari tanggal 
                        <?php
                        $mulai = $i['mulai'];
                        $berakhir = $i['berakhir']; 

                        // Periksa apakah $mulai dan $berakhir memiliki nilai yang valid
                        if ($mulai && $berakhir) {
                        $tanggalMulaiFormatted = date("d-m-Y", strtotime($mulai));
                        $tanggalBerakhirFormatted = date("d-m-Y", strtotime($berakhir));

                        echo $tanggalMulaiFormatted . " s.d " . $tanggalBerakhirFormatted;
                        } else {
                        echo "Tidak valid"; // Ganti dengan pesan kesalahan atau tindakan yang sesuai
                        }
                        ?>
                        yang akan di pergunakan untuk <b><?= $alasan ?></b>.
                </span>
        </p>


    <p style="margin-top:0pt;margin-left:30pt;  margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="width:36pt; display:inline-block;"></span><span
            style="width:36pt; display:inline-block;"></span><span style="font-family:'Times New Roman';"></span>
    </p>
        
        <p style="margin-top:0pt;margin-left:30pt;  margin-bottom:0pt; text-align:justify; line-height:150%;"><span
            style="font-family:'Times New Roman';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikianlah permohonan ini saya ajukan. Atas pertimbangan dan perhatian Bapak Manajer,
             saya mengucapkan terima kasih.
</span><span>
        </p>

    
    <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span
        style="width:36pt; display:inline-block;">&nbsp;</span><span
        style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';"></span>
        </p><br><br><br>
        
        <div style="text-align: center; margin-left: 480px;">
                <p style="font-family: 'Times New Roman'; margin: 0;">Banjarbaru, 
                        <span id="tanggalMulai">
                        <?php
                        $mulai = $i['mulai'];

                        // Periksa apakah $mulai memiliki nilai yang valid
                        if ($mulai) {
                                $tanggalMulaiFormatted = date("d-m-Y", strtotime($mulai));
                                echo $tanggalMulaiFormatted;
                        } else {
                                echo "Tidak valid"; // Ganti dengan pesan kesalahan atau tindakan yang sesuai
                        }
                        ?>
                        </span>
                </p><br><br><br>
                <p style="margin-top: 10px;">__________________________</p>
                <p style="font-family: 'Times New Roman'; margin-bottom: 0px;"><?=$nama_lengkap?></p>
        </div>
    <?php endforeach; ?>
</body>

</html>