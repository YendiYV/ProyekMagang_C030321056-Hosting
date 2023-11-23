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
        foreach($cuti as $i):
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
                $penempatan =$i['nama_penempatan'];
                $alamat=$i['alamat'];
                $no_telp =$i['no_telp'];
                $id_user_detail=$i['id_user'];
        ?>

        <p style=" color: #1ac6ff; margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:100%; font-size:12pt;"><span style="height:0pt; text-align:left; display:block; position:absolute; z-index:-1;"><img src="<?=base_url();?>assets/login/images/logo.jpg" width="160" height="74" alt="" class="fr-fir fr-dib fr-draggable"></span><strong><span style="font-family:'Times New Roman';">PT.PLN Nusa Daya CABANG UP Kalimantan 2</span></strong>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%; font-size:14pt;"><strong><span style="font-family:'Times New Roman';">PEMBANGKIT LISTRIK NEGERI</span></strong></p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%; font-size:12pt;"><strong><span style="font-family:'Times New Roman';">WILAYAH KALIMANTAN SELATAN & TENGAH</span strong>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:center; line-height:150%;font-size:10pt"><span style="font-family:Arial;">Jl. Pangeran Hidayatullah No.22 Loktabat Utara,<br>Kec.Banjarbaru Utara. Kota Banjarbaru, Kalimantan Selatan, Kode Pos : 70714</span>
        </p>
        <hr>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span style="font-family:'Times New Roman';">Tanggal</span><span style="width:4.84pt; display:inline-block;">&nbsp;</span><span style="width:31pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:&nbsp;Banjarbaru,<?= tgl_indo($tgl_diajukan)?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span style="font-family:'Times New Roman';">Nomor</span><span style="width:4.84pt; display:inline-block;">&nbsp;</span><span style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:&nbsp;<?=$id_cuti?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; text-align:justify; line-height:150%;"><span style="font-family:'Times New Roman';">Perihal</span><span style="width:4.84pt; display:inline-block;">&nbsp;</span><span style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:&nbsp;Formulir Pengajuan Cuti</span><span style="width:22.14pt; display:inline-block;">&nbsp;</span><span style="width:36pt; display:inline-block;">&nbsp;</span><span style="width:36pt; display:inline-block;">&nbsp;</span><span style="width:36pt; display:inline-block;">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;</span>
        </p>

        <p style="margin-top:0pt;margin-left:30pt;  margin-bottom:0pt; text-align:justify; line-height:150%;"><span
                style="width:4.84pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';"><br>
                Yang bertanda tangan di bawah ini,</span><span style="width:22.14pt; display:inline-block;">&nbsp;</span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="font-family:'Times New Roman';">&nbsp;Nama</span><span
                style="width:6.99pt; display:inline-block;">&nbsp;</span><span
                style="width:93.7pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
                <?=$nama_lengkap?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="font-family:'Times New Roman';">&nbsp;NIP</span><span
                style="width:16.3pt; display:inline-block;">&nbsp;</span><span
                style="width:94pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
                <?=$nip?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:35.8pt; display:inline-block;">&nbsp;</span><span
                style="font-family:'Times New Roman';">&nbsp;Jabatan</span><span
                style="width:0pt; display:inline-block;">&nbsp;</span><span
                style="width:94pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">: <?=$jabatan?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="font-family:'Times New Roman';">&nbsp;Proyek</span><span
                style="width:17.7pt; display:inline-block;">&nbsp;</span><span
                style="width:78pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
                <?=$proyek?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="font-family:'Times New Roman';">&nbsp;Wilayah Kerja</span><span
                style="width:17.7pt; display:inline-block;">&nbsp;</span><span
                style="width:42pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
                <?=$penempatan?></span>
        </p>
        <p style="margin-top:0pt; margin-bottom:0pt; line-height:150%;"><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="width:36pt; display:inline-block;">&nbsp;</span><span
                style="font-family:'Times New Roman';">&nbsp;Tanggal Pengajuan</span><span
                style="width:17.7pt; display:inline-block;">&nbsp;</span><span
                style="width:20pt; display:inline-block;">&nbsp;</span><span style="font-family:'Times New Roman';">:
               <?= tgl_indo($tgl_diajukan)?></span>
        </p>
                 <p style="margin-top:0pt; margin-bottom:0pt; line-height:20%;"><span
                style="font-family:'Times New Roman';">&nbsp;</span></p>

                <p style="margin-top:0pt;margin-left:30pt; margin-bottom:0pt; text-align:justify; line-height:150%;">
                        <span style="font-family:'Times New Roman';">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan ini saya mengajukan Permohonan Cuti selama <b><?=$days?> hari kerja</b>, yaitu
                                terhitung mulai dari
                                <?php
                                $mulai = $i['mulai'];
                                $berakhir = $i['berakhir'];

                                // Function definition
                                function translateDayToIndonesian($dayName)
                                {
                                        $daysInIndonesian = array(
                                        'Sunday' => 'Minggu',
                                        'Monday' => 'Senin',
                                        'Tuesday' => 'Selasa',
                                        'Wednesday' => 'Rabu',
                                        'Thursday' => 'Kamis',
                                        'Friday' => 'Jumat',
                                        'Saturday' => 'Sabtu'
                                        );

                                        return $daysInIndonesian[$dayName];
                                }

                                // Periksa apakah $mulai dan $berakhir memiliki nilai yang valid
                                if ($mulai && $berakhir) {
                                        $tanggalMulaiFormatted = date("d-m-Y", strtotime($mulai));
                                        $dayNameMulai = date("l", strtotime($mulai)); // Dapatkan nama hari untuk tanggal mulai dalam bahasa Inggris

                                        $tanggalBerakhirFormatted = date("d-m-Y", strtotime($berakhir));
                                        $dayNameBerakhir = date("l", strtotime($berakhir)); // Dapatkan nama hari untuk tanggal berakhir dalam bahasa Inggris

                                        // Ubah nama hari ke dalam bahasa Indonesia
                                        $dayNameMulaiID = translateDayToIndonesian($dayNameMulai);
                                        $dayNameBerakhirID = translateDayToIndonesian($dayNameBerakhir);

                                        echo "hari <b>" . $dayNameMulaiID . ", " . $tanggalMulaiFormatted . "</b> s.d hari <b>" . $dayNameBerakhirID . ", " . $tanggalBerakhirFormatted . "</b>";
                                } else {
                                        echo "Data tidak valid"; // Ganti dengan pesan kesalahan atau tindakan yang sesuai
                                }
                                ?>
                                yang akan di pergunakan dengan keterangan sebagai berikut :<br>  
                        </span>
                </p>
                <p style="margin-left:30pt; margin-bottom:0pt; text-align:justify; line-height:150%;">
                        Keterangan Cuti <span style="width:76.7pt; display:inline-block;">&nbsp;</span>: <?= $alasan ?><br>
                        Alamat dan No.Telp selama cuti : <?= $alamat ?> / <?= $no_telp ?>
                </p>
           
        <table style="margin-left:28pt;">
                <tr>
                        <td style="text-align: center;padding-right:166pt;">
                                <!-- Kolom Kiri -->
                                <br>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Menyetujui,</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Manager Unit Layanan Banjarmasin</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">PT. PLN Nusa Daya UP Kalimantan 2</p>
                                <?php if($id_status_cuti2 == 2){ ?>
                                        <?php
                                        $imagePath = 'assets/ttd/ttd-mnj.jpg';

                                        if (file_exists($imagePath)) {
                                        ?>
                                        <img src="<?= base_url($imagePath); ?>" width="160" height="80" alt="" class="fr-fir fr-dib fr-draggable">
                                        <?php
                                        } else {
                                        ?>
                                        <!-- Display a text message when the file is not found -->
                                        <br><span style="color: red;">Tanda Tangan Tidak Ada</span><br><br>
                                        <?php
                                        }
                                        ?>
                                <?php
                                }else{
                                ?>
                                <br><br>
                                <?php
                                }
                                ?>
                                 <p style="margin-top: -10px; margin-bottom: -10px;">__________________________</p>
                                <p style="font-family: 'Times New Roman';">Akbar Kurnia Octavianto</p>
                        </td>
                        
                        <td style="text-align: center;">
                                <!-- Kolom Kanan -->
                                <b style="font-family: 'Times New Roman'; margin: 0;">Banjarbaru, 
                                <span id="tanggalMulai">
                                        <?php
                                        $mulai = $i['mulai'];
                                        if ($mulai) {
                                        $tanggalMulaiFormatted = date("d-m-Y", strtotime($mulai));
                                        echo $tanggalMulaiFormatted;
                                        } else {
                                        echo "Tidak valid";
                                        }
                                        ?>
                                </span>
                                </b>
                                <?php foreach($spv as $s):
                                        $nama_spv=$s['nama_lengkap'];
                                ?>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Menyetujui,</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Supervisior Plt</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">PT. PLN Nusa Daya UP Kalimantan 2</p>
                                <?php if($id_status_cuti2 == 2){ ?>
                                        <?php
                                        $imagePath = 'assets/ttd/ttd-spv.jpg';

                                        if (file_exists($imagePath)) {
                                        ?>
                                        <img src="<?= base_url($imagePath); ?>" width="160" height="80" alt="" class="fr-fir fr-dib fr-draggable">
                                        <?php
                                        } else {
                                        ?>
                                        <!-- Display a text message when the file is not found -->
                                        <br><span style="color: red;">Tanda Tangan Tidak Ada</span><br><br>
                                        <?php
                                        }
                                        ?>
                                <?php
                                }else{
                                ?>
                                <br><br>
                                <?php
                                }
                                ?>
                                <p style="margin-top: -10px; margin-bottom: -10px;">__________________________</p>
                                <p style="font-family: 'Times New Roman';"><?=$nama_spv?></p>
                                
                                <?php endforeach; ?>

                        </td>
                </tr>
                <tr>
                        <?php
                        foreach($mng as $m):
                        $nama_mng= $m['nama_lengkap'];
                        ?>
                        <td style="text-align: center;padding-right:166pt;">
                                <!-- Kolom Kiri -->
                                <br>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Mengetahui,</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Plt.Manager</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">PT. Paguntakan Cahaya Nusantara<br>Cabang Kalseteng</p>
                                <?php if($id_status_cuti3 == 2){ ?>
                                        <?php
                                        $imagePath = 'assets/ttd/ttd-mng.jpg';

                                        if (file_exists($imagePath)) {
                                        ?>
                                        <img src="<?= base_url($imagePath); ?>" width="160" height="80" alt="" class="fr-fir fr-dib fr-draggable">
                                        <?php
                                        } else {
                                        ?>
                                        <!-- Display a text message when the file is not found -->
                                        <br><span style="color: red;">Tanda Tangan Tidak Ada</span><br><br>
                                        <?php
                                        }
                                        ?>

                                <?php }else{
                                ?>
                                <br><br>
                                <?php
                                }
                                ?>
                                <p style="margin-top:-20px; margin-bottom: -10px;">__________________________</p>
                                <p style="font-family: 'Times New Roman';"><?=$nama_mng?></p>
                                
                        </td>
                        <?php endforeach; ?>
                        <td style="text-align: center;">
                                <!-- Kolom Kanan -->
                                <p></p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">Pemohon,</p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;"><?=$jabatan?></p>
                                <p style="font-family: 'Times New Roman'; margin: 0; font-size: 15px;">PT. PLN Nusa Daya UP Kalimantan 2</p>
                                <img src="<?= base_url('assets/ttd/ttd-ops-' . $id_user . '.jpg'); ?>" width="160" height="80" alt="" class="fr-fir fr-dib fr-draggable">
                                <p style="margin-top:-16px; margin-bottom: -10px;">__________________________</p>
                                <p style="font-family: 'Times New Roman';"><?=$nama_lengkap?></p>
                        </td>
                        
                </tr>
                
        </table> 
        <?php endforeach; ?>
</body>
</html>