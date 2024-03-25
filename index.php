<?php include 'head.php' ?>
<?php include 'moora.php' ?>
<h1>Sistem Penentuan Penerimaan Bantuan Masyarakat</h1>
<div class="container" id="container-body">
    <table class="table align-middle table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">ID Penerima</th>
                <th scope="col">Nama Penerima</th>
                <th scope="col">Max</th>
                <th scope="col">Min</th>
                <th scope="col">Y</th>
                <th scope="col">Rank</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 0;
            foreach ($y as $row){
                echo "<tr>";
                echo "<th scope='row'>" . $row['alt']+1  . "</th>";
                echo "<td>" . $alternatif[$row['alt']][0] . "</td>";
                echo "<td>" . number_format($row['max'], 5, ",", ".") . "</td>";
                echo "<td>" . number_format($row['min'], 5, ",", ".") . "</td>";
                echo "<td>" . number_format($row['y'], 5, ",", ".") . "</td>";
                echo "<td>" . (++$no) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>    
