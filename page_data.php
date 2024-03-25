<?php include 'data.php' ?>
<?php include 'head.php' ?>
<h1>Data Penerima Bantuan Masyarakat</h1>
<div class="container" id="container-body">
    <table class="table align-middle table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Penerima</th>
                <?php
                for ($i=0; $i<count($kriteria); $i++){
                    echo "<th scope='col'>" . $kriteria[$i]['nama'];
                    echo "<br><small id='jenis-k'>" . $kriteria[$i]['jenis'] . "</small>";
                    echo "</th>";
                }
                ?>
            </tr>
        </thead>
        <tbody id="tabel-data">
            <?php
            for ($i=0; $i<count($alternatif); $i++){
                echo "<tr>";
                echo "<th scope='row'>" . ($i+1) . "</th>";
                echo "<td>" . $alternatif[$i][0] . "</td>";
                echo "<td> Rp" . number_format($alternatif[$i][1], 0, ",", ".") . "</td>";
                echo "<td>" . $alternatif[$i][2] . " Orang </td>";
                echo "<td>" . $alternatif[$i][3] . " m<sup>2</sup></td>";
                echo "<td>" . $alternatif[$i][4] . "</td>";
                echo "<td>" . $alternatif[$i][5] . "</td>";
                echo "<td>" . $alternatif[$i][6] . "</td>";
                echo "<td>" . $alternatif[$i][7] . "</td>";
                echo "<td>" . $alternatif[$i][8] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
