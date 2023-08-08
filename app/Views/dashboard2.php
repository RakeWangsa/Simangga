<!-- app/Views/dashboard.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Data dari Sel O2 di Google Sheets</h1>

    <!-- Program -->
    <?php if (isset($programData) && !empty($programData)) : ?>
        <form>
            <label for="program">Program:</label>
            <select id="program">
                <?php foreach ($programData as $program) : ?>
                    <option value="<?php echo $program; ?>"><?php echo $program; ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    <?php else : ?>
        <p>Data tidak ditemukan</p>
    <?php endif; ?>

    <!-- Kegiatan -->
    <?php if (isset($kegiatanData) && !empty($kegiatanData)) : ?>
        <form>
            <label for="kegiatan">Kegiatan:</label>
            <select id="kegiatan">
                <?php foreach ($kegiatanData as $kegiatan) : ?>
                    <option value="<?php echo $kegiatan; ?>"><?php echo $kegiatan; ?></option>
                <?php endforeach; ?>
            </select>
        </form>
    <?php else : ?>
        <p>Data tidak ditemukan</p>
    <?php endif; ?>

    <?php if (isset($tableData) && !empty($tableData)) : ?>
        <table border="1">
            <tr>
                <th>Pagu</th>
                <th>Realisasi</th>
                <th>Sisa Pagu</th>
                <th>%</th>
            </tr>
            <tr>
                <td><?php $tableData['Pagu']; ?></td>
                <td><?php $tableData['Realisasi']; ?></td>
                <td><?php $tableData['Sisa_Pagu']; ?></td>
                <td><?php $tableData['Persentase']; ?></td>
            </tr>
        </table>
    <?php else : ?>
        <p>Data tidak ditemukan</p>
    <?php endif; ?>
</body>

</html>