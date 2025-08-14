<!DOCTYPE html>
<html lang="">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        .c25 {
            border-spacing: 0;
            border-collapse: collapse;
            margin-right: auto;
            width: 100%;
            font-size: 11px;
        }

        .c28 {
            border-right-style: solid;
            padding: 5pt 5pt 5pt 5pt;
            border-bottom-color: #000000;
            border-top-width: 1.2pt;
            border-right-width: 1.2pt;
            border-left-color: #000000;
            vertical-align: middle;
            border-right-color: #000000;
            border-left-width: 1.2pt;
            border-top-style: solid;
            border-left-style: solid;
            border-bottom-width: 1.2pt;
            text-align: center;
            border-top-color: #000000;
            border-bottom-style: solid
        }

        .c29 {
            padding: 5pt 5pt 5pt 5pt;
            border-color: #000000;
            vertical-align: top;
            border-width: 0.7pt;
            border-style: solid;
        }

        .c30 {
            text-align: center;
        }

        .c31 {
            text-align: right;
        }
    </style>
</head>
<table>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Filter</td>
        <td>Filter</td>
    </tr>
</table>
<?php foreach ($asb as $row) : ?>
    <table>
        <tbody>
            <tr>
                <td colspan="10"><?= $row['description']; ?></td>
                <td></td>
                <td>OPD</td>
                <td></td>
            </tr>
            <?php $rincian_objek = $db->table('tb_asb')->DISTINCT('tb_asb.id_asb')->select('tb_jenis_rincian_objek_sub.jenis_rincian_objek_sub')->select('tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub')->join('tb_jenis_rincian_objek_sub', 'tb_asb.jenis_rincian_objek_sub_id = tb_jenis_rincian_objek_sub.id_jenis_rincian_objek_sub', 'LEFT')->join('tb_asb_verifikasi', 'tb_asb.id_asb = tb_asb_verifikasi.asb_id', 'LEFT')->getWhere(['tb_asb_verifikasi.verifikasi' => 'lolos'])->getResultArray(); ?>
            <?php foreach ($rincian_objek as $ros) : ?>
                <tr>
                    <td></td>
                    <td colspan="9"><?= $ros['jenis_rincian_objek_sub']; ?></td>
                    <td></td>
                    <td>Rincian_sub_objek</td>
                </tr>
                <?php $asb = $db->table('tb_asb')->select('tb_asb.*')->join('tb_asb_verifikasi', 'tb_asb.id_asb = tb_asb_verifikasi.asb_id', 'LEFT')->getWhere(['tb_asb.jenis_rincian_objek_sub_id' => $ros['id_jenis_rincian_objek_sub'],  'tb_asb_verifikasi.verifikasi' => 'lolos'])->getResultArray(); ?>
                <?php foreach ($asb as $rol) : ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="8"><?= $rol['asb_paket']; ?><?= isset($rol['asb_satuan']) ?  ' - (' . $rol['asb_satuan'] . ')' : ''; ?></td>
                        <td></td>
                        <td>asb</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>ID</td>
                        <td>Paket</td>
                        <td>Spesifikasi</td>
                        <td>Satuan</td>
                        <td>Jumlah</td>
                        <td>Harga</td>
                        <td>Total</td>
                        <!-- -------------filter------ -->
                        <td></td>
                        <td></td>
                        <td>Header</td>
                        <!-- -------------filter------ -->
                    </tr>
                    <?php $asb_hspk = $db->table('tb_asb_hspk')->select('tb_hspk.id_hspk, tb_asb_hspk.jumlah, tb_hspk.jenis_rincian_objek_sub_id, tb_hspk.hspk_paket, tb_hspk.hspk_spesifikasi, 	tb_hspk.hspk_satuan')
                        ->join('tb_hspk', 'tb_asb_hspk.hspk_id = tb_hspk.id_hspk', 'left')
                        ->getWhere(['tb_asb_hspk.asb_id' => $rol['id_asb']])->getResultArray(); ?>
                    <?php foreach ($asb_hspk as $rom) : ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><?= $rom['jenis_rincian_objek_sub_id']; ?></td>
                            <td><?= $rom['hspk_paket']; ?></td>
                            <td><?= $rom['hspk_spesifikasi']; ?></td>
                            <td><?= $rom['hspk_satuan']; ?></td>
                            <td><?= $rom['jumlah']; ?></td>
                            <!-- ------------------------------------------------------------------------------------ -->
                            <?php
                            $A = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rom['id_hspk'], 'tb_hspk_komponen.group' => 'A'])->getResultArray();
                            $B = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rom['id_hspk'], 'tb_hspk_komponen.group' => 'B'])->getResultArray();
                            $C = $db->table('tb_hspk_komponen')->select('tb_hspk_komponen.index')->select('tb_ssh.harga')->join('tb_ssh', 'tb_hspk_komponen.ssh_id = tb_ssh.id_ssh', 'LEFT')->getWhere(['tb_hspk_komponen.hspk_id' => $rom['id_hspk'], 'tb_hspk_komponen.group' => 'C'])->getResultArray();

                            foreach ($A as $roA) :
                                $num[$rom['id_hspk'] . $rol['id_asb'] . 'A'][] = ($roA['harga'] * $roA['index']);
                            endforeach;
                            foreach ($B as $roB) :
                                $num[$rom['id_hspk'] . $rol['id_asb'] . 'B'][] = ($roB['harga'] * $roB['index']);
                            endforeach;
                            foreach ($C as $roC) :
                                $num[$rom['id_hspk'] . $rol['id_asb'] . 'C'][] = ($roC['harga'] * $roC['index']);
                            endforeach; ?>
                            <!-- ------------------------------------------------------------------------------------ -->
                            <td class="text-right">
                                <?php
                                isset($num[$rom['id_hspk'] . $rol['id_asb'] . 'A']) ? $AA = ($num[$rom['id_hspk'] . $rol['id_asb'] . 'A']) : $AA = ['0'];
                                isset($num[$rom['id_hspk'] . $rol['id_asb'] . 'B']) ? $BB = ($num[$rom['id_hspk'] . $rol['id_asb'] . 'B']) : $BB = ['0'];
                                isset($num[$rom['id_hspk'] . $rol['id_asb'] . 'C']) ? $CC = ($num[$rom['id_hspk'] . $rol['id_asb'] . 'C']) : $CC = ['0'];
                                echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)), 2, ',', '.');
                                $numS[$rol['id_asb']][] = (array_sum($AA) + array_sum($BB) + array_sum($CC)) * $rom['jumlah'];
                                ?>
                            </td>
                            <td class="text-right">
                                <?php
                                echo number_format((array_sum($AA) + array_sum($BB) + array_sum($CC)) * $rom['jumlah'], 2, ',', '.');
                                ?>
                            </td>
                            <!-- -------------filter------ -->
                            <td></td>
                            <td></td>
                            <td>Hspk</td>
                            <!-- -------------filter------ -->
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="6"><b>Tota:</b></td>
                        <td><?= isset($numS[$rol['id_asb']]) ? number_format(array_sum($numS[$rol['id_asb']]), 2, ',', '.') : '-'; ?></td>
                        <!-- -------------filter------ -->
                        <td></td>
                        <td></td>
                        <td>Jumlah</td>
                        <!-- -------------filter------ -->
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endforeach; ?>

</html>