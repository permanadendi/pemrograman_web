<?= $this->include('template/admin_header'); ?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($artikel): foreach ($artikel as $row): ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td>
                <b><?= $row['judul']; ?></b>
                <p><small><?= substr($row['isi'], 0, 50); ?>...</small></p>
            </td>
            <td><?= $row['status']; ?></td>
            <td>
                <a href="<?= base_url('admin/artikel/edit/' . $row['id']); ?>" class="btn btn-primary">Ubah</a>
                <a href="<?= base_url('admin/artikel/delete/' . $row['id']); ?>" class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; else: ?>
        <tr>
            <td colspan="4">Belum ada data.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->include('template/admin_footer'); ?>